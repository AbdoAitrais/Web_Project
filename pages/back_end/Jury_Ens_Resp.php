<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{

        if( $_SESSION['user_type'] == "Responsable" )
        {
            if(((!empty($_POST['jury_add']) || !empty($_GET['jury_supp'])) && (!empty($_GET['id_stage'])) ))
            {
                
                 
                $id_stage = $_GET['id_stage'];

                if(!empty($_GET['jury_supp'])){
                    
                    $JURY_ID = $_GET['jury_supp'] ;  
                    
                    $sql1="DELETE FROM juri WHERE ID_ENS='$JURY_ID' AND ID_STAGE ='$id_stage' ";
                    $bdd->exec($sql1);
                
                }else if(!empty($_POST['jury_add'])){
                    ///Indexes of array represent the IDS of ENSEIGNANTS,"on" means est checkée
                    $ENS_IDS = array_keys($_POST['jury_add'] , 'on');
                   
                    foreach($ENS_IDS as $ENS_ID){
                        
                        $sql2="INSERT INTO juri(ID_ENS,ID_STAGE) VALUES('$ENS_ID','$id_stage') ";
                        $bdd->exec($sql2);
                    }
                    
                }
                
                header('location:../Jury_Resp.php?id_stage='.$id_stage);
            }
        }
        else
        {
            header('location:'.$_SESSION['main_page']);
        }
    }

?>