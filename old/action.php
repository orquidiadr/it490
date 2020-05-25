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

                $sql = "INSERT INTO addFruit (username, email, fruits, veggies, comments) VALUES ('$username', '$email', '$fruits', '$veggies', '$comments')";

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
<meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Froothies</title>

    <link href="home.css" type="text/css" rel="stylesheet" />
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="form.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <header>
      <div class="row">
      <div class="col-25">
        <label name=search>For more information: </label>
      </div>
      <div class="col-75">
        <input type="text" id="search" name="search" placeholder="Search here..">
      </div>
    </div>
      <nav class="horizontalNavigation">
         <ul>
            <li><a href="welcome.html">Home</a></li>
            <li><a href="#">Fruits</a></li>
            <li><a href="#">Veggies</a></li>
            <li><a href="#">Protin</a></li>
            <li><a href="#">Contact Us</a></li>
            <div class="contact">
                <a href="logout.php">Logout</a>
            </div>
         </ul>
      </nav>
        
        <style>
            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: none;
}

        </style>
   </header>
<center>
<h2>Great! Now you can add your Favourite Fruits/Veggies.</h2>
</center>
<div class="container">
  <form action="/welcome.html">
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
            <label name="page">Select page would you like to go.</label>
        </div>
            <div class="col-75">
                <select id="page" name="page">
                    <option value="page">--Select one--</option> 
                    <option value="home">Home</option>
                    <option value="logout">Logout</option>
                    <option value="form">Previous Page</option>
                </select>
            </div>
        </div>
      
      <div class="row">
            <input type="submit" value="Previous Page">
            <input type="submit" value="Home">
            <input type="submit" value="Logout">
      </div>
      
  </form>
</div>

</body>
</html>
