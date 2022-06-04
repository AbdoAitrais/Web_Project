<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{

        if( $_SESSION['user_type'] == "Responsable" )
        {
            if(!empty($_GET['id_offre']) && (!empty($_GET['etu_add']) || !empty($_GET['etu_supp'])) )
            {
                /// ***
                $id_offre = $_GET['id_offre'];
                
                if(!empty($_GET['etu_add']))
                {
                    $id_etu = $_GET['etu_add'];

                    /// *** Insertion en liste d'attante
                    $Smt = $bdd->prepare("INSERT INTO attente(ID_ETU,ID_OFFRE) VALUES(?,?) ");
                    $Smt->execute(array($id_etu,$id_offre));
                    $Smt->closeCursor();//vider le curseur (free)

                    /// *** Update statu to Retenue en attente
                    $Smt = $bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=?");
                    $Smt->execute(array('Retenue en attente',$id_etu,$id_offre));
                    $Smt->closeCursor();//vider le curseur (free)
                }

                if(!empty($_GET['etu_supp']))
                {
                    $id_etu = $_GET['etu_supp'];

                    /// *** Suppression de la liste d'attante
                    $Smt = $bdd->prepare("DELETE FROM attente WHERE ID_ETU=? AND ID_OFFRE=? ");
                    $Smt->execute(array($id_etu,$id_offre));
                    $Smt->closeCursor();//vider le curseur (free)

                    /// *** Update statu to Retenue en attente
                    $Smt = $bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=?");
                    $Smt->execute(array('Postulée',$id_etu,$id_offre));
                    $Smt->closeCursor();//vider le curseur (free)
                }

                header("location:../Liste_Attente_Resp.php?id_offre=".$id_offre);
            }
            
        }
        else
        {
            header('location:'.$_SESSION['main_page']);
        }
    }

?>