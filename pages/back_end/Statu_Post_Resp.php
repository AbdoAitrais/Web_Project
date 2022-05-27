<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{

        if( $_SESSION['user_type'] == "Responsable" )
        {
            if((isset($_GET['Post_Retenue']) || isset($_GET['Post_Non_Retenue'])) && (isset($_GET['id_etu'])) )
            {
                
                $Etu=$_GET['id_etu'];
                $curdate = date("Y-m-d");
    
                if(isset($_GET['Post_Non_Retenue'])){
                    
                    $Offre_ID = $_GET['Post_Non_Retenue'] ;  
                    $sql4="UPDATE postuler SET STATU='Non Retenue',DATEREPONS='$curdate' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
    
                }else if(isset($_GET['Post_Retenue'])){
                    
                    $Offre_ID = $_GET['Post_Retenue'] ;      
                    $sql4="UPDATE postuler SET STATU='Retenue',DATEREPONS='$curdate' WHERE ID_ETU='$Etu' AND ID_OFFRE='$Offre_ID' ";
    
                    /// ***Nbr Candidats
                    $sql6 ="SELECT NBRCANDIDAT FROM offre WHERE ID_OFFRE='$Offre_ID' ";
                    $req6 =$bdd->query($sql6);
                    $result6 = $req6->fetch(PDO::FETCH_ASSOC);
                    
                    $NbrCandid=$result6['NBRCANDIDAT'];
                    
                    if($NbrCandid>1)
                        $sql5="UPDATE offre SET NBRCANDIDAT=NBRCANDIDAT-1 WHERE ID_OFFRE='$Offre_ID' ";
                    else
                        $sql5="UPDATE offre SET NBRCANDIDAT=NBRCANDIDAT-1,STATUOFFRE='Completée' WHERE ID_OFFRE='$Offre_ID' ";
                    
                    
                    
                    $bdd->exec($sql5);
                }
                $bdd->exec($sql4);
                header('location:../Soumis_Resp.php?id_etu='.$Etu);
            }
        }
        else
        {
            header('location:'.$_SESSION['main_page']);
        }
    }

?>