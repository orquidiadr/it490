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
#		$username = $request['username'];
		$smoothie =$request['smoothie'];
		$rating =$request['rating'];

		
# select username and smoothie name from the recipes table
                $sql1 = "SELECT username, recipe_name from allrecipes";
                $result1 = mysqli_query($conn, $sql1);
 
                //as long as there is a row, insert it into the results array
                if(mysqli_num_rows($result1) > 0){
                        $results = array();
                        while($row = mysqli_fetch_array($result)){
                                $results[] = $row;
                        }
                        print_r($results); //prints array in cli


                        foreach($results as $test) {
                                echo $test[0] . '<br>';
                                echo $test[1] . '<br>';
                                
                               
                           
                        }
			return $results; 
		}
/*
# Insert everything into the rating table
                $sql2 = "INSERT into rating VALUES ('$id','$smoothie','$rating','$hits')
		$result2 = mysqli_query($conn, $sql2);

		$finddata= mysqli_query("SELECT * FROM rating");
		while ($row = mysqli_fetch_array($finddata))
		    {
             		$id= $row ['id'];
			$smoothie= $row ['smoothie'];
			$rating= $row ['rating'];
			$hits= $row ['hits'];
			
			
 */		


 	$server = new rabbitMQServer("rating.ini","ratingServer");
        $server->process_requests('requestProcessor');
        $server->send_request($row);
?>
 
