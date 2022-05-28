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
    <title>Soumission Etudiants</title>
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
                <a class="nav-link navlink " href="Find_Offre_Etu.php">Find offers</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="#">Historique</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="Soumissions_Etu.php">Soumissions</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Mes stages</a>
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
          <form action="Soumissions_Etu.php" method='POST'>
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
         
            <?php require('back_end/connexion.php');
                ///*** Postulation Verification
                    
                    /// ***
                    $Etu=$_SESSION['user_id'];
                    /// ***Test S'il ya un offre en etat acceptee
                    
                    ///Niveau de l'etudiant
                    $sql1 ="SELECT NIVEAU FROM etudiant WHERE ID_ETU='$Etu' ";
                    $req1 =$bdd->query($sql1);
                    $result1 = $req1->fetch(PDO::FETCH_ASSOC);
                    $NIVEAU=$result1['NIVEAU'];
                    
                    ///Formation de l'etudiant
                    $sql7 ="SELECT ID_FORM FROM etudiant WHERE ID_ETU='$Etu' ";
                    $req7 =$bdd->query($sql7);
                    $result7 = $req7->fetch(PDO::FETCH_ASSOC);
                    $FORMATION=$result7['ID_FORM'];
                    
                    /// ***                      
                    function Create_Offres($result2 ,$Etat_Offre){
                        
                        require('back_end/connexion.php');
                        $Etu = $_SESSION['user_id'];  
                                          
                        if(!empty($result2))
                        {
                            foreach($result2 as $Offre):
                                               
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
                        
                        switch($Etat_Offre){
                            case 1:
                                echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">Acceptée</label>';
                                break;
                            case 2:
                                echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">Non Acceptée</label>';
                                break;
                            case 3:
                                echo'<a href="back_end/Statu_Post_Etu.php?offre_non_accepte='.$of_id.'"><button class="butt_style" style="background:lightgrey;" >REFUSER</button></a>';
                                echo"  ";
                                echo'<a href="back_end/Statu_Post_Etu.php?offre_accepte='.$of_id.'"><button class="butt_style" style="background:7096FF;">ACCEPTER</button></a>';
                                break;
                            case 4:
                                echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">Postulée</label>';
                                break;
                            case 5:
                                echo'<label style="text-align:end;text-decoration:underline;color: cornflowerblue;">Non Retenue</label>';
                                break;
                        }
                    ?>
                </div>
              </div>


            </div><br>
            <?php endforeach;} }
            
            /// ***
            $Filter_sql = "";
            /// ***
            if(isset($_POST['Filter']) && !empty( $_POST['Filter'] )){

                $Filter_search = $_POST['Filter'];
                $Filter_sql=" AND( ( E.VILLE = '$Filter_search' ) OR (O.POSTE = '$Filter_search' ) OR (O.DESCRIP LIKE '%$Filter_search%' ) OR (E.NOM_ENTREP LIKE '$Filter_search' ) OR (STATU LIKE '$Filter_search' ))";

            }
            /// *** SELECTION ET JOINTURE
            $select_join = "SELECT * FROM offre O,entreprise E,postuler P WHERE E.ID_ENTREP=O.ID_ENTREP AND O.ID_OFFRE = P.ID_OFFRE";

            /// *** Retenue
            $sql9 =$select_join." AND P.STATU='Retenue'".$Filter_sql;            
            $req9 =$bdd->query($sql9);
            $result9 = $req9->fetchAll(PDO::FETCH_ASSOC);
            Create_Offres($result9 , 3);
            
            /// *** Acceptée
            $sql6 =$select_join." AND P.STATU='Acceptée'".$Filter_sql;             
            $req6 =$bdd->query($sql6);
            $result6 = $req6->fetchAll(PDO::FETCH_ASSOC);
            Create_Offres($result6 , 1);
            
            /// *** Postulée
            $sql10 =$select_join." AND P.STATU='Postulée'".$Filter_sql;            
            $req10=$bdd->query($sql10);
            $result10 = $req10->fetchAll(PDO::FETCH_ASSOC);
            Create_Offres($result10 , 4);
            
            /// *** Non Acceptée
            $sql8 =$select_join." AND P.STATU='Non Acceptée'".$Filter_sql;             
            $req8 =$bdd->query($sql8);
            $result8 = $req8->fetchAll(PDO::FETCH_ASSOC);
            Create_Offres($result8 , 2);
            
            
            /// *** Non retenue
            $sql11 =$select_join." AND P.STATU='Non Retenue'".$Filter_sql;             
            $req11 =$bdd->query($sql11);
            $result11 = $req11->fetchAll(PDO::FETCH_ASSOC);
            Create_Offres($result11 , 5);

            ;?>            
          </div>
          <div class="col-3 d-none d-md-block elm blank_col"></div>
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
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }
?>

