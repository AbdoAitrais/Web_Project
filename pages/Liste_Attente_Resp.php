<?php 
  session_start();
  if(empty($_SESSION['user_id']) || empty($_SESSION['user_type']))
  {
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
    header('location:login.php');
  }  

  if($_SESSION['user_type'] == "Responsable")
  {
      require("back_end/connexion.php");

      if(isset($_GET['id_offre']) )
      {
        $id_offre=$_GET['id_offre'];

        /// *** Liste attentes
        $Smt = $bdd->prepare("SELECT e.ID_ETU,e.NOM_ETU,e.PRENOM_ETU,e.CNE FROM etudiant e,attente a WHERE e.ID_ETU=a.ID_ETU AND a.ID_OFFRE =? ORDER BY a.PRIORITE");
        $Smt->execute(array($id_offre));
        $rows = $Smt->fetchAll(PDO::FETCH_ASSOC);
        $Smt->closeCursor();//vider le curseur (free)

        /// *** Liste d'etudiants postulées
        $Smt1 = $bdd->prepare("SELECT e.ID_ETU,e.NOM_ETU,e.PRENOM_ETU,e.CNE FROM etudiant e,postuler p WHERE e.ID_ETU=p.ID_ETU AND p.ID_OFFRE =? AND p.STATU=? ");
        $Smt1->execute(array($id_offre ,'Postulée'));
        $rows1 = $Smt1->fetchAll(PDO::FETCH_ASSOC);
        $Smt1->closeCursor();//vider le curseur (free)
        


  
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <title>Liste d'attente</title>
    
    
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
        


        
          <div class="row" style="background-color: #FFFEFB; margin-top: 30px;">
            <div class="col-md-5 elm pub_col">
                  <div class="tableHead" >
                        <h4>Liste d'attente</h4>
                  </div>
                <table  id="table" class="table draggable-table">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CNE</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody id="tbdy">
                        <?php
                          if(!empty($rows))
                          {
                            foreach($rows as $attente_etu):
                         ?>
                        <tr>
                          <td style="color: #616161;"><?php print($attente_etu['NOM_ETU']);?></td>
                          <td style="color: #616161;"><?php print($attente_etu['PRENOM_ETU']);?></td>
                          <td style="color: #7196FF;"><?php print($attente_etu['CNE']);?></td>
                          <td style="text-align: end;">
                          
                          <form action="back_end/Liste_Attente_Gestion.php" method="post">
                               <input type="hidden" name="etu_supp" value="<?php print($attente_etu['ID_ETU']); ?>" >
                               <input type="hidden" name="id_offre" value="<?php print($id_offre);?>" >
                               <button type="submit" style="background:none;border: none;" ><i><img src="icons/rubbish-bin.png" alt=""></i></button>
                          </form>
                          </td>
                        </tr>
                        <?php endforeach;}?>
                    </tbody>
                  </table>
              </div>
          </div>


          <div class="row" style="margin-top: 30px;">
            <div class="col-md-5 elm pub_col">
                  <div class="tableHead" style="margin-bottom: 10px;">
                        <h4>Liste des etudiants postulée</h4>   
                  </div>
                  
                  <table class="table" id="Table_Etu">
                    <thead>
                      <tr>
                        
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">CNE</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          if(!empty($rows1))
                          {
                            foreach($rows1 as $postule_etu):
                      ?>
                        <tr> 
                          <td><?php print($postule_etu['NOM_ETU']);?></td>
                          <td><?php print($postule_etu['PRENOM_ETU']);?></td>
                          <td style="color: #7096FF;"><?php print($postule_etu['CNE']);?></td>
                          <td style="text-align: end;">  
                             <form action="back_end/Liste_Attente_Gestion.php" method="post">
                               <input type="hidden" name="etu_add" value="<?php print($postule_etu['ID_ETU']);?>" >
                               <input type="hidden" name="id_offre" value="<?php print($id_offre);?>" >
                               <button type="submit" style="background:none;border: none;" ><i><img src="icons/add-user.png" alt=""></i></button>
                            </form>
                          </td>
                        </tr>
                        <?php endforeach;}?>
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



  

</script>
    
</body>
</html>
<?php
      
    }else{
      echo "<h1>ERROR</h1><p>GET ID_OFFRE FAILED !</p>";
    }
  }
  else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }

?>

