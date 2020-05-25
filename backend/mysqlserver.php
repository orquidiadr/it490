#!/usr/bin/php
<?php

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');


	$db_host='10.0.0.31';
        $db_username='nemo';
        $db_password='dory123';
        $db_name='reef';

        $mydb = new mysqli($db_host, $db_username, $db_password, $db_name);

        if($mydb->errno != 0){
                echo "failed to connect.".$mydb->error . PHP_EOL;
        }else{
                echo "we in.".PHP_EOL;
        }
	function connectDB($db_name){
		$db = $db_name;
		$db_host='10.0.0.31';
		$db_username='nemo';
		$db_password='dory123';

		#test connection
		$conn = mysqli_connect($db_host, $db_username, $db_password, $db);
		return $conn;
	}

	function doLogin($username, $password){

		$db_name='reef';
		$mydb = connectDB($db_name);

		$sql ="SELECT * from users WHERE username = '$username' 
			AND password = '$password'";
		$result = mysqli_query($mydb,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		echo "here 3".PHP_EOL;
		if($count == 1){
			echo "we're logged in B".PHP_EOL;
			print_r($row);
			$send = "login";
			return $send;
		}
		$send = "fail";
		return $send;
	}

	function doRegister($username, $password){
		if((doLogin($username, $password)) == "login"){
			$send = "taken";
			return $send;
		}else{
				$db_name='reef';
				$mydb = connectDB($db_name);

				$sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
				$result =  mysqli_query($mydb,$sql);

				$db_name2='users';
			   	$mydb2 = connectDB($db_name2);
				$sql2 = "CREATE TABLE $username(recipe_name VARCHAR(20), fruit VARCHAR(20), veggies VARCHAR(20), protein VARCHAR(20), base VARCHAR(20), PRIMARY KEY(recipe_name))";
				$result2 = mysqli_query($mydb2, $sql2);
			

				if((doLogin($username, $password)) == "login"){
					$send = "registered";
					return $send;
				}
		}

	}

	function requestProcessor($request){
		echo "received request".PHP_EOL;
		var_dump($request);
		if(!isset($request['type'])){
			return "ERROR: I aint got no type";
		}
		switch ($request['type']){
			case "login":
				return doLogin($request['username'],$request['password']);
			case "validate_session":
				return doValidate($request['sessionId']);
			case "register":
				return doRegister($request['username'],$request['password']);
		}
		
	}

	$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
	$server->process_requests('requestProcessor');
	$server->send_request($send);

	exit();

?>
