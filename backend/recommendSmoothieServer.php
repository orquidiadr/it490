#!/usr/bin/php
<?php

/* this will recommend a smoothie randomly from the recipes entered with makesmoothie.php
 * recipes entered into the allrecipes database, allrecipes table
 */

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function connectDB(){
	//db config
        $db_host = '10.0.0.31';
        $db_username = 'nemo';
        $db_password = 'dory123';
        $db_name = 'allrecipes';

        //test db connection
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
        if(!$conn){
   	     die ("Failed to connect" . mysqli_connect_error());
        }
        return $conn;
}

function requestProcessor($request){
	$username = $request['username'];
	$conn = connectDB();
	$sql = "SELECT username, recipe_name, fruit, veggies, protein, base FROM allrecipes 
		ORDER BY RAND()
		LIMIT 1";
	// $sql = "SELECT recipe_name, fruit, veggies, protein, base FROM $username";
	$result = mysqli_query($conn, $sql);

	//echo if a row found :)
	if(mysqli_num_rows($result) > 0){
		echo "something found";
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
                        }
                        return $results;
	}else{
		echo "nothing found";
	}
}

$server = new rabbitMQServer("recommend.ini","recommendServer");
$server->process_requests('requestProcessor');
$server->send_request($row);

?>
