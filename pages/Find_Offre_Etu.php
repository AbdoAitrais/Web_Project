<?php 
  ob_start();
  session_start();
  if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location:login.php');
  }
  
  if( $_SESSION['user_type'] == "Etudiant")
  {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offre</title>
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
          <a class="navbar-brand navt d-lg-block d-lg-none" href="#">FSTAGE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ">
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="Find_Offre_Etu.php">Find offers</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Historique.php">Historique</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Soumissions_Etu.php">Soumissions</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Stages</a>
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
      <div class="" style="margin-top: 56px;">
        <div class="row">
          <div class="col-3 d-none d-md-block elm guid1_col"></div>
          <form action="Find_Offre_Etu.php" method='POST'>
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
         
            <?php require("back_end/connexion.php");
                ///*** Postulation Verification
                    /// ***
                    $Etu=$_SESSION['user_id'];
                    /// ***Test S'il ya un offre en etat acceptee
                    $Est_Accepte = 0;
                    
                    $sql6 ="SELECT * FROM postuler WHERE ID_ETU='$Etu'";
                    $req6 =$bdd->query($sql6);
                    $result6 = $req6->fetchAll(PDO::FETCH_ASSOC);   
                    if(!empty($result6)){

                        foreach($result6 as $Offre_Statu){
                          if($Offre_Statu['STATU'] == 'Acceptée'){
                               $Est_Accepte = 1;
                               break;
                          }
                        }
                    }

                    ///Niveau et Formation de l'etudiant
                    $sql1 ="SELECT NIVEAU,ID_FORM FROM etudiant WHERE ID_ETU='$Etu' ";
                    $req1 =$bdd->query($sql1);
                    $result1 = $req1->fetch(PDO::FETCH_ASSOC);
                    $NIVEAU=$result1['NIVEAU'];
                    $FORMATION=$result1['ID_FORM'];
                    
                  
                    
                    ///Tous les offres de cette etudiant
                    $sql2 ="SELECT * FROM offre O,entreprise E WHERE E.ID_ENTREP=O.ID_ENTREP AND O.NIVEAU_OFFRE='$NIVEAU' AND O.ID_FORM='$FORMATION' AND O.ID_OFFRE NOT IN(SELECT ID_OFFRE FROM postuler WHERE STATU!='Postulée')";
                    ///***Search bar
                    if(isset($_POST['Filter']) && !empty( $_POST['Filter'] )){

                      $Filter_search = $_POST['Filter'];
                      $sql2=$sql2." AND( (E.VILLE = '$Filter_search' ) OR (O.POSTE = '$Filter_search' ) OR (O.DESCRIP LIKE '%$Filter_search%' ) OR (E.NOM_ENTREP LIKE '$Filter_search' ) )";

                    }
                    /// ***Order by
                    $sql2=$sql2." ORDER BY O.ID_OFFRE DESC";
                    
                    /// ***  
                    $req2 =$bdd->query($sql2);
                    $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(!empty($result2))
                    {
                        foreach($result2 as $Offre):                  
            ?>
          
            <div class="brd">
              <?php
                  $Etat_Offre = 0;
                  
                  if($Offre['STATUOFFRE'] == 'Nouveau'){
                        echo '<div class="greenc"> </div> <br>'; 
                        $Etat_Offre = 1;
                  }else if($Offre['STATUOFFRE'] == 'Completée')
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
                        /// *** Postulee
                        $sql3 ="SELECT * FROM postuler WHERE  ID_ETU='$Etu' AND ID_OFFRE='$of_id' AND STATU='Postulée' ";
                        $req3 =$bdd->query($sql3);
                        $result3 = $req3->fetchAll(PDO::FETCH_ASSOC);

                        ///Test d'affichage
                        if((!$Etat_Offre) || ($Est_Accepte))    
                              echo'';
                        else if(!empty($result3))
                              echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">Postulée</label>';
                        else 
                              echo'<a href="back_end/Statu_Post_Etu.php?offre_post='.$of_id.'"><button class="butt_style" onClick="LastScroll()" >POSTULER</button></a>';
                     
                    ?>
                </div>
              </div>


            </div><br>
            <?php endforeach;} ?>            
          </div>
          <div class="col-3 d-none d-md-block elm blank_col"></div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <script>
      
      
      var scrollpos = localStorage.getItem('scrollpos_Find_Offre_Etu');
      if (scrollpos){
            window.scrollTo({left:0,top:scrollpos,behavior:'instant',});
            localStorage.removeItem('scrollpos_Find_Offre_Etu');
      }

      function LastScroll(){
        localStorage.setItem('scrollpos_Find_Offre_Etu', window.scrollY);
      }

    </script>

</body>
</html>

<?php
  }
  else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }
?>



