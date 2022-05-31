<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{

        if( $_SESSION['user_type'] == "Responsable" )
        {
            if(!empty($_GET['id_etu']) )
            {
                $id_etu = $_GET['id_etu'];
                
                $Smt = $bdd->prepare("UPDATE users u,etudiant e SET u.ACTIVE='0' WHERE u.ID_USER = e.ID_USER AND e.ID_ETU=?");
                $Smt -> execute(array($id_etu));
                
                $Smt->closeCursor();//vider le curseur (free)
                
                header('location:../Liste_Etudiant_Resp.php?id_etu='.$id_etu);
            }
        }
        else
        {
            header('location:'.$_SESSION['main_page']);
        }
    }

?>