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
                    
                    ///Postulation
                    $Smt = $bdd->prepare("INSERT INTO postuler(ID_ETU,ID_OFFRE,STATU,DATEPOST) values(?,?,?,?)");
                    $Smt -> execute(array($Etu,$Offre_ID,'Postulée',$curdate));               
                    ///*** MAIL SENDING
                    
                    /// ***
                    header('location:../Find_Offre_Etu.php');
                
                }else if(isset($_GET['offre_non_accepte'])){

                    $Offre_ID = $_GET['offre_non_accepte'] ;  

                    /// *** Mettre non acceptée dans cet offre
                    $sql1="UPDATE postuler SET STATU='Non Acceptée' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
                    $bdd->exec($sql1);
                    /// *** Augmenter le nombre de candidat
                    $sql2="UPDATE offre SET NBRCANDIDAT=NBRCANDIDAT+1,STATUOFFRE='Nouveau' WHERE ID_OFFRE='$Offre_ID' ";
                    $bdd->exec($sql2);

                    header('location:../Soumissions_Etu.php');
                
                }else if(isset($_GET['offre_accepte'])){
                    
                    $Offre_ID = $_GET['offre_accepte'] ;  
                    
                    ///*** Acceptation
                    $sql1="UPDATE postuler SET STATU='Acceptée' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
                    $bdd->exec($sql1);
                    /// *** Mettre non acceptée dans tous les offres retenues
                    $sql2="UPDATE postuler SET STATU='Non Acceptée' WHERE ID_ETU='$Etu' AND STATU='Retenue' ";
                    $bdd->exec($sql2);
                    /// *** Annuler postulation d'autres offres
                    $sql3="DELETE FROM postuler WHERE ID_ETU='$Etu' AND STATU='Postulée' ";
                    $bdd->exec($sql3);
                    
                    /// ***ID DE NIVEAU DE L'ETUDIANT
                    $sql_niveau = "SELECT NIVEAU FROM etudiant WHERE ID_ETU='$Etu' ";
                    $req_niveau = $bdd->query($sql_niveau);
                    $result_niveau = $req_niveau->fetch(PDO::FETCH_ASSOC);
                    $NIVEAU = $result_niveau['NIVEAU'];
                    
                    
                    /// *** Inserer stage 
                    $sql_stage = "INSERT INTO stage(ID_OFFRE,ID_ETU,DATEDEBUT_STAGE,NIVEAU_STAGE) VALUES('$Offre_ID','$Etu','$curdate' ,$NIVEAU)  ";
                    $bdd->exec($sql_stage);

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