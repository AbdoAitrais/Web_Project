<?php 
  ob_start();
  session_start();
  if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location:login.php');
  }
  
  if( $_SESSION['user_type'] == "Responsable")
  {

    require("back_end/connexion.php");

    if(isset($_GET['id_etu'])){

      $id_etu = $_GET['id_etu'];

      $sql1 = "SELECT NIVEAU_STAGE,NOM_ETU,PRENOM_ETU,CNE,POSTE,NOM_ENTREP FROM entreprise ent,offre o,stage s,etudiant etu  WHERE ent.ID_ENTREP =o.ID_ENTREP AND o.ID_OFFRE=s.ID_OFFRE AND s.ID_ETU = etu.ID_ETU AND etu.ID_ETU='$id_etu' AND s.DATEDEBUT_STAGE =(select max(DATEDEBUT_STAGE) FROM stage where ID_ETU='$id_etu')";
      $req1 =$bdd->query($sql1);
      $result1 = $req1->fetch(PDO::FETCH_ASSOC);
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
    <title>Encours</title>
</head>
<body>
      
      <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed" style="z-index: 9; width: 100%; top: 0;">
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
                <a class="nav-link navlink active_link_color" href="ListeEtudiants.php">Etudiants</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Enseignants</a>
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
      <div class="" style="margin-top: 140px;">
        


        <div class="row" style="background-color: #FFFEFB;">
            <div class="col-md-8 elm pub_col">

                <form action="ListeEtudiants.php" method="post" id="form" >
                  <div class="tableHead" >
                        <h4>Stage en cours</h4>
                  </div>
                </form>
                  

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">N</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CNE</th>
                        <th scope="col">Stage</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                   
                        <tr>
                          
                          <th scope="row" style="color: #7196FF"><?php print($result1['NIVEAU_STAGE'])?></th>
                          <td style="color: #616161;"><?php print($result1['NOM_ETU'])?></td>
                          <td style="color: #616161;"><?php print($result1['PRENOM_ETU'])?></td>
                          <td style="color: #7196FF;"><?php print($result1['CNE'])?></td>
                          <td style="color: #616161;"><?php print($result1['POSTE'])?>-<?php print($result1['NOM_ENTREP'])?></td>
                          <td class="opt">
                            <span onclick="menuToggle()">Options</span>
                            <div class="menu" id="mn1">
            
                            <ul>
                                <li><img src="icons/loupe.png" alt=""><a href="">Details</a> </li>
                                <li><img src="icons/teacher.png" alt=""><a href="">Encadrant</a> </li>
                                <li><img src="icons/jury.png" alt=""><a href="Jury_Resp?id_etu=<?php print($id_etu);?>">Jury</a> </li>
                                <li><img src="icons/certificate.png" alt=""><a href="Notes_Resp?id_etu=<?php print($id_etu);?>"  data-bs-toggle="modal" data-bs-target="#exampleModal">Notes</a> </li>
                                <li><img src="icons/application.png" alt=""><a href="">Rapport</a> </li>
                            </ul>
                            
                          </div>
                          </td>
                        </tr>
                    </tbody>
                  </table>
              </div>
          </div>
          




        </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel" style="color: #7096FF; font-weight: 600;">Notes</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding: 16px;  "><h5 style="border-bottom: 1px solid black;">Encadrants</h5></div>
                
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous">
      
      
      </script>
      <script>
        function menuToggle(){
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle('active');
        }
      </script>
    
</body>
</html>
<?php

}else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }

?>
