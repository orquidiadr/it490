#!/usr/bin/php
<?php
        require_once('path.inc');
        require_once('get_host_info.inc');
        require_once('rabbitMQLib.inc');

        function connectDB(){

                $servername= "10.0.0.31";
                $user = "nemo";
                $password = "dory123";
                $db = "form";

                $connect = mysqli_connect($servername, $user, $password, $db);

                if (!$connect){
                        die("Connection Failed: " . mysqli_connect_error());
                }
                else {
                }

                return $connect;
        }
function requestProcessor($request){
        var_dump($request);
		$username = $request['username'];
		$email = $request['email'];
		$fruits = $request['fruits'];
		$veggies = $request['veggies'];
		$comments = $request['comments'];
    
                $db_name ='addFruit';
                $connect = connectDB($db_name);
                $sql = "INSERT INTO addFruit VALUES('$username', '$email', '$fruits', '$veggies', '$comments') ";
                $result = mysqli_query($connect, $sql);


                /*if(mysqli_num_rows($result) > 0){
                        $results = array();
                        while($row = mysqli_fetch_array($result)){
$results[] = $row;
                        }
                        print_r($results);


                        foreach($results as $test) {
                                echo $test[0] . '<br>';
                                echo $test[1] . '<br>';
                                echo $test[2] . '<br>';
                                echo $test[3] . '<br>';
                                echo $test[4] . '<br>';
                        }
                        return $results;
                }

                else{
                        echo "<h1>OOPS!</h1>";
                        echo "<h2> $username --> You have not added any fruits/veggies! </h2>";
                }*/
        $response = "SUCCESS.";
		return $response;
	}
        $server = new rabbitMQServer("form.ini","formServer");
        $server->process_requests('requestProcessor');
        $server->send_request($row);
?>
