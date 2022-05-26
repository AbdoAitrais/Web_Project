
<?php  
	ob_start();
	session_start();	
	require('connexion.php');
	

?>

<?php

	function get_user_id_type_mainPage($table_name,$id_table,$table_login,$table_pass,$main_page,$user_type,$name,$pass)
	{
		require('connexion.php');
		$Smt = $bdd->prepare("SELECT * FROM $table_name WHERE $table_login=? and $table_pass=?");
		$Smt -> execute(array($name,$pass));
		$rows = $Smt -> fetch();
		var_dump($name);
		var_dump($rows);
		
		
		$Smt->closeCursor();//vider le curseur (free)
		$results = array($rows[$id_table],$main_page,$user_type);//array contains id and main page and user type
		var_dump($results);
		return $results;
	}


	echo "test1";
	if( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['type_user']) )
	{
		echo "test2";
		
		
		$type_user = $_POST['type_user'];
		
		if ($type_user == "Etudiant")
		{
			$result = get_user_id_type_mainPage('etudiant','ID_ETU','LOGIN_ETU','PASS_ETU',
										'../Find_Offre_Etu.php','Etudiant',htmlspecialchars($_POST['username']),htmlspecialchars($_POST['password']));
		}
		else if ($type_user == "Responsable")
		{
			$result = get_user_id_type_mainPage('formation','ID_FORM','LOGIN_RESP','PASS_RESP',
										'../ListeEtudiants.php','Responsable',htmlspecialchars($_POST['username']),htmlspecialchars($_POST['password']));
		}
		else if ($type_user == "Admin")
		{
			$result = get_user_id_type_mainPage('admin','ID_ADMIN','LOGIN_ADMIN','PASS_ADMIN',
										'../admin.php','Admin',htmlspecialchars($_POST['username']),htmlspecialchars($_POST['password']));
		}
		
		var_dump($result);
		
		
		if( $result[0] != NULL )
		{
			echo "test3";
			
			$_SESSION['user_id'] = $result[0];
			$_SESSION['user_type'] = $result[2];

			
		 	if(isset($_SESSION['error']))
		 	{
		 		unset($_SESSION['error']);
		 	}

		 	if(!isset($_SESSION['page']))
		 		header('location:'.$result[1]);
		 	else
		 		header('location:'.$_SESSION['page']);
				
		}
		 else
		 {
		 	$_SESSION['error'] = 'Incorrect login !';
		 	header('location: ../login.php');
		 	echo "alo";
		}
	}
?>