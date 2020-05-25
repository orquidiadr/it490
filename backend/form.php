<?php
        $servername= "localhost";
        $user = "nemo";
        $password = "dory123";
        $db = "form";

        $connect = mysqli_connect($servername, $user, $password, $db);

        if (!$connect){
                die("Connecting Failed: " . mysqli_connect_error());
        }

        if(isset($_POST['submit'])){

                $username = $_POST['username'];
                $email = $_POST['email'];
                $fruits = $_POST['fruits'];
                $veggies = $_POST['veggies'];
                $comments = $_POST['comments'];

                $sql = "INSERT INTO addFruit VALUES ('$username', '$email', '$fruits', '$veggies', '$comments')";

                if (mysqli_query($connect, $sql)){
                        echo "New record created successfully";
                }
                else
                {
                        echo "Error: " .$sql . "<br>" . mysqli_error($connect);
                }

        }
        mysqli_close($connect);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Froothies</title>

    <link href="home.css" type="text/css" rel="stylesheet" />
    <link href="home_style.css" type="text/css" rel="stylesheet" />
    <link href="form.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <header>
      
        <style>
            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }

        </style>
   </header>
<center>
<h2>Great! Now you can add your Favourite Fruits/Veggies.</h2>
</center>
<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <div class="row">
      <div class="col-25">
        <label name=username>UserName</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label name="email">Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" placeholder="Your email..">
      </div>
    </div>
      
      <div class="row">
      <div class="col-25">
        <label name="fruits">Name of Fruit</label>
      </div>
      <div class="col-75">
        <input type="text" id="fruits" name="fruits" placeholder="Add fruit..">
      </div>
    </div>
      <div class="row">
      <div class="col-25">
        <label name="veggies">Name of Veggies</label>
      </div>
      <div class="col-75">
        <input type="text" id="veggies" name="veggies" placeholder="Add veggies..">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="comments">Any comments?</label>
      </div>
      <div class="col-75">
        <textarea id="comments" name="comments" placeholder="Please leave your comments here.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" name="submit" id="submit" value="Submit">
    </div>
  </form>
</div>
</form>

</body>
</html>
