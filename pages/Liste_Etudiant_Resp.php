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
    
      $Smt = $bdd->prepare("SELECT * FROM etudiant e,users u WHERE e.ID_USER=u.ID_USER AND e.ID_FORM=? AND u.VERIFIED=1");
      $Smt -> execute(array($id_form));
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
    <title>Listes des Etudiants</title>
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
                <a class="nav-link navlink" href="Liste_Enseignant_Resp.php">Enseignants</a>
              </li>
              <li class="nav-item underline">
                <a class="nav-link navlink " href="Verify_Etudiant_Resp.php">Verification</a>
              </li>
            </ul>
            
            <div class="" style="position: fixed; margin-left: 47%;">
                  <a class="navbar-brand navt d-none d-lg-block" href="#">FSTAGE</a>
            </div>
            <div class="navbar-nav ms-auto margin action" style="margin-right:2.5%;">
              
              <img class="profile" onclick="menuToggle()" src="popup/img.jpg" alt="">
              
              <div class="menu" style="margin:5px;">
                  <h3>Someone Famous</h3>
              
                  <ul>
                      <li><a href=""><img src="popup/user.png" alt=""><a href="">My profile</a> </li>
                      <li><a href=""><img src="popup/envelope.png" alt=""><a href="">Inbox</a> </li>
                      <li><a href=""><img src="popup/question.png" alt="">Help</a> </li>
                      <li><a href="back_end/logout.php"><img src="popup/log-out.png" alt="">Log out</a> </li>
                  </ul>
              
               </div>

              </div>
          </div>
        </div>
      </nav>

    <div class="container-fluid ">
      <div class="" style="margin-top: 100px; background-color:  #E5E5E5 !important;">
        


        <div class="row" >
            <div class="col-md-11 elm pub_col" style=" background: #FFFFFF !important;
                        border-radius: 35px !important; padding: 5%;">

                  <div class="tableHead" >
                        <h4>Liste des etudiants</h4>   
                  </div>
                  

                <table class="table" id="Table_Etu">
                    <thead>
                      <tr>
                        <th scope="col">N</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CNE</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>

                   
                    <?php foreach ($rows as $row): 
                    
                      ?>
                        <tr>
                          <th scope="row" style="color: #7096FF;"><?php echo $row['NIVEAU'] ; ?></th>
                          <td><?php echo $row['NOM_ETU']; ?></td>
                          <td><?php echo $row['PRENOM_ETU']; ?></td>
                          <td style="color: #7096FF;"><?php echo $row['CNE']; ?></td>
                          <td style="text-align: end;">
                            <a href="Encours_Resp.php?id_etu=<?php echo $row['ID_ETU']; ?>"><button type="button" class="btn btn-outline-primary">En cours</button></a>
                            <a href="Soumis_Resp.php?id_etu=<?php echo $row['ID_ETU']; ?>" ><button type="button" class="btn btn-outline-primary">Soumissions</button></a>
                            <a href="Modifier_Etudiant_Resp.php?id_etu=<?php echo $row['ID_ETU']; ?>" ><button type="button" class="btn btn-outline-primary">Modifier</button></a>
                            <?php if($row['ACTIVE'] == 1){ ?>
                            <!-- <a href="back_end/Desactiver_account.php?id_etu_disac=<//?php echo $row['ID_ETU']; ?>"><button type="button" class="btn btn-outline-primary" >Desactiver</button></a> -->
                            <form action="back_end/Desactiver_account.php" method="post" style="display: inline-block;" >
                                <input type="hidden" name="id_etu_disac" value="<?php echo $row['ID_ETU']; ?>">
                                <button type="submit" class="btn btn-outline-primary" >Desactiver</button>
                            </form>
                            <?php }else{?>
                            <!-- <a href="back_end/Desactiver_account.php?id_etu_ac=<//?php echo $row['ID_ETU']; ?>"><button type="button" class="btn btn-outline-primary" >&nbsp;&nbsp;&nbsp;&nbsp;Activer&nbsp;&nbsp;&nbsp;</button></a> -->
                            <form action="back_end/Desactiver_account.php" method="post" style="display: inline-block;">
                                <input type="hidden" name="id_etu_ac" value="<?php echo $row['ID_ETU']; ?>">
                                <button type="submit" class="btn btn-outline-primary" >&nbsp;&nbsp;&nbsp;&nbsp;Activer&nbsp;&nbsp;&nbsp;</button>
                            </form>
                            <?php }?>
                          </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th scope="col">N</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CNE</th>
                        <th scope="col"></th>
                      </tr>
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
<?php
  }
  else
  {
    echo "<h1> ERROR 301:</h1> <p>Unauthorized Access !</p>";
  }

?>
<script>
  
  $(document).ready( function () {
    var dataTable = $('#Table_Etu').DataTable();



    $('#Table_Etu tfoot tr th').each(function () {
    var title = $('#Table_Etu thead tr th').eq($(this).index()).text();
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


    function menuToggle(){
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle('active');
        }
  

</script>