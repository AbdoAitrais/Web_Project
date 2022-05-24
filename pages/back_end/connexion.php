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