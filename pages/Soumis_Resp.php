<?php 
  session_start();
  if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location:login.php');
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
      <div class="" style="margin-top: 60px;">
        <div class="row">
          <div class="col-3 d-none d-md-block elm guid1_col"></div>
          <form action="Soumis_Resp.php?id_etu=<?php if(isset($_GET['id_etu']))print($_GET['id_etu']);?>" method='POST'>
            <div class="col-md-6 col-sm-12 elm pub_col" style="position:fixed; text-align: center; display:flex; justify-content:center;">
              <div class="search">
                  <div class="input-group rounded">
                      <input type="search" class="form-control rounded" name='Filter' placeholder="Type a Keyword, Title, City" aria-label="Search" aria-describedby="search-addon" />
                      <span class="input-group-text border-0" id="search-addon">
                          <button type='submit' style="border:none;background:none;"><i class="fas fa-search"><img src="icons/search.png"></i></button>
                      </span>
                  </div>
                </div>
              </div>
          </form>
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

      $sql ="SELECT * FROM postuler p,offre o,entreprise e WHERE p.ID_OFFRE = o.ID_OFFRE AND o.ID_ENTREP =e.ID_ENTREP  AND  o.ID_FORM='$Resp' AND p.ID_ETU='$id_etu' ";
      
      ///***Search bar
      if(isset($_POST['Filter']) && !empty( $_POST['Filter'] )){

          $Filter_search = $_POST['Filter'];
          $sql=$sql." AND( (e.VILLE = '$Filter_search' ) OR (o.POSTE = '$Filter_search' ) OR (o.DESCRIP LIKE '%$Filter_search%' ) OR (e.NOM_ENTREP LIKE '$Filter_search' ) OR (p.STATU LIKE '$Filter_search' ) )";
        
      }
      /// ***Order by
      $sql=$sql." ORDER BY o.ID_OFFRE DESC";
      $req =$bdd->query($sql);
      $result = $req->fetchAll(PDO::FETCH_ASSOC);
      

     if(!empty($result)){
            
            foreach($result as $Offre):                  
            ?>
          
            <div class="brd">
              <?php
                  if($Offre['STATUOFFRE'] == 'Nouveau')
                        echo '<div class="greenc"> </div> <br>'; 
                  else if($Offre['STATUOFFRE'] == 'Completée')
                        echo '<div class="grayc"> </div> <br>';
                  else if($Offre['STATUOFFRE'] == 'Closed')
                        echo '<div class="redc"> </div> <br>';  
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
                        $sql_statu = "SELECT STATU FROM postuler WHERE ID_OFFRE ='$of_id' AND ID_ETU='$id_etu' ";
                        $req_statu =$bdd->query($sql_statu);
                        $result_statu = $req_statu->fetch(PDO::FETCH_ASSOC);
                        if(!empty($result_statu)){
                          
                          $Statu_etu =  $result_statu['STATU'];
                          if($Statu_etu == 'Postulée'){
                              echo '<a href="back_end/Statu_Post_Resp.php?Post_Non_Retenue='.$of_id.'&id_etu='.$id_etu.'"><button class="butt_style" style="background:lightgrey;" onClick="LastScroll()">NON RETENUE</button></a>';
                              echo"  ";
                              echo '<a href="back_end/Statu_Post_Resp.php?Post_Retenue='.$of_id.'&id_etu='.$id_etu.'"><button class="butt_style" style="background:7096FF;" onClick="LastScroll()">RETENUE</button></a>';
                          }else{
                              echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">'.$Statu_etu.'</label>';
                          }
                          
                        }
                        
                        
                        
                    ?>
                </div>
              </div>


            </div><br>
            <?php 
              endforeach;}
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
      var scrollpos = localStorage.getItem('scrollpos_Soumis_Resp');
      
      if (scrollpos){
            window.scrollTo({left:0,top:scrollpos,behavior:'instant',});
            localStorage.removeItem('scrollpos_Soumis_Resp');
      }

      function LastScroll(){
        localStorage.setItem('scrollpos_Soumis_Resp', window.scrollY);
      }

    </script>
<?php

  }
  else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }

?>
















