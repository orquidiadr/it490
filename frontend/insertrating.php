<?php

//Database connection using PDO
//$connect = new PDO('mysql:host=localhost;dbname=recipe_db', 'root', '');
         

                $servername= "10.0.0.31";
                $user = "nemo";
                $password = "dory123";
                $db = "reef";

                $connect = mysqli_connect($servername, $user, $password, $db);

              
	 

//$connect = connectDB();

//Check if data are passed by post method.
if(isset($_POST["index"], $_POST["recipe_id"], $_POST["user_id"]))
{

$sthandler = $connect->prepare("SELECT rating_id FROM rating WHERE user_id = :user_id AND recipe_id = :recipe_id");
$sthandler->execute(array(
   ':recipe_id'  => $_POST["recipe_id"],
   ':user_id'   => $_POST["user_id"]
  ));

//Check if user already sent rating for this recipe. if rated than show already rated else store their rating.
if($sthandler->rowCount() > 0){
    echo "already";
} else {

 $query = "
 INSERT INTO rating(recipe_id, rating, user_id) 
 VALUES (:recipe_id, :rating, :user_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':recipe_id'  => $_POST["recipe_id"],
   ':rating'   => $_POST["index"],
   ':user_id'   => $_POST["user_id"]
  )
 );
 $result = $statement->fetchAll();

//Check if rating sent successfully.
 if(isset($result))
 {
  echo 'done';
 }

}
}


?>

