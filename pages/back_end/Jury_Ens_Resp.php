<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{

        if( $_SESSION['user_type'] == "Responsable" )
        {
            if((isset($_GET['jury_add']) || isset($_GET['jury_supp'])) && (isset($_GET['id_etu'])) )
            {
                
                $Etu=$_GET['id_etu'];    
                
                if(isset($_GET['jury_supp'])){
                    
                    $JURY_ID = $_GET['jury_supp'] ;  
                    $sql4="DELETE FROM juri WHERE ID_ENS='$JURY_ID' AND ID_STAGE = (SELECT ID_STAGE FROM stage WHERE ID_ETU ='$Etu' AND DATEDEBUT_STAGE = (SELECT max(DATEDEBUT_STAGE) FROM stage WHERE ID_ETU='$Etu') ) ";
    
                }else if(isset($_GET['jury_add'])){
                    
                    $ENS_ID = $_GET['jury_add'] ;   
                    
                    /// ***ID_STAGE encours de ce etudiant
                    $sql6 ="SELECT ID_STAGE FROM stage WHERE ID_ETU='$Etu' AND DATEDEBUT_STAGE = (SELECT max(DATEDEBUT_STAGE) FROM stage WHERE ID_ETU='$Etu')";
                    $req6 =$bdd->query($sql6);
                    $result6 = $req6->fetch(PDO::FETCH_ASSOC);
                    $STAGE_ENCOUR =$result6['ID_STAGE']; 
                    /// *** 
                    $sql4="INSERT INTO juri(ID_ENS,ID_STAGE) VALUES('$ENS_ID','$STAGE_ENCOUR') ";
                }
                $bdd->exec($sql4);
                header('location:../Jury_Resp.php?id_etu='.$Etu);
            }
        }
        else
        {
            header('location:'.$_SESSION['main_page']);
        }
    }

?>