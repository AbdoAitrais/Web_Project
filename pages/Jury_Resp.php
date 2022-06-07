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
      if(!empty($_GET['id_stage']))
      {
        ///Stage encours
        $id_stage = $_GET['id_stage'];
        $sql1 = "SELECT NIVEAU_STAGE,NOM_ETU,PRENOM_ETU,CNE,POSTE,NOM_ENTREP,NOTENCAD_ENTREP FROM entreprise ent,offre o,stage s,etudiant etu  WHERE ent.ID_ENTREP =o.ID_ENTREP AND o.ID_OFFRE=s.ID_OFFRE AND s.ID_ETU = etu.ID_ETU  AND s.ID_STAGE='$id_stage'";
        $req1 =$bdd->query($sql1);
        $result1 = $req1->fetch(PDO::FETCH_ASSOC);

        ///*** LES JURY
        $sql2 = "SELECT e.ID_ENS,e.NOM_ENS,e.PRENOM_ENS FROM juri j,enseignant e,stage s WHERE j.ID_STAGE = s.ID_STAGE AND j.ID_ENS = e.ID_ENS AND s.ID_STAGE = '$id_stage' ORDER BY e.NOM_ENS ";
        $req2 =$bdd->query($sql2);
        $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);
        
        ///Enseignants dans la modale
        $id_form = $_SESSION['user_id'];
        $sql3 ="SELECT e.ID_ENS,e.NOM_ENS,e.PRENOM_ENS
                FROM enseignant e
                WHERE e.ID_DEPART = (SELECT e1.ID_DEPART FROM formation f, enseignant e1 WHERE f.ID_ENS = e1.ID_ENS AND f.ID_FORM = '$id_form') 
                      AND e.ID_ENS NOT IN (SELECT ID_ENS FROM juri WHERE ID_STAGE = '$id_stage')  ORDER BY e.ID_ENS";
      
        $req3 =$bdd->query($sql3);
        $result3 = $req3->fetchAll(PDO::FETCH_ASSOC);


        ///L'Encadrant
        $sql4= "SELECT e.ID_ENS,e.NOM_ENS,e.PRENOM_ENS,s.NOTENCAD FROM enseignant e,stage s WHERE s.ID_ENS = e.ID_ENS AND s.ID_STAGE = '$id_stage' ";
        $req4 =$bdd->query($sql4);
        $result4 = $req4->fetch(PDO::FETCH_ASSOC);

        ///Jury
        $sql5 = "SELECT e.ID_ENS,e.NOM_ENS,e.PRENOM_ENS,j.NOTE FROM enseignant e,juri j WHERE j.ID_ENS = e.ID_ENS AND j.ID_STAGE = '$id_stage' ORDER BY e.ID_ENS ";
        $req5 =$bdd->query($sql5);
        $result5 = $req5->fetchAll(PDO::FETCH_ASSOC);

        
        /// Last visited page 
        $_SESSION['Last_visite'] =$_SERVER['REQUEST_URI']; 
    
    

    
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
      <div class="" style="margin-top: 140px;">
        


        <div class="row" style="background-color: #FFFEFB;">
            <div class="col-md-8 elm pub_col">

                <form action="Liste_Etudiant_Resp.php" method="post" id="form" >
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
                          <?php if(!empty($result1['NIVEAU_STAGE'])){?>
                          <th scope="row" style="color: #7196FF"><?php print($result1['NIVEAU_STAGE'])?></th>
                          <td style="color: #616161;"><?php print($result1['NOM_ETU'])?></td>
                          <td style="color: #616161;"><?php print($result1['PRENOM_ETU'])?></td>
                          <td style="color: #7196FF;"><?php print($result1['CNE'])?></td>
                          <td style="color: #616161;"><?php print($result1['POSTE'])?>-<?php print($result1['NOM_ENTREP']);?></td>
                          <td class="opt">
                            <span onclick="menuToggle()">Options</span>
                            <div class="menu" id="mn1">
            
                              <ul>
                                <li><img src="icons/loupe.png" alt=""><a href="">Details</a> </li>
                                <li><img src="icons/teacher.png" alt=""><a href="">Encadrant</a> </li>
                                <li><img src="icons/jury.png" alt=""><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Jury</a> </li>
                                <li><img src="icons/certificate.png" alt=""><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Notes</a> </li>
                                <li><img src="icons/application.png" alt=""><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">Rapport</a> </li>
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

                <form action="Liste_Etudiant_Resp.php" method="post" id="form" >
                  <div class="tableHead" style="display:flex;justify-content:space-between;">
                        <h4>Jury</h4>
                        <i><img src="icons/add-user.png" alt="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
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

                        <?php 
                          if(!empty($result2)){
                              foreach($result2 as $Jury):
                          
                          ?>
                        <tr>
                          <td style="color: #616161;"><?php print($Jury['NOM_ENS']);?></td>
                          <td style="color: #616161;"><?php print($Jury['PRENOM_ENS']);?></td>
                          <td style="text-align: end;">
                            <!-- <a href="back_end/Jury_Ens_Resp.php?jury_supp=<?php print($Jury['ID_ENS']);?>&id_stage=<?php print($id_stage);?>"> -->
                            <form action="back_end/Jury_Ens_Resp.php" method="post" style="display: inline-block;" >
                              <input type="hidden" name="id_stage" value="<?php print($id_stage);?>">
                              <input type="hidden" name="jury_supp" value="<?php print($Jury['ID_ENS']);?>" >
                              <button type="submit" style="background:none;border: none;"><i><img src="icons/rubbish-bin.png" alt=""></i></a></button>
                            </form>
                          </td>
                        </tr>
                        <?php endforeach;}?>
                        <?php }?>
                    </tbody>
                  </table>
              </div>
          </div>

          <form action="back_end/Jury_Ens_Resp.php" method="post">
            <div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
                <div class="modal-content" >
                  <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel" style="color: #7096FF; font-weight: 600;">Enseignants</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="max-height: 300px;">
                    <table class="hovtr">
                      <?php
                          if(!empty($result3)){
                              foreach($result3 as $Ens):
                          
                      ?>
                      <tr style="height: 50px;">
                        <td><?php print($Ens['NOM_ENS'])?></td>
                        <td><?php print($Ens['PRENOM_ENS'])?></td>
                        <td style="text-align: end;">
                          <input type="hidden" name="id_stage" value="<?php print($id_stage);?>">
                          <input class="form-check-input" type="checkbox" name='jury_add[<?php print($Ens['ID_ENS']);?>]' id="flexCheckDefault">
                        </td>
                      </tr>
                      <?php endforeach;}?>
                      
                    </table>
                </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        <form action="back_end/Notes_Stage_Resp.php?id_stage=<?php print($id_stage);?>" method="post">
          <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="staticBackdropLabel" style="color: #7096FF; font-weight: 600;">Notes</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div style="padding: 16px;  ">
                  <h5 style="border-bottom: 1px solid #717171; color: #717171; font-weight: 600;">Encadrants</h5>
                  <table style="width: 100%; color: #616161;">
                    <tr style="height: 50px;">
                      <?php if(!empty($result4)){?>
                      <td><?php print($result4['NOM_ENS']);?></td>
                      <td><?php print($result4['PRENOM_ENS']);?></td>
                      <td style="text-align: end;">Note <input type="number" step="0.01" min="0" max="20" value="<?php print($result4['NOTENCAD']);?>" name="note_encad" style="width: 60px; margin-left: 5px; border: 1px solid #B3B3B3;"></td>
                      <?php }?>
                    </tr>
                    <tr style="height: 50px;">
                      <td colspan="2">Entreprise</td>
                  <td style="text-align: end;">Note <input type="number" step="0.01" min="0" max="20" value="<?php print($result1['NOTENCAD_ENTREP']);?>" name="note_entrep" style="width: 60px; margin-left: 5px; border: 1px solid #B3B3B3;"></td>
                    </tr>
                  </table>
                </div>
                
                <div style="padding: 16px;  ">
                  <h5 style="border-bottom: 1px solid #717171; color: #717171; font-weight: 600;">Jury</h5>
                  <table style="width: 100%; color: #616161;">
                      
                      <?php if(!empty($result5)){
                          foreach($result5 as $Jury):
                      ?>
                      <tr style="height: 50px;">
                        <td><?php print($Jury['NOM_ENS']);?></td>
                        <td><?php print($Jury['PRENOM_ENS']);?></td>
                        <td style="text-align: end;">Note <input type="number" step="0.01" min="0" max="20"  value ="<?php print($Jury['NOTE']);?>" name="notes_jury[]" style="width: 60px; margin-left: 5px; border: 1px solid #B3B3B3;"></td>
                      </tr>
                      <?php endforeach;}?>
                  </table>
                </div>
                 <!-- Jury array -->
                 <input type='hidden' name='jury_array' value="<?php echo htmlentities(serialize($result5)); ?>" />
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <!-- RAPPORT -->
        <form action="back_end/Rapport_Stage_Resp.php" method="post" enctype="multipart/form-data">
          <div class="modal fade"  id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"  style="width: 400px;" >
                <div class="modal-content" >
                  <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel" style="color: #7096FF; font-weight: 600;">Rapport</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" style="max-height: 300px;">
                      
                        <label class="file">
                          <input type="file" class="form-control" id="rapport" name="rapport" >
                        </label>
                        <div style="display: flex;">
                          <h5 style="border-bottom: 1px solid #717171; color: #717171; font-weight: 600; margin-top: 25px; border-bottom: none; text-decoration: underline;">Mots clés :</h5>
                          <div id="inp" style="margin-top: 20px; margin-left: 20px;">
                              <input type="text" name='motscle[]' class="inp"><br>
                              <input type="text" name='motscle[]' class="inp"><button id="bt" class="todo-app-btn" onclick="add()"><i class="bi bi-plus-lg"></i> Add </button><br>
                          </div>
                      </div>
                </div>
                  
                  <div class="modal-footer">
                    <input type="hidden" name="id_stage" value="<?php print($id_stage); ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>
                </div>
              </div>
            </div>
        </form>

          
          



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
        echo "<h1>ERROR 301</h1> <p>Pas de stage encours</p>";
      }
}else
  {
    echo "<h1>ERROR 301</h1> <p>Unauthorized Access !</p>";
  }

?>
