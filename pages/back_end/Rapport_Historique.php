<?php 
    ob_start();
    session_start();
    require('connexion.php');
    
    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
        header('location:../login.php');

    else{
        
        if(!empty($_GET['rapport']))
        {
            $filename = basename($_GET['rapport']);
            
            $filepath = '../uploads/rapport/' . $filename;
            if(!empty($filename) && file_exists($filepath)){
        
                //Define Headers
                header("Cache-Control: public");
                header("Content-Description: FIle Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/zip");
                header("Content-Transfer-Emcoding: binary");
        
                readfile($filepath);
                exit;
        
            }
            else{
                echo "This File Does not exist.";
            }
            header('location:../Historique.php');
            
        }else{
            header('location:../'.$_SESSION['main_page']);
        }
    }

?>