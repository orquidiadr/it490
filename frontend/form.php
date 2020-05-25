<?php
    session_start();
        if(isset($_SESSION['userid'])){

        }else{
                header("Location: ../frontend/index.php");
        }
        require_once('../backend/path.inc');
        require_once('../backend/get_host_info.inc');
        require_once('../backend/rabbitMQLib.inc');

        $username=$_SESSION['userid'];

	$client = new rabbitMQClient("form.ini","formServer");

	if(isset($_POST['submit'])){
	      $username = $_POST['username'];
	      $email = $_POST['email'];
	      $fruits = $_POST['fruits'];
      	      $vegetable=$_POST['veggies'];
	      $comments=$_POST['comments'];


      		$request = array();
      		$request['username'] = $username;
      		$request['email'] = $email;
      		$request['fruits'] = $fruits;
      		$request['veggies'] = $vegetable;
      		$request['comments'] = $comments;

	        $response = $client->send_request($request);
    	}
?>

<html>
        <head>
                <title> Recommended Fruits/Veggies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                        body{
                                background-image: url("/var/www/froothies/assets/fruits-bg.png");
                                text-align: center;
                        }

                        div.message {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                border: 3px solid pink;
                                border-style: dashed;
                                border-radius: 15px;
                                background-color:white;
                                color:teal;
                                font-family: Arial, Helvetica, sans-serif;
                                padding:50px;
                        }
                </style>
		<link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
        </head>
        <body>
                <div class="message">
                        <h1>You successfully recommended fruits/veggies. Thank you for your recommendatoin, we'll get back to you once it's added to our database.</h1>
                        <h4><a href="../frontend/welcome.php">Go to home page</a></h4>
                </div>
        </body>
</html>

