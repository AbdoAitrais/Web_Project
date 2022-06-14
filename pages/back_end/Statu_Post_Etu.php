<?php use PHPMailer\PHPMailer\PHPMailer;
    ob_start();
    session_start();

    if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) ){

        header('location:../login.php');
    }
    else{
        
        if( $_SESSION['user_type'] == "Etudiant" )
        {
            require('connexion.php');
            if(isset($_POST['offre_post']) || isset($_POST['offre_non_accepte']) || isset($_POST['offre_accepte'])){
            
                $Etu=$_SESSION['user_id'];

                $timestamp = time()+60*60;
                $curdate = date("Y-m-d h:i:s",$timestamp);
                
                if(isset($_POST['offre_post'])){

                    $Offre_ID = $_POST['offre_post'] ;  
                    ///Postulation
                    if(isset($_POST['submit']))
                    {
                        /// Insert CV
                        //echo $_FILES["CV"]["name"];
                        $target_dir = "../uploads/cv/";
                        $target_file = $target_dir . basename($_FILES["CV"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $cv = NULL;
                        

                        // Check if file already exists
                        if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                        }

                        // Check file size
                        if ($_FILES["CV"]["size"] > 10000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                        }

                        // Allow certain file formats
                        if($imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "dotx"
                        && $imageFileType != "doc" ) {
                        echo "Sorry, only PDF, DOCX, DOC & DOTX files are allowed.";
                        $uploadOk = 0;
                        }

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                        if (move_uploaded_file($_FILES["CV"]["tmp_name"], $target_file)) {
                            echo "The file ". htmlspecialchars( basename( $_FILES["CV"]["name"])). " has been uploaded.";
                            $cv = "../uploads/cv/".htmlspecialchars( basename( $_FILES["CV"]["name"]));
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        }

                        $Smt = $bdd->prepare("UPDATE etudiant SET CV=? WHERE ID_ETU=?");
                        $Smt -> execute(array($cv,$Etu)); 
                        $Smt->closeCursor();//vider le curseur (free)  
                    }
                
                    /// *** Postulation
                    $Smt = $bdd->prepare("INSERT INTO postuler (ID_ETU,ID_OFFRE,STATU,DATEPOST) values(?,?,?,?)");
                    $Smt -> execute(array($Etu,$Offre_ID,'Postulée',$curdate)); 
                    $Smt->closeCursor();//vider le curseur (free)             
                    ///*** MAIL SENDING
                    $name = "FSTAGE";  // Name of your website or yours
                    $to = "yassinejrayfy36@gmail.com";  // mail of reciever
                    $subject = "Tutorial or any subject";
                    $body = "Send Mail Using PHPMailer - MS The Tech Guy";
                    $from = "fstage.media@gmail.com";  // you mail
                    $password = "rmjqxniouziiythp";  // your mail password
                    //$cv = "path";

                    // Ignore from here

                    require_once "PHPMailer/src/PHPMailer.php";
                    require_once "PHPMailer/src/SMTP.php";
                    require_once "PHPMailer/src/Exception.php";
                    $mail = new PHPMailer();

                    // To Here

                    //SMTP Settings
                    $mail->isSMTP();
                    $mail->oauthUserEmail = "[Redacted]@gmail.com";
                    $mail->oauthClientId = "[Redacted]";
                    $mail->oauthClientSecret = "[Redacted]";
                    $mail->oauthRefreshToken = "[Redacted]";
                    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
                    $mail->Host = "smtp.gmail.com"; // smtp address of your email
                    $mail->SMTPAuth = true;
                    $mail->Username = $from;
                    $mail->Password = $password;
                    $mail->Port = 587;  // port
                    $mail->SMTPSecure = "tls";  // tls or ssl
                    $mail->smtpConnect([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        ]
                    ]);

                    //Email Settings
                    $mail->isHTML(true);
                    $mail->setFrom($from, $name);
                    $mail->addAddress($to); // enter email address whom you want to send
                    $mail->Subject = ("$subject");
                    $mail->Body = $body;
                    $mail->addAttachment("../uploads/cv/010080697.pdf");
                    if ($mail->send()) {
                        echo "Email is sent!";
                    } else {
                        echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
                    }
                    /// ***
                   
                    header('location:../Find_Offre_Etu.php');
                
                }else if(isset($_POST['offre_non_accepte'])){

                    $Offre_ID = $_POST['offre_non_accepte'] ;  

                    /// *** Mettre non acceptée dans cet offre
                    $Smt=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=? ");
                    $Smt->execute(array('Non Acceptée',$Etu,$Offre_ID));               
                    
                    /// *** Nombre condidat
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
                    

                    /// *** Prendre du liste d'attente
                    $Smt2=$bdd->prepare("SELECT ID_ETU FROM attente WHERE ID_OFFRE= ? AND PRIORITE=(SELECT min(PRIORITE) FROM attente WHERE ID_OFFRE=?)");
                    $Smt2->execute(array($Offre_ID,$Offre_ID)); 
                    $row2 = $Smt2->fetch(PDO::FETCH_ASSOC);
                    if(!empty($row2))
                    {
                       $id_etu_att = $row2['ID_ETU'];
                       
                       ///Update in postuler with Retenue
                       $Smt = $bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=?");
                       $Smt->execute(array('Retenue',$id_etu_att,$Offre_ID));
                       $Smt->closeCursor();//vider le curseur (free)
                       
                        ///Delete from liste attente 
                        $Smt = $bdd->prepare("DELETE FROM attente WHERE ID_ETU=? AND ID_OFFRE=? ");
                        $Smt->execute(array($id_etu_att,$Offre_ID));
                        $Smt->closeCursor();//vider le curseur (free)
                    }
                    header('location:../Soumissions_Etu.php');

                     
                
                }else if(isset($_POST['offre_accepte'])){
                    
                    $Offre_ID = $_POST['offre_accepte'] ;  
                    
                    ///*** Acceptation
                    $Smt=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=? ");
                    $Smt->execute(array('Acceptée',$Etu,$Offre_ID));  
                    $Smt->closeCursor();//vider le curseur (free)
                    
                    //*** tous les offres  retenues de cet etudiant
                    $Smt=$bdd->prepare("SELECT ID_OFFRE from postuler WHERE ID_ETU=? AND STATU=? AND ID_OFFRE!=?");
                    $Smt->execute(array($Etu,'Retenue',$Offre_ID));
                    $List_No_Accept =$Smt->fetchAll(PDO::FETCH_ASSOC);
                    $Smt->closeCursor();//vider le curseur (free)
                    
            
                    /// *** Mettre non acceptée dans tous les offres retenues
                    $Smt=$bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND STATU=? ");
                    $Smt->execute(array('Non Acceptée',$Etu,'Retenue'));  
                    $Smt->closeCursor();//vider le curseur (free)
                    
                    /// *** Annuler postulation d'autres offres
                    $Smt=$bdd->prepare("DELETE FROM postuler WHERE ID_ETU=? AND (STATU=? OR STATU=?) ");
                    $Smt->execute(array($Etu,'Postulée','Retenue en attente'));
                    $Smt->closeCursor();//vider le curseur (free)
                    
                    /// *** Supprimer de la liste d'attente
                    $Smt=$bdd->prepare("DELETE FROM attente WHERE ID_ETU=?");
                    $Smt->execute(array($Etu));
                    $Smt->closeCursor();//vider le curseur (free)
                    
                    /// *** Take from liste d'attente
                        foreach($List_No_Accept as $No_Accept)
                        {   
                            
                            /// *** Nombre condidat
                            $Smt1 =$bdd->prepare("SELECT o.NBRCANDIDAT-count(*) AS NbrReste FROM postuler p,offre O WHERE o.ID_OFFRE=p.ID_OFFRE  AND p.ID_OFFRE=? AND o.STATUOFFRE=? AND (STATU=? OR STATU=?)");
                            $Smt1->execute(array($No_Accept['ID_OFFRE'],'Completée','Retenue','Acceptée'));
                            $row1 = $Smt1->fetch(PDO::FETCH_ASSOC);
                            $Smt1->closeCursor();//vider le curseur (free)
                            
                            if(!empty($row1))
                            {
                                
                                $NbrReste = $row1['NbrReste'];   
                                if($NbrReste > 0)
                                {
                                    $Smt2=$bdd->prepare("UPDATE offre SET STATUOFFRE=? WHERE ID_OFFRE=? ");
                                    $Smt2->execute(array('Nouveau',$No_Accept['ID_OFFRE']) );
                                    $Smt2->closeCursor();//vider le curseur (free)
                                }
                            }
                            
                            /// *** Select etudiant de liste d'attente
                            $Smt=$bdd->prepare("SELECT ID_ETU FROM attente WHERE ID_OFFRE= ? AND PRIORITE=(SELECT min(PRIORITE) FROM attente WHERE ID_OFFRE=?)");
                            $Smt->execute(array($No_Accept['ID_OFFRE'],$No_Accept['ID_OFFRE'])); 
                            $row = $Smt->fetch(PDO::FETCH_ASSOC);
                            $id_etu_att = $row['ID_ETU'];
                            $Smt->closeCursor();//vider le curseur (free)
                            
                            if($id_etu_att)
                            {
                                ///Update in postuler with Retenue
                                $Smt = $bdd->prepare("UPDATE postuler SET STATU=? WHERE ID_ETU=? AND ID_OFFRE=?");
                                $Smt->execute(array('Retenue',$id_etu_att,$No_Accept['ID_OFFRE']) );
                                $Smt->closeCursor();//vider le curseur (free)
                                
                                ///Delete from liste attente 
                                $Smt = $bdd->prepare("DELETE FROM attente WHERE ID_ETU=? AND ID_OFFRE=? ");
                                $Smt->execute(array($id_etu_att,$No_Accept['ID_OFFRE']));
                                $Smt->closeCursor();//vider le curseur (free)
                            }
                        }
                   /// ***ID DE NIVEAU DE L'ETUDIANT
                   $sql_niveau = $bdd->prepare("SELECT NIVEAU FROM etudiant WHERE ID_ETU=? ");
                   $sql_niveau->execute(array($Etu));
                   $result_niveau = $sql_niveau->fetch(PDO::FETCH_ASSOC);
                   $NIVEAU = $result_niveau['NIVEAU'];
                   /// *** Inserer stage 
                   $Contract=NULL;
                   $sql_stage = $bdd->prepare("INSERT INTO stage(ID_OFFRE,ID_ETU,DATEDEBUT_STAGE,NIVEAU_STAGE,CONTRAT) VALUES(?,?,?,?,?)  ");
                   $sql_stage->execute(array($Offre_ID,$Etu,$curdate,$NIVEAU,$Contract));

            
                  header('location:../Soumissions_Etu.php');
                }
            
            }
            
                
        }
        else
        {
            header('location:../'.$_SESSION['main_page']);
        }

    }  
   



?>