#!/usr/bin/php
<?php
        require_once('path.inc');
        require_once('get_host_info.inc');
        require_once('rabbitMQLib.inc');

        function connectDB(){

                $servername= "10.0.0.31";
                $user = "nemo";
                $password = "dory123";
                $db = "reef";

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
                $comments = $request['comments'];

                $db_name ='reef';
                $connect = connectDB($db_name);
                $sql = "INSERT INTO commentTable VALUES('$username','$comments') ";
		$result = mysqli_query($connect, $sql);

		$response = "SUCCESS.";
                return $response;

}

$server = new rabbitMQServer("comment.ini","commentServer");
$server->process_requests('requestProcessor');
$server->send_request($response);
?>
