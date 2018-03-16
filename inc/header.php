<?php 
	session_start();
	ob_start();
	$author = 'Team Ceres ';
	$valid = true;		    
	$username = $password = '';
	
	
	
	//validate
	$error = array();
	$loginDetails = array();
	$businessName = array();
	
	//check if username is set then assign it to a variable
	if(isset($_POST['username'])){
		$username = strtolower($_POST['username']);
		$_SESSION["name"] = $_POST['username'];
		
	}
	
	//check if password is set then assign it to a variable
	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}

		
		//open file, store data in myfile variable
		$myfile = fopen('admin/config.txt', 'r') or die ('Server error');
					//breaks a myfile into an array
				 $loginDetails = explode(',', fread($myfile, filesize('admin/config.txt')));
		
				 //close file 
				 fclose($myfile);
				 
	if(count($error) == 0 && $_SERVER['REQUEST_METHOD'] == 'POST'){		 
		if(!in_array($username, $loginDetails) || !in_array($password, $loginDetails)){
			 	$error['password'] = 'Oops, that\'s not a match.';
		}
		if(($username !== $loginDetails[0] || $password !== $loginDetails[1]) && ($username !== $loginDetails[2] || $password !== $loginDetails[3]) && ($username !== $loginDetails[4] || $password !== $loginDetails[5])){
			$valid = false;
			$error['password'] = 'Oops, that\'s not a match.';
			
		}
		//error messages
		if(empty($username) || empty($password)){
			$valid = false;
			$error['password'] = 'Oops, that\'s not a match.';
		} 
				 
	}
	
?>
<!doctype html>
<html lang="en">
	<head>
		<title><?php if(isset($loginDetails[6])) {echo $loginDetails[6];}?></title>
		<meta charset="utf-8">
		 <meta name="author" content="$author">
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<main>
			<header class="header">
				<div class="container">
					<h1 class="logo"><a href="./index.php"><?php if(isset($loginDetails[6])) {echo $loginDetails[6];}?></a></h1>
					<div class="right-nav">
						<?php if(isset($_SESSION["name"])){echo $_SESSION["name"];}?>
					</div>
				</div>
			</header>
			<div class="container">
				
					
					
					