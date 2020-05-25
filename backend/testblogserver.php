#!/usr/bin/php
<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');
	
	function connectDB(){
		//db config
		$db_host = '10.0.0.31';
		$db_username = 'nemo';
		$db_password = 'dory123';
		//$db_name = 'reef';
		$db_name = 'allrecipes';

		//test db connection
		$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
		if(!$conn){
			die ("Failed to connect" . mysqli_connect_error());
		}else{
			#echo "Successful connection" . PHP_EOL;
		}

		return $conn;
	}

	function requestProcessor($request){
		$username = $request['username'];
		$conn = connectDB();
		#$sql = "SELECT recipeName, fruits, veggies, protein, base FROM $username";
		$sql = "SELECT username, recipe_name, fruit, veggies, protein, base FROM allrecipes";
		$result = mysqli_query($conn, $sql);

		//as long as there is a row, insert it into the results array
		if(mysqli_num_rows($result) > 0){
			$results = array();
			while($row = mysqli_fetch_array($result)){
				$results[] = $row;
			}
			print_r($results); //prints array in cli


			foreach($results as $test) {
				echo $test[0] . '<br>';
				echo $test[1] . '<br>';
				echo $test[2] . '<br>';
				echo $test[3] . '<br>';
                echo $test[4] . '<br>';
                echo $test[5] . '<br>';
			}
			return $results; //return the array to myaccount.php ->process_response()
		}

		// if user has not created any arrays, they will be asked to create one ->makesmoothie.php
		else{
			echo "<h1>OOPS!</h1>";
			echo "<h2> $username --> You have not created any recipes! </h2>";
		}

} 
	$server = new rabbitMQServer("blog.ini","blogServer");
	$server->process_requests('requestProcessor');
	$server->send_request($row);
?>
