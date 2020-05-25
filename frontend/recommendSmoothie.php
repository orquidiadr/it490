<?php
/* this page is creating a random recommended smoothie of the day. 
 * it is pulling it from allrecipes table in allrecipes database.
 * that table is filled when users create smoothies :)
 * thanks God this is working
 */

session_start();
if(isset($_SESSION['userid'])){

}else{
	header("Location: ../frontend/index.php");
}

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');
	
	$username = $_SESSION['userid'];
	$client = new rabbitMQClient("recommend.ini", "recommendServer");
	if(isset($_SESSION['userid'])){
		$request['username'] = $username;
		$response = $client -> send_request($request);
		process_response($response);
	}

	function process_response($response){
		$username = $_SESSION['userid'];
		
		//if user does not have any recipes in their account, ask them to go to makesmoothie.php
		if($response == "[empty response]"){
			echo 'No one has created any recipes :(  <a href="../frontend/welcome.php"> Go here to create one <3 </a>';
		}
		//for each row(array), get the value in the column
		foreach($response as $column){
				// this will display joanna's navbar. and the field from the random row selected in the server side
				echo '<div class="navbar">';
                      		echo '<a href="../frontend/welcome.php"><i class="fa fa-fw fa-home"></i> Home</a>';
				echo '<a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a>';
                       		echo' <a href="../frontend/logout.php" id="log"><i class="fa fa-fw fa-user"></i> Log Out</a> ';
				echo' </div>';
				echo '<div class="recommended">';
				echo "<h1> Welcome, $username!!</h1>"; //need to make sure we're getitng the user's name here. :)
		                echo "<h2> Here's your recommended Smoothie of the day :) </h2>";
                                echo "<h3> Created by user: " . $column[0] . "</h3>" . "<br>";
                                echo "Recipe name: " . $column[1] . '<br>';
                                echo "Fruits: " . $column[2] . '<br>';
                                echo "Vegetables: " . $column[3] . '<br>';
				echo "Protein: " . $column[4] . '<br>';
				echo "Base: " . $column[5] . '<br>';
				echo "</div>";
		}
	}
?>

<html>
	<head>
		<title>Smoothie of the Day</title>
		<link rel="stylesheet" href="../frontend/css/nav.css">
		<link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			.recommended{
				background-color:white;
				position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                border: 3px solid pink;
				border-style: dashed;
				border-radius: 15px;                         
                                padding:50px; 
			}
			
		</style>
	</head>

	<body>
	</body>
</html>

