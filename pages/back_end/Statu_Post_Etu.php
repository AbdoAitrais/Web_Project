<?php 
    ob_start();
    session_start();

    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:authentification.php');
   
    if( $_SESSION['user_type'] == "Etudiant" )
    {
        require('connexion.php');
        if(isset($_GET['offre_post']) || isset($_GET['offre_non_accepte']) || isset($_GET['offre_accepte'])){
        
            $Etu=$_SESSION['user_id'];
            
            if(isset($_GET['offre_post'])){
                $Offre_ID = $_GET['offre_post'] ;  
                $curdate = date("Y-m-d");
                $sql4="INSERT INTO postuler(ID_ETU,ID_OFFRE,STATU,DATEPOST) values('$Etu','$Offre_ID','Postulée','$curdate') ";
                $bdd->exec($sql4);               
                ///*** MAIL SENDING
                
                /// ***
                header('location:../Find_Offre_Etu.php');
            
            }else if(isset($_GET['offre_non_accepte'])){

                $Offre_ID = $_GET['offre_non_accepte'] ;  

                $sql4="UPDATE postuler SET STATU='Non Acceptée' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
                $sql7="UPDATE offre SET NBRCANDIDAT=NBRCANDIDAT+1,STATUOFFRE='Nouveau' WHERE ID_OFFRE='$Offre_ID' ";
                
                $bdd->exec($sql7);
                $bdd->exec($sql4);

                header('location:../Soumissions_Etu.php');
            
            }else if(isset($_GET['offre_accepte'])){
                
                $Offre_ID = $_GET['offre_accepte'] ;  
                
                $sql4="UPDATE postuler SET STATU='Acceptée' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
                $sql5="UPDATE postuler SET STATU='Non Acceptée' WHERE ID_ETU='$Etu' AND STATU='Retenue' ";
                $sql6="DELETE FROM postuler WHERE ID_ETU='$Etu' AND STATU='Postulée' ";
                
                $bdd->exec($sql5);
                $bdd->exec($sql6);
                $bdd->exec($sql4);
                
                header('location:../Soumissions_Etu.php');
            }
        
        }
        
            
    }
    else
    {
        header('location:'.$_SESSION['main_page']);
    }

?>