<?php
session_start();
//if this user visits the page while logged in, show them the welcome page
// if user visits this page while logged out, do nothing
if(isset($_SESSION['userid'])){
	header("Location: ../frontend/welcome.php");
}else{
//	header("Location: ../frontend/index.php");
}

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');

	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$username = '';
	$password = '';
	$request = array();

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

   		$request['username'] = $username;
		$request['password'] = $password;

	}	
	if(isset($_POST['login'])){
		$request['type'] = 'login';
		$response = $client->send_request($request);
		process_response($response);
	}

	function process_response($response){
		var_dump($response);
		if($response == "login"){
			session_start();
			#			session_register("username");
			// once they log in, get the username from the form (POST).
			$_SESSION['userid']=$_POST['username'];
			header('location: ../frontend/welcome.php');
		}elseif($response == "fail"){
			$bad_login = "Incorrect username and password. Please try again";
                        echo "<script type='text/javascript'>
                                alert('$bad_login');
                                window.location = '../frontend/index.php';
                             </script>";
		}elseif($response == "registered"){
				echo "you have successfully registered\n".PHP_EOL;
		}else{
				echo "sorry username taken\n".PHP_EOL;
		}
	}
	
?>
<html>
	<head>
	<title> Login </title>
		<link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
	</head>
	<body>
	<div align="center">	
		<div id="dialog">					
			<div id="login">		
				<b>Log in</b>
			</div>
			<div id="cred">
				<form name="" action="" method="POST">
					Username: 
					<input type="text" name="username" id="box" autocomplete="off"/>
				</br></br>
					Password: 
					<input type="password" name="password" id="box" autocomplete="off"/>
				</br></br>
					<input type="Submit" value="Log in" name="login"/>
				<br/>
				</form>
			
					<div style="font-size:12px;color:#000000;margin-top:10px">
						Not a member? <a href="../frontend/register.php">Create an account!</a>
					</div>
			</div>
		</div>
	</div>
	</body>
</html>

