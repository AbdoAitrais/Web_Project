<?php 
  ob_start();
  session_start();
  if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location:login.php');
  }

  if($_SESSION['user_type'] == "Responsable")
  {

    require("back_end/connexion.php");

    $id_form = $_SESSION['user_id'];
                                
    ///Tous les offres de cette formation
    $Smt = $bdd->prepare("SELECT * FROM offre O,entreprise E WHERE E.ID_ENTREP=O.ID_ENTREP AND O.ID_FORM=? ORDER BY O.ID_OFFRE DESC");
    $Smt -> execute(array($id_form));
	  $rows = $Smt -> fetchAll(PDO::FETCH_ASSOC);
    $Smt->closeCursor();

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
    <title>Find Offers</title>
    
    
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
                <a class="nav-link navlink active_link_color" href="Find_Offre_Resp.php">Find offers</a><span class="active_link_line"></span>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Historique.php">Historique</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Liste_Etudiant_Resp.php">Etudiants</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink" href="Liste_Enseignant_Resp.php">Enseignants</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Verify_Etudiant_Resp.php">Verification</a>
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
                <a class="nav-link navlink blue " href="back_end/logout.php" title="logout">Log out</a>
              </li>
              <li class="nav-item back">
                <a class="nav-link navlink" href="#" title="profile"><img src="icons/account.png"></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <div class="container-fluid ">
      <div class="" style="margin-top: 150px;">
        


        
         


          <div class="row" >
            <div class="col-md-8 elm pub_col" style=" background: #FFFFFF !important;
                        border-radius: 35px !important; padding: 5%;">

                  <div class="tableHead" style="margin-bottom: 10px;">
                        <h4>Liste des offres</h4>
                        <a href="Publier_Offre_Resp.php"><button>Publier Offre</button></a>   
                  </div>
                  

                <table class="table" id="Table_Offre">
                    <thead>
                      <tr>
                         <th scope="col">N</th>
                         <th scope="col">Statut</th>
                        <th scope="col">Entreprise</th>
                        <th scope="col">Ville</th>
                        <th scope="col">Poste</th>
                        <th scope="col"></th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                        foreach ($rows as $row): 
                    ?>
                        <tr>
                            <th scope="row" style="color: #7096FF;"><?php echo $row['NIVEAU_OFFRE']; ?></th>
                            <?php
                              switch ($row['STATUOFFRE']) {
                                case 'Nouveau':
                                  $color = '#6FF5B5';
                                  break;
                                case 'Completée':
                                  $color = '#CAD2CE';
                                  break;
                                case 'Closed':
                                  $color = '#E160B5';
                                  break;
                                
                                default:
                                  $color = '#7096FF';
                                  break;
                              }
                            ?>
                            <td style="color: <?php echo $color; ?>;"><?php echo $row['STATUOFFRE']; ?></td>
                          <td><?php echo $row['NOM_ENTREP']; ?></td>
                          <td><?php echo $row['VILLE']; ?></td>
                          <td style="color: #7096FF;"><?php echo $row['POSTE']; ?></td>
                          <td style="text-align: end; ">
                            
                            <a href="#" data-bs-toggle="modal" data-bs-target="#offre<?php print($row['ID_OFFRE']);?>" title="detail" ><i style="margin-right: 15px;"><img src="icons/loupe.png" alt=""></i></a>
                            <a href="Modifier_Offre_Resp.php?id_offre=<?php echo $row['ID_OFFRE']; ?>" title="modifier"><i style="margin-right: 15px;"><img src="icons/edit.png" alt=""></i></a>
                            <a href="Liste_Attente_Resp.php?id_offre=<?php echo $row['ID_OFFRE']; ?>" title="attente"><i><img src="icons/file.png" alt=""></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th scope="col">N</th>
                          <th scope="col">Statut</th>
                          <th scope="col">Entreprise</th>
                          <th scope="col">Ville</th>
                          <th scope="col">Poste</th>
                          <th scope="col"></th>
                        </tr>
                      </tfoot>
                  </table>
              </div>
          </div>
          
          <!-- Detail -->
          <?php foreach($rows as $Offre): ?>
          
            <div class="modal fade"  id="offre<?php print($Offre['ID_OFFRE']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"  style="max-width:800px !important;" >
                <div class="modal-content" >
                  <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel" style="color: #7096FF; font-weight: 600;">Offre </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" >
                  <div class="col-md-12 elm pub_col">
                      <div class="brd">
                        <?php                  
                            if($Offre['STATUOFFRE'] == 'Nouveau')
                                  echo '<div class="greenc"> </div>'; 
                            else if($Offre['STATUOFFRE'] == 'Completée')
                                  echo '<div class="grayc"> </div>';
                            else if($Offre['STATUOFFRE'] == 'Closed')
                                  echo '<div class="redc"> </div>';  
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

                      </div><br>
                                 
                    </div>
                      
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                  </div>
                </div>
              </div>
            </div>
    
        </div>
        <?php endforeach;?>
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

<script>
  
  $(document).ready( function () {
    var dataTable = $('#Table_Offre').DataTable();



    $('#Table_Offre tfoot tr th').each(function () {
    var title = $('#Table_Offre thead tr th').eq($(this).index()).text();
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
    
</body>
</html>
<?php
  }
  else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }

?>

