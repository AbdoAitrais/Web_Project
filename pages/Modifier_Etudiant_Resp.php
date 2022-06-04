<?php
  ob_start();
  session_start();
  if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location: login.php');
  }
  
    if($_SESSION['user_type'] == "Responsable")
    {
      require('back_end/connexion.php');
    
      if( !empty($_GET['id_etu']) )
      {
        $id_etu = htmlspecialchars($_GET['id_etu']);
        $Smt = $bdd->prepare("SELECT * FROM etudiant WHERE ID_ETU=?");
        $Smt -> execute(array($id_etu));
        $rows = $Smt -> fetch();
      }

      

      if( !empty($_POST['nom_etu']) )
      { echo "<br><br><br><br>kakakaka";
        $target_dir = "uploads/cv/";
        $target_file = $target_dir . basename($_FILES["cv"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $cv = NULL;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["cv"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["cv"]["size"] > 10000000) {
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
          if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["cv"]["name"])). " has been uploaded.";
            $cv = "uploads/cv/".htmlspecialchars( basename( $_FILES["cv"]["name"]));
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
       
        $id_etu = htmlspecialchars($_POST['id_etu']);
        $nom_etu = htmlspecialchars($_POST['nom_etu']);
        $prenom_etu = htmlspecialchars($_POST['prenom_etu']);
        $email_etu = htmlspecialchars($_POST['email_etu']);
        $cin_etu = htmlspecialchars($_POST['cin_etu']);
        $cne = htmlspecialchars($_POST['cne']);
        $adresse_etu = htmlspecialchars($_POST['adresse_etu']);
        $numtel_etu = htmlspecialchars($_POST['numtel_etu']);
        $niveau = htmlspecialchars($_POST['niveau']);
        $promotion = htmlspecialchars($_POST['promotion']);
        $datenaiss_etu = htmlspecialchars($_POST['datenaiss_etu']);
        

        $Smt = $bdd->prepare("UPDATE etudiant SET NOM_ETU=? , PRENOM_ETU=? , EMAIL_ETU=? , CIN_ETU=? , CNE=? , ADRESSE_ETU=? ,
        NUMTEL_ETU=? , NIVEAU=? , PROMOTION=? , DATENAISS_ETU=? , CV=? WHERE ID_ETU=?");
        $Smt -> execute(array($nom_etu,$prenom_etu,$email_etu,$cin_etu,$cne,$adresse_etu,$numtel_etu,$niveau,$promotion,$datenaiss_etu,$cv,$id_etu));
        
        header('location:Liste_Etudiant_Resp.php');

      }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ListeEtudiants.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <title>Listes des Etudiants</title>
</head>
<body>
      
    <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed" style="z-index: 9; width: 100%; top: 0;background: #F3F5F8 !important;">
        <div class="container-fluid">
          <a class="navbar-brand navt d-lg-block d-lg-none" href="#">FSTAGE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Find_Offre_Resp.php">Find offers</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Historique.php">Historique</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="Liste_Etudiant_Resp.php">Etudiants</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Liste_Enseignant_Resp.php">Enseignants</a>
              </li>
            </ul>
            
            <div class="" style="position: fixed; margin-left: 47%;">
                  <a class="navbar-brand navt d-none d-lg-block" href="#">FSTAGE</a>
            </div>
            <ul class="navbar-nav ms-auto margin ">
              <li class="nav-item back">
                <a class="nav-link navlink" href="#"><img src="icons/notification.png"></a>
              </li>
              <li class="nav-item back">
                <a class="nav-link navlink blue" href="#">Contact Us</a>
              </li>
              <li class="nav-item back">
                <a class="nav-link navlink blue " href="back_end/logout.php">Log out</a>
              </li>
              <li class="nav-item back">
                <a class="nav-link navlink" href="#"><img src="icons/account.png"></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

        <div class="container-fluid ">
          <div class="" style="margin-top: 60px;">



            <div class="row" style="margin-top:8%;" >
              <div class="col-md-10 elm pub_col">

                    <div class="tableHead" >
                          <h4>Modifier Etudiant</h4>
                          
                    </div>

                    <form action="Modifier_Etudiant_Resp.php" method="post" enctype="multipart/form-data" style="display:flex; justify-content:space-around;">
                        <div class="form-row"  >
                          
                        <div>
                          <div class="form-group col-md-20">
                              <label for="Nom">Nom</label>
                              <input type="text" class="form-control" id="Nom" placeholder="Nom" value="<?php echo $rows['NOM_ETU']; ?>" name="nom_etu" >
                            </div>
                          </div>
                          <div class="form-group col-md-20">
                            <label for="inputPrenom">Prenom</label>
                            <input type="text" class="form-control" id="inputPrenom" placeholder="Prenom" value="<?php echo $rows['PRENOM_ETU']; ?>" name="prenom_etu">
                          </div>
                          <div class="form-group col-md-20">
                              <label for="inputEmail4">Email</label>
                              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?php echo $rows['EMAIL_ETU']; ?>" name="email_etu" >
                            </div>
                            <div class="form-group col-md-20">
                              <label for="Cin">Cin</label>
                              <input type="text" class="form-control" id="Cin" placeholder="Cin" value="<?php echo $rows['CIN_ETU']; ?>" name="cin_etu">
                            </div>
                            <div class="form-group col-md-20">
                              <label for="Cne">Cne</label>
                              <input type="text" class="form-control" id="Cne" placeholder="Cne" value="<?php echo $rows['CNE']; ?>" name="cne">
                            </div>
                          <div class="form-group col-md-20">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" id="Address" placeholder="Apartment, studio, or floor" value="<?php echo $rows['ADRESSE_ETU']; ?>" name="adresse_etu">
                          </div>
                        </div>
                        <div>
                          <div class="form-row">
                            <div class="form-group col-md-20">
                              <label for="tel">Telephone</label>
                              <input type="text" class="form-control" id="tel" placeholder="+212 7********" value="<?php echo $rows['NUMTEL_ETU']; ?>" name="numtel_etu">
                            </div>
                            <div class="form-group col-md-20">
                              <label for="inputState">Niveau</label>
                              <select id="inputState" class="form-control" name="niveau">
                                <?php
                                  switch( $rows['NIVEAU'] ){
                                    case 1:
                                      echo '
                                            <option value=1 selected >1ere</option>
                                            <option value=2>2eme</option>
                                            <option value=3>3eme</option>';
                                      break;
                                    case 2:
                                      echo '
                                            <option value=1  >1ere</option>
                                            <option value=2 selected>2eme</option>
                                            <option value=3>3eme</option>';
                                      break;
                                    case 3:
                                            echo
                                                '
                                                <option value=1  >1ere</option>
                                                <option value=2 >2eme</option>
                                                <option value=3 selected>3eme</option>';
                                      break;
                                  
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group col-md-20">
                              <label for="Promotion">Promotion</label>
                              <input type="text" class="form-control" id="Promotion" value="<?php echo $rows['PROMOTION']; ?>" name="promotion">
                              <label for="date">Date de naissance</label>
                              <input type="date" class="form-control" id="date" value="<?php echo $rows['DATENAISS_ETU']; ?>" name="datenaiss_etu">
                              <label for="cv">CV</label>
                              <input type="file" class="form-control" id="cv" name="cv" >
                              <input type="hidden" value="<?php echo $rows['ID_ETU']; ?>" name="id_etu"/>
                            </div>
                          </div><br>
                          <button type="submit" class="btn btn-outline-primary">Submit</button></a>
                        </div>
                      </form>
            
              </div>
            </div>

          </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
          
    
</body>
</html>
<?php
  }
  else
  {
    echo "<h1> ERROR 301:</h1> <p>Unauthorized Access !</p>";
  }

?>
<script>
  
  function changeFunc() 
  {
    document.getElementById("form").submit();
  }


</script>