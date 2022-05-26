<?php 
session_start();
if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
{
  header('location:login.php');
  $_SESSION['page'] = $_SERVER['REQUEST_URI'];
}
    

if($_SESSION['user_type'] == "Responsable")
{

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumission Responsable</title>
    <link rel="stylesheet" href="pub_etud.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>

  
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed" style="z-index: 9; width: 100%; top: 0;">
        <div class="container-fluid">
          <a class="navbar-brand navt" href="#">FSTAGE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
              <li class="nav-item underline">
                <a class="nav-link navlink " href="#">Find offers</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Historique</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="ListeEtudiants.php">Etudiants</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Enseignants</a>
              </li>
            </ul>
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
      </nav>
    </div>

    <div class="container-fluid ">
      <div class="" style="margin-top: 60px;">
        <div class="row">
          <div class="col-3 d-none d-md-block elm guid1_col"></div>
          <div class="col-md-6 col-sm-12 elm pub_col" style="position:fixed; text-align: center; display:flex; justify-content:center;">
           
          <div class="search">
              <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Type a Keyword, Title, City" aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                  <i class="fas fa-search"><img src="icons/search.png"></i>
                </span>
              </div>
            </div>

          </div>
          <div class="col-3 d-none d-md-block elm blank_col"></div>
        </div>

        <div class="row" style="margin-top: 56px;">
          <div class="col-12  d-md-none elm">

            <div class="greenc" style="display:inline-block;margin-left: 0%;">
                 <span class="guide2"> Nouveau </span>
            </div>

            <div class="grayc" style="display:inline-block; margin-left: 27%;">
                 <span class="guide2"> Complétée </span> 
            </div>

            <div class="redc" style="display:inline-block; margin-left: 34%;">
              <span class="guide2">Close</span>
            </div>

          </div>
        </div>


        <div class="row">

          <div class="col-3 d-none d-md-block elm guid1_col">
            <div class="guid2_col">

              <div class="greenc"> 
                <span class="guide"> Nouveau </span>
              </div> <br>

              <div class="grayc"> 
                <span class="guide"> Complétée </span>
              </div> <br>

              <div class="redc"> 
                <span class="guide">Close</span>
              </div> <br>

            </div>
          </div>
          
          <div class="col-md-6 col-sm-12 elm pub_col">

<?php  require('back_end/connexion.php');

    if(isset($_GET['id_etu']))
    {
      $Resp = $_SESSION['user_id'];
      $id_etu = $_GET['id_etu'];

      $sql2 ="SELECT * FROM postuler p,offre o,entreprise e WHERE p.ID_OFFRE = o.ID_OFFRE AND o.ID_ENTREP =e.ID_ENTREP AND p.STATU='Postulée' AND  o.ID_FORM='$Resp' AND p.ID_ETU='$id_etu' ";
      $req2 =$bdd->query($sql2);
      $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);

     if(!empty($result2)){
            
            foreach($result2 as $Offre):                  
            ?>
          
            <div class="brd">
              <?php
                  if($Offre['STATUOFFRE'] == 'Nouveau')
                        echo '<div class="greenc"> </div> <br>'; 
                  else if($Offre['STATUOFFRE'] == 'Completée')
                        echo '<div class="redc"> </div> <br>';
                  else if($Offre['STATUOFFRE'] == 'Closed')
                        echo '<div class="grayc"> </div> <br>';  
              ?>
              

              <div class="content">

                <span class="poste" ><?php print($Offre['POSTE'])?></span> <br><br>

                <span class="ville" ><?php print($Offre['NOM_ENTREP'])?> - <?php print($Offre['VILLE'])?></span> <br>

                <span class="duree" >(Durée <?php print($Offre['DUREE']/30);?> months)</span> <br><br>

                <div class="desc" >
                  <p><?php print($Offre['DESCRIP']);?></p>
                </div>

                <div>
                  <span class="time"> <img src="icons/time.png" alt=""> <?php print($Offre['DATEFIN']);?> </span>
                </div>

              </div>
    
              <div class="butt_align">
                <div style="text-align:end;">
                    <?php
                        $of_id = $Offre['ID_OFFRE'];
                        echo '<a href="back_end/Statu_Post_Resp.php?Post_Non_Retenue='.$of_id.'"><button class="butt_style" style="background:lightgrey;">NON RETENUE</button></a>';
                        echo"  ";
                        echo '<a href="back_end/Statu_Post_Resp.php?Post_Retenue='.$of_id.'"><button class="butt_style" style="background:7096FF;">RETENUE</button></a>';
                        
                    ?>
                </div>
              </div>


            </div><br>
            <?php 
              endforeach;}
              } 
              else
              {
                echo "couldn't get data !";
              }
            ?>            
          </div>
          <div class="col-3 d-none d-md-block elm blank_col"></div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <script>
       document.addEventListener("DOMContentLoaded", function() { 
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo({left:0,top:scrollpos,behavior:'instant',});
        });

        window.onbeforeunload = function() {
            localStorage.setItem('scrollpos', window.scrollY);
        };

</script>
<?php

  }
  else
  {
    echo "<h1> ERROR 301:</h1> <p>Unauthorized Access !</p>";
  }

?>
















