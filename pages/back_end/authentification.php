
<?php  

		ob_start();
		session_start();

		$server = "localhost";//specifier le port si vous utiliser plusieurs serveurs
		$dataB = "bd_fstage";
		$dsn = "mysql:host=$server;dbname=$dataB";
		$user = "root";
		$password = "";

		try
		{
			$bdd = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			echo "test0";
		}
		catch (PDOException $e)
		{
			die('Erreur : '. $e->getMessage());
		}
	

?>

<?php

	echo "test1";
	if( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['type_user']) )
	{
		echo "test2";
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$type_user = $_POST['type_user'];
		
		if ($type_user === "Etudiant") 
		{
			$Smt = $bdd->prepare('SELECT * FROM etudiant WHERE LOGIN_ETU=? and PASS_ETU=?');
			$MAINPAGE = '../zind.html';
		}
		else if ($type_user === "Responsable")
		{
			$Smt = $bdd->prepare('SELECT * FROM formation WHERE LOGIN_RESP=? and PASS_RESP=?');
			$MAINPAGE = '../responsable.html';
		}
		else if ($type_user === "Admin")
		{
			$Smt = $bdd->prepare('SELECT * FROM admin WHERE LOGIN_ADMIN=? and PASS_ADMIN=?');
			$MAINPAGE = '../admin.html';
		}
		
		$Smt -> execute(array($username,$password));
		$rows = $Smt -> fetch();
		$Smt->closeCursor();//vider le curseur (free)
		
		if( !empty($rows) )
		{
			echo "test3";
			$_SESSION['pseudo'] = $username;
			
			if(isset($_SESSION['error']))
			{
				unset($_SESSION['error']);
			}

			if(!isset($_SESSION['page']))
				header('location:'.$MAINPAGE);
			else
				header('location:'.$_SESSION['page']);
				
		}
		else
		{
			$_SESSION['error'] = 'Incorrect login !';
			header('location: ../login.html');
		}
	}
?>