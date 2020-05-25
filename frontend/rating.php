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

	$client = new rabbitMQClient("rating.ini","indexrating");
	if(isset($_SESSION['userid'])){
		$request['username'] = $username;
		$response = $client -> send_request($request);
		process_response($response);
	}

	function process_response($response){
		$username = $_SESSION['userid'];
		echo "<h1> hello $username </h1>";
	}

        if(isset($_POST['submit'])){
         #     $username = $_POST['username'];
	    
	      $smoothie=$_POST['smoothie'];
	      $rating=$_POST['rating'];
	    


                $request = array();
              #  $request['username'] = $username;
                $request['smoothie'] = $smoothie;
		$request['rating'] = $rating;
		
		$response = $client->send_request($request);
        }
?>

<html>
        <head>
                <title> Smoothie Ratings</title>
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
           padding:50px;
                        }
                </style>
        </head>
        <body>

                    <div class="rating">
                     <form action= "rating.php" method  ='POST'>
				<h4> Enter the name of the smoothie you want to rate: </h4>
				 <textarea name="ratings"  placeholder="Please enter here"></textarea>
 
                                  <select name = 'rating'>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                </select>
                                <input type = 'hidden' value='$id' name ='smoothie'>
				<input type ='submit' value= 'Rate'> Current Rating: <?php $hits; ?> "

                                

                                </form>

                        <h4><a href="../frontend/welcome.php">Go to home page</a></h4>
                </div>
        </body>
</html>


								   
