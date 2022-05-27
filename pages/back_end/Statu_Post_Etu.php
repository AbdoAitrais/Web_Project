<?php 
    ob_start();
    session_start();

    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) ){

        header('location:../login.php');
    }
    else{
        
        if( $_SESSION['user_type'] == "Etudiant" )
        {
            require('connexion.php');
            if(isset($_GET['offre_post']) || isset($_GET['offre_non_accepte']) || isset($_GET['offre_accepte'])){
            
                $Etu=$_SESSION['user_id'];
                $curdate = date("Y-m-d");
                
                if(isset($_GET['offre_post'])){

                    $Offre_ID = $_GET['offre_post'] ;  
                    
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
                    
                    /// ***ID DE L'ENTREPRISE D'OFFRE
                    $sql_id_entrep = "SELECT ID_ENTREP FROM offre WHERE ID_OFFRE='$Offre_ID' ";
                    $req_id_entrep = $bdd->query($sql_id_entrep);
                    $result_id_entrep = $req_id_entrep->fetch(PDO::FETCH_ASSOC);
                    $ID_ENTREP = $result_id_entrep['ID_ENTREP'];

                    /// ***ID DE NIVEAU DE L'ETUDIANT
                    $sql_niveau = "SELECT NIVEAU FROM etudiant WHERE ID_ETU='$Etu' ";
                    $req_niveau = $bdd->query($sql_niveau);
                    $result_niveau = $req_niveau->fetch(PDO::FETCH_ASSOC);
                    $NIVEAU = $result_niveau['NIVEAU'];
                    
                    
                    /// *** 
                    $sql_stage = "INSERT INTO stage(ID_OFFRE,ID_ENTREP,ID_ETU,DATEDEBUT_STAGE,NIVEAU_STAGE) VALUES('$Offre_ID',$ID_ENTREP,'$Etu','$curdate' ,$NIVEAU)  ";
                    $bdd->exec($sql_stage);

                    /// ***
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

    }  
   



?>