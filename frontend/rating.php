<?php

	require_once('../backend/path.inc');
    	require_once('../backend/get_host_info.inc');
   	require_once('../backend/rabbitMQLib.inc');

        $servername= "localhost";
        $user = "nemo";
        $password = "dory123";
        $db = "reef";

        $connect = mysqli_connect ($servername, $user, $password, $db);

        if (!$connect){
                die("Connecting Failed: " . mysqli_connect_error());
        }

        if(isset($_POST['submit'])){

                $name = $_POST['name'];
                $comment = $_POST['comment'];

                $sql = "INSERT INTO commentTable (name, comment) VALUES ('$name','$comment')";

                if (mysqli_query($connect, $sql)){
                        echo "New rows and columns created successfully";
                }
                else
                {
                     echo "Error: " . mysqli_error($connect);
                }

        }
        mysqli_close($connect);

?>

<!DOCTYPE html>
<meta charset="UTF-8">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../frontend/css/style1.css">
  
</head>


<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

<div  class="data"> 
		<br><br><label>Enter your Name<br><br></label>
        <input type="text" name="name" placeholder="Enter here"><br><br>

          <label>Enter your comments?<br><br></label>

		 <textarea name="comment" rows="5" cols="30" placeholder="Please enter here"></textarea>
        
    <button type="submit" name="submit" id="submit" value="submit"><b>Submit</b></button><br></center>
</div>
</form>
<div class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
</html>



		

