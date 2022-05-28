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

      /// *** Les donnees de stages 
      $id_etu = $_GET['id_etu'];

      $sql1 = "SELECT NIVEAU_STAGE,NOM_ETU,PRENOM_ETU,CNE,POSTE,NOM_ENTREP FROM entreprise ent,offre o,stage s,etudiant etu  WHERE ent.ID_ENTREP =o.ID_ENTREP AND o.ID_OFFRE=s.ID_OFFRE AND s.ID_ETU = etu.ID_ETU AND etu.ID_ETU='$id_etu' AND s.DATEDEBUT_STAGE =(select max(DATEDEBUT_STAGE) FROM stage where ID_ETU='$id_etu')";
      $req1 =$bdd->query($sql1);
      $result1 = $req1->fetch(PDO::FETCH_ASSOC);

      /// *** Les donnees de jury 
      $sql2 = "SELECT NOM_ENS,PRENOM_ENS FROM juri j,enseignant e,stage s WHERE j.ID_STAGE = s.ID_STAGE AND j.ID_ENS = e.ID_ENS AND s.ID_ETU = '$id_etu' ";
      $req2 =$bdd->query($sql2);
      $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);

      /// *** Les donnees des enseignats
      $id_form = $_SESSION['user_id'];
      $sql3 = " SELECT e.ID_ENS,e.NOM_ENS,e.PRENOM_ENS
                FROM enseignant e
                WHERE e.ID_DEPART = (SELECT e1.ID_DEPART FROM formation f, enseignant e1 WHERE f.ID_ENS = e1.ID_ENS AND f.ID_FORM = '$id_form') 
                      AND e.ID_ENS NOT IN (SELECT j.ID_ENS FROM juri j,stage s WHERE j.ID_STAGE=s.ID_STAGE AND s.ID_ETU='$id_etu' AND s.DATEDEBUT_STAGE =(select max(DATEDEBUT_STAGE) FROM stage s1 where s1.ID_ETU='$id_etu') ); ";
      
      $req3 =$bdd->query($sql3);
      $result3 = $req3->fetchAll(PDO::FETCH_ASSOC);

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
                                <li><img src="icons/certificate.png" alt=""><a href="Notes_Resp?id_etu=<?php print($id_etu);?>">Notes</a> </li>
                                <li><img src="icons/application.png" alt=""><a href="">Rapport</a> </li>
                            </ul>

                            </div>
                          </td>
                        </tr>
                    </tbody>
                  </table>
              </div>
          </div>

          <div class="row" style="background-color: #FFFEFB; margin-top: 30px;">
            <div class="col-md-4 elm pub_col">

                <form action="ListeEtudiants.php" method="post" id="form" >
                  <div class="tableHead" >
                        <h4>Jury</h4>
                  </div>
                </form>
                  

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach($result2 as $jury) :?>
                        <tr>
                          <td style="color: #616161;"><?php print($jury['NOM_ENS'])?></td>
                          <td style="color: #616161;"><?php print($jury['PRENOM_ENS'])?></td>
                          <td style="text-align: end;">
                            <i><img src="icons/rubbish-bin.png" alt=""></i>
                          </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                  </table>
              </div>
          </div>

          <div class="row" style="background-color: #FFFEFB; margin-top: 20px;">
            <div class="col-md-4 elm pub_col">

                <form action="ListeEtudiants.php" method="post" id="form" >
                  <div class="tableHead" >
                        <h4>Liste des enseignants</h4>
                  </div>
                </form>
                  

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach($result3 as $enseignant) :?>
                        <tr>
                          <td style="color: #616161;"><?php print($enseignant['NOM_ENS'])?></td>
                          <td style="color: #616161;"><?php print($enseignant['NOM_ENS'])?></td>
                          <td style="text-align: end;">
                            <i><img src="icons/add-user.png" alt=""></i>
                          </td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
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
