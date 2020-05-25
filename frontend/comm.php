<?php
session_start();
if(isset($_SESSION['userid'])){

}else{
	header("Location: ../frontend/index.php");
}

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');
	
	//set the timezone from new york
	date_default_timezone_set('America/New_York');

	$username = $_SESSION['userid'];

	$client = new rabbitMQClient("comm.ini", "comment_server");
	if(isset($_SESSION['userid'])){
		$request['username'] = $username;
		//$response = $client -> send_request($request);
		//process_response($response);
    }
    if(isset($_POST['commentSubmit'])){
        $username = $_SESSION['userid'];
		$date = $_POST['date'];
        $message = $_POST['message'];
        
        $comment['username'] = $username;
        $comment['date'] = $date;
        $comment['message'] = $message;

			echo "username is " . $username;
			echo "date is " . $date;
			echo "message is " . $message;
			
    }

?>
<html>
    <body>
        <form method='POST' action=' ../backend/comm.php'>
					<input type='hidden' name='userid' value='$username'>
					<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
					<textarea name='message' placeholde='Enter your comment'></textarea><br>
					<button type='submit' name='commentSubmit'>Comment</button>
		</form> 
    </body>

</html>