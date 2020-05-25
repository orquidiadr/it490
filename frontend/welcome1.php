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
                        echo "Success";
                }
                else
                {
                     echo "Error: " . mysqli_error($connect);
                }

        }
        mysqli_close($connect);




?>

<html lang="en" xmlns="http://srlwebmail.com/index.php" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">


    <head>
<meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    
    <script type="text/javascript">
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                var originalAddEventListener = EventTarget.prototype.addEventListener,
                    oldWidth = window.innerWidth;

                EventTarget.prototype.addEventListener = function (eventName, eventHandler, useCapture) {
                    if (eventName === "resize") {
                        originalAddEventListener.call(this, eventName, function (event) {
                            if (oldWidth === window.innerWidth) {
                                return;
                            }
                            else if (oldWidth !== window.innerWidth) {
                                oldWidth = window.innerWidth;
                            }
                            if (eventHandler.handleEvent) {
                                eventHandler.handleEvent.call(this, event);
                            }
                            else {
                                eventHandler.call(this, event);
                            };
                        }, useCapture);
                    }
                    else {
                        originalAddEventListener.call(this, eventName, eventHandler, useCapture);
                    };
                };
            };
</script>

        <title>Welcome to Froothies</title>
    <link rel="stylesheet" href="../frontend/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
  <link rel="stylesheet" type="text/css" href="../frontend/css/style1.css">


</head>
<div class="navbar">
  <a href="../frontend/index.php"><i class="fa fa-fw fa-home"></i> Home</a>
  <a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a>
  <a href="../frontend/logout.php" id="log"><i class="fa fa-fw fa-user"></i> Log Out</a>
        <form action="../backend/search.php" method="post" id="form">
            <select name="type" id="type" class="sel"> 
                    <option value="recipes" name="recipes"> ALL RECIPES
                    <option value="fruit" name="fruit"> FRUIT
                    <option value="veggies" name="veggies"> VEGGIES
                    <option value="protein" name="protein"> PROTEIN
                    <option value="base" name="base"> BASE
            </select>
            <input type="text" name="search_query">
            <input type="submit" name="search" value="SEARCH">
        </form>
</div>

<div id="day">
            <h2> SMOOTHIE OF THE DAY </h2>
</div>
<div id="make">
            <h2><a href="../frontend/recipe.php"> MAKE A SMOOTHIE </a></h2>
            <div id="make">
            <h2>MAKE A SMOOTHIE</h2>
            <div id="fDiv">
                <form action="../frontend/recipe.php" method= "post">

                    <b>Give your Recipe a Name:</label></b> <input type="text" id="RecipeName" name="recipe"><br>

                    <b>Fruit:</label><br> <input type="text" id="ingr" name="fruit"> <input type="button" value="Add" id="add" name="fruitADD"/><br>
                    
                    <b>Veggies:</label><br> <input type="text" id="ingr" name="veggies"> <input type="button" value="Add" id="add" name="veggiesADD"/><br>
                    
                    <b>Protein:</label><br> <input type="text" id="ingr" name="protein"> <input type="button" value="Add" id="add" name="proteinADD"/><br>
                    
                    <b>Base:</label><br> <input type="text" id="ingr" name="base"> <input type="button" value="Add" id="add" name="baseADD"/><br>
                    <input type="Submit" value="ADD RECIPE" name="submit"/>
                </form> 
            </div>
</div>
</div>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<link rel="stylesheet" type="text/css" href="../frontend/css/style1.css">

<body>

<div class = "data">


      <h2> Leave a Comment </h2>

      <br><label>Enter your Name<br></label>
      <input type="text" name="username" placeholder="Enter here"><br><br>

      <label>Enter your comments<br><br></label>

      <textarea name="comments" rows="5" cols="20" placeholder="Please enter here"></textarea>      
    
      <button type="submit" name="submit" id="submit" value="submit"><b>Submit</b></button><br></center>


</div>
<!--div class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    //<input type="radio" id="star1" name="rate" value="1" />
   // <label for="star1" title="text">1 star</label>
 // </div>
-->  
</form>
</body>
</html>
