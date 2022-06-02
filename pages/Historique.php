<?php
  ob_start();
  session_start();
  if( empty($_SESSION['user_id']) || empty($_SESSION['user_type']) )
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location: login.php');
  }
  
    
      require('back_end/connexion.php');
      $id_form = $_SESSION['user_id'];
      
      if($_SESSION['user_type'] == "Etudiant"){
         
        $sql = "SELECT ID_FORM FROM etudiant WHERE ID_ETU='$id_form' ";
        $req = $bdd->query($sql); 
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $id_form = $result['ID_FORM'] ;
      }
      $req = "SELECT NIVEAU_STAGE,NOM_ETU,PRENOM_ETU,POSTE,NOM_ENTREP FROM entreprise ent,offre o,stage s,etudiant etu  WHERE ent.ID_ENTREP =o.ID_ENTREP AND o.ID_OFFRE=s.ID_OFFRE AND s.ID_ETU = etu.ID_ETU AND o.ID_FORM='$id_form' ";
      
      if(isset($_POST['niveau_user']) ){
        
        $Niveau_user =$_POST['niveau_user'] ;
        if($Niveau_user)
          $req =$req." AND NIVEAU_STAGE='$Niveau_user' "; 
        
        $_SESSION['last_niveau_stage'] = $Niveau_user;
      }

      if(isset($_POST['Filter']) && !empty($_POST['Filter'])){
        
        $Filter_search = $_POST['Filter'];
        
        $req=$req." AND( (etu.NOM_ETU LIKE '$Filter_search' ) OR (etu.PRENOM_ETU LIKE '$Filter_search' ) OR (o.POSTE LIKE '$Filter_search' ) OR (ent.NOM_ENTREP LIKE '$Filter_search' ) )";
      }
      
      $Smt = $bdd->query($req);
      $rows = $Smt->fetchAll(PDO::FETCH_ASSOC);
      
    
  

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
    <title>Historique</title>
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
             
             <?php 
                    if($_SESSION['user_type'] == "Responsable")
                    {
             ?>  
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Find_Offre_Resp.php">Find offers</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="Historique.php">Historique</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Liste_Etudiant_Resp.php">Etudiants</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Liste_Enseignant_Resp.php">Enseignants</a>
              </li>
              <?php 
                    }else if($_SESSION['user_type'] == "Etudiant")
                    {
              ?>     
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Find_Offre_Etu.php">Find offers</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink active_link_color" href="Historique.php">Historique</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Soumissions_Etu.php">Soumissions</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="#">Stages</a>
              </li><?php }?>    
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
  

    <div class="container-fluid " >
      <div class="" style="margin-top: 100px; background-color:  #E5E5E5 !important;">
        <div class="row">

        <form action="Historique.php" method="post" id="form" >
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



        <div class="row">
            <div class="col-md-11 elm pub_col" style=" background: #FFFFFF !important;
                        border-radius: 35px !important; padding: 5%;">

                  <div class="tableHead" >
                        <h4>Liste des stages</h4>
                        <div class="select" style="display:flex; width:auto;">
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="niveau_user" >
                              <?php 
                              
                              if(isset($_SESSION['last_niveau_stage'] )){
                                switch($_SESSION['last_niveau_stage'] ){
                                  case 0:
                                    echo'<option value=0 selected>Tout</option>
                                        <option value=1  >1ere</option>
                                        <option value=2 >2eme</option>
                                        <option value=3>3eme</option>';
                                    break;
                                  case 1:
                                    echo '<option value=0 >Tout</option>
                                          <option value=1 selected >1ere</option>
                                          <option value=2>2eme</option>
                                          <option value=3>3eme</option>';
                                    break;
                                  case 2:
                                    echo '<option value=0 >Tout</option>
                                          <option value=1  >1ere</option>
                                          <option value=2 selected>2eme</option>
                                          <option value=3>3eme</option>';
                                    break;
                                  case 3:
                                          echo
                                              '<option value=0 >Tout</option>
                                              <option value=1  >1ere</option>
                                              <option value=2 >2eme</option>
                                              <option value=3 selected>3eme</option>';
                                    break;
                                
                                }
                                   unset($_SESSION['last_niveau_stage']);
                              }else{
                              
                              ?>
                              <option value=0 selected >Tout</option>
                              <option value=1  >1ere</option>
                              <option value=2 >2eme</option>
                              <option value=3>3eme</option><?php } ?>
                                      
                            </select>
                            <button type="submit" class="submit"></button>
                        </div>
                  </div>
                </form>
                  

                <table class="table" id="Table_Histo">
                    <thead>
                      <tr>
                        <th scope="col">N</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Poste</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                   
                    <?php foreach ($rows as $row): 
                    
                      ?>
                        <tr>
                          <th scope="row" style="color: #7096FF;"><?php echo $row['NIVEAU_STAGE'] ; ?></th>
                          
                          <td><?php echo $row['NOM_ETU']; ?></td>
                          <td><?php echo $row['PRENOM_ETU']; ?></td>
                          <td style="color: #7096FF;"><?php echo $row['POSTE']; ?></td>
                          <td style="color: #7096FF;"><?php echo $row['NOM_ENTREP']; ?></td>
                          <td style="text-align: end;">
                            <button type="button" class="btn btn-outline-primary">Rapport</button>
                            <button type="button" class="btn btn-outline-primary">Detail</button>
                          </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <th scope="col">N</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Poste</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col"></th>
                    </tfoot>
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

<script>
  
  $(document).ready( function () {
    var dataTable = $('#Table_Histo').DataTable();



    $('#Table_Histo tfoot tr th').each(function () {
    var title = $('#Table_Histo thead tr th').eq($(this).index()).text();
    if(title != "")
    {
      $(this).html('<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Search ' + title + '" />');
    }
    
    });

    dataTable.columns().every(function () {
        var dataTableColumn = this;

        $(this.footer()).find('input').on('keyup change', function () {
            dataTableColumn.search(this.value).draw();
        });
    });
    
    }
    )


</script>