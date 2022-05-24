
<?php  
	function()
	{
		ob_start();
		session_start();

		$server = "localhost:3306";//specifier le port si vous utiliser plusieurs serveurs
		$dataB = "bd_fstage";
		$dsn = "mysql:host=$server;dbname=$dataB";
		$user = "root";
		$password = "";

		try
		{
			$bdd = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		}
		catch (PDOException $e)
		{
			die('Erreur : '. $e->getMessage());
		}
	}
?>

<?php
if( !empty($_POST['username']) && !empty($_POST['password']) )
{
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$Smt = $bdd->prepare('SELECT * FROM etudiant WHERE LOGIN_ETU=? and PASS_ETU=?');
	$Smt -> execute(array($username,$password));
	$rows = $Smt -> fetch();
	$Smt->closeCursor();//vider le curseur (free)
	
	if( !empty($rows) )
	{
		$_SESSION['pseudo'] = $username;
		if(isset($_SESSION['error']))
		{
			unset($_SESSION['error']);
		}
		else
		{
			if(!isset($_SESSION['page']))
				header('location: zind.html');
			else
				header('location:'.$_SESSION['page']);
			
		}
	}
	else
	{
		$_SESSION['error'] = 'Incorrect login !';
		header('location: login.html');
	}
}
?>