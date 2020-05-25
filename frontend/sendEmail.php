<?php 
	require 'PHPMailer/PHPMailerAutoload.php';

	//Database connection using PDO
	//$connect = new PDO('mysql:host=localhost;dbname=recipe_db', 'root', '');

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



	//Check if click send button
	if (isset($_POST['send'])) {

		$email = $_POST['email'];
		$user_id = $_POST['user_id'];

		//Get the random recipe which is not already rated by one.
		$query = "SELECT recipe_name FROM all_recipes
		WHERE id NOT IN (SELECT rating.recipe_id FROM `rating` WHERE user_id = :user_id) ORDER BY RAND() LIMIT 1";
		$statement = $connect->prepare($query);
		$statement->execute(array(
		   ':user_id'   => $_POST["user_id"]
		  ));

		$result = $statement->fetch();
		$recipe_name = $result['recipe_name'];
		$mail = new PHPMailer;

		//disable this line if you upload this project to live server
		$mail->isSMTP();

		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';

		$mail->Username = 'YOUR SMTP EMAIL ADDRESS';
		$mail->Password = 'YOUR SMTP EMAIL PASSWORD';

		$mail->setFrom('FROM EMAIL ADDRESS', 'FROM NAME');
		$mail->addAddress($email);
		$mail->addReplyTo('FROM EMAIL ADDRESS', 'FROM NAME');
		
		$mail->isHTML(true);
		//email subject
		$mail->Subject = 'Recommendation for Smoothie';

		//email body
		$mail->Body = '<h1 align=center>Recommendation for Smoothie</h1>
		<h4 align=center>Hello here is your new smoothie '.$recipe_name.'. You might like this.</h4>
		<br> <h5 align=center>Thank you.</h5>';
		
		//Check for successfully sent or not
		if (!$mail->send()) {
			echo "Email send failed!";
		} else {
			session_start();
			$_SESSION['message'] = "Email sent successfully!";
			header("location: indexrating.php");
		}

	}
	

?>
