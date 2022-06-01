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
                    $Smt=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=? ");
                    $Smt->execute(array('Non Acceptée',$Etu,$Offre_ID));               
                    
                    /// ***
                    $Smt1 =$bdd->prepare("SELECT o.NBRCANDIDAT-count(*) AS NbrReste FROM postuler p,offre O WHERE o.ID_OFFRE=p.ID_OFFRE  AND p.ID_OFFRE=? AND o.STATUOFFRE=? AND (STATU=? OR STATU=?)");
                    $Smt1->execute(array($Offre_ID,'Completée','Retenue','Acceptée'));
                    $row1 = $Smt1->fetch(PDO::FETCH_ASSOC);
                    
                    if(!empty($row1))
                    {
                        
                        $NbrReste = $row1['NbrReste'];   
                        if($NbrReste > 0)
                        {
                            $Smt2=$bdd->prepare("UPDATE offre SET STATUOFFRE=? WHERE ID_OFFRE=? ");
                            $Smt2->execute(array('Nouveau',$Offre_ID) );
                        }
                    }
                    

                    header('location:../Soumissions_Etu.php');
                
                }else if(isset($_GET['offre_accepte'])){
                    
                    $Offre_ID = $_GET['offre_accepte'] ;  
                    
                    ///*** Acceptation
                    $Smt=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=? ");
                    $Smt->execute(array('Acceptée',$Etu,$Offre_ID));  
                    /// *** Mettre non acceptée dans tous les offres retenues
                    $Smt1=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND STATU=? ");
                    $Smt1->execute(array('Non Acceptée',$Etu,'Retenue'));  
                    /// *** Annuler postulation d'autres offres
                    $Smt2=$bdd->prepare("DELETE FROM postuler WHERE ID_ETU=? AND STATU=? ");
                    $Smt2->execute(array($Etu,'Postulée'));
                    
                    /// ***ID DE NIVEAU DE L'ETUDIANT
                    $sql_niveau = $bdd->prepare("SELECT NIVEAU FROM etudiant WHERE ID_ETU=? ");
                    $sql_niveau->execute(array($Etu));
                    $result_niveau = $sql_niveau->fetch(PDO::FETCH_ASSOC);
                    $NIVEAU = $result_niveau['NIVEAU'];
                    
                    /// *** Inserer stage 
                    $sql_stage = $bdd->prepare("INSERT INTO stage(ID_OFFRE,ID_ETU,DATEDEBUT_STAGE,NIVEAU_STAGE) VALUES(?,?,?,?)  ");
                    $sql_stage->execute(array($Offre_ID,$Etu,$curdate,$NIVEAU));

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