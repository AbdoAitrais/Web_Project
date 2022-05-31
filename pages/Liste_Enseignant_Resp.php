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
      $id_form = $_SESSION['user_id'];
    
      $req = "SELECT * FROM enseignant WHERE ID_DEPART IN (SELECT ID_DEPART FROM enseignant e, formation f WHERE f.ID_ENS = e.ID_ENS AND ID_FORM=?)";
      
      
      

      $Smt = $bdd->prepare($req);
      $Smt -> execute(array($id_form));
	  $rows = $Smt -> fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nextab.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <title>Listes des Enseignants</title>
</head>
<body>
      
    <nav class="navbar navbar-expand-lg navbar-light bg-light position-fixed" style="z-index: 9; width: 100%; top: 0; background: #F3F5F8 !important;">
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
      <div class="" style="margin-top: 100px; background-color:  #E5E5E5 !important;">
        <div class="row">
        <form action="Liste_Etudiant_Resp.php" method="post" id="Form_Ens" >
            <div class="col-md-6 col-sm-12 elm pub_col" style="background: #E5E5E5 !important; display: flex; justify-content: center;">
              
              
              <div class="search">
                <div class="input-group rounded">
                  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="Filter"/>
                  <span class="input-group-text border-0" id="search-addon">
                  <button type='submit' style="border:none;background:none;"><i class="fas fa-search"><img src="icons/search.png"></i></button>
                  </span>
                </div>
              </div>
              
            </div>
        </div>


        <div class="row" >
            <div class="col-md-10 elm pub_col" style=" background: #FFFFFF !important;
                        border-radius: 35px !important; padding: 5%;">

                  <div class="tableHead" >
                        <h4>Liste des enseignants</h4>

                  </div>
                </form>
                  

                <table class="table" id="MaTab">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CIN</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                   
                    <?php foreach ($rows as $row): 
                    
                      ?>
                        <tr>
                         
                          <td><?php echo $row['NOM_ENS']; ?></td>
                          <td><?php echo $row['PRENOM_ENS']; ?></td>
                          <td style="color: #7096FF;"><?php echo $row['CIN_ENS']; ?></td>
                          <td style="text-align: end;">
                            <a href="Modifier_Enseignant_Resp.php?id_etu=<?php echo $row['ID_ENS']; ?>" ><button type="button" class="btn btn-outline-primary">Modifier</button></a>
                            <button type="button" class="btn btn-outline-primary">Desactiver</button>
                          </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
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
  
  $(document).ready( function () {
    $('#MaTab').DataTable();
} );


</script>