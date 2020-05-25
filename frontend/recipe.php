<?php
  session_start();
  $username = $_SESSION['userid'];

  require_once('../backend/path.inc');
  require_once('../backend/get_host_info.inc');
  require_once('../backend/rabbitMQLib.inc');
  
  $client = new rabbitMQClient("recipe.ini", "recipe_server");
   
    if(isset($_POST['submit'])){
      $recipe=$_POST['recipe'];
      $fruit=$_POST['fruit'];
      $vegetable=$_POST['veggies'];
      $protein=$_POST['protein'];
      $base=$_POST['base'];

      $request = array();
      $request['username'] = $username;
      $request['recipe'] = $recipe;
      $request['fruit'] = $fruit;
      $request['veggies'] = $vegetable;
      $request['protein'] = $protein;
      $request['base'] = $base;
      
      $response = $client->send_request($request);
    }

    if(isset($_POST['add'])){
      //$types = ("fruit","veggies","protein","base");
      //$btns = ('fruitADD', 'veggiesADD','proteinADD','baseADD');
      $add['type']=$_POST['add'];
      switch($add['type']){
        case "fruit":
          $name = $_POST['fruit'];
          $type = $add['type'];
        case "veggies":
          $name = $_POST['veggies'];
          $type = $add['type'];
        case "protein":
          $name = $_POST['protein'];
          $type = $add['type'];
        case "base":
          $name = $_POST['base'];
          $type = $add['type'];
      }
      //add($type,$name);
    }

    function RMQ(){
      $client = new rabbitMQClient("AMD_Server.ini", "AMD_Server");
      return $client;
    }

    function add($type, $name){
      $client = RMQ();
      $request['name'] = $name;
      $request['type'] = $type;

      $response = $client->send_request($request);
      process_response($response);
    }

    function process_response($reponse){
      $ingredient = array();
      $ingredient['type'] = $response['type'];
      $ingredient['name'] = $response['name'];
      $ingredient['cal'] = $response['cal'];
      $ingredient['pro'] = $response['pro'];
      $ingredient['fat'] = $response['fat'];
      $ingredient['carb'] = $response['carb'];

      //for calorie counter
      //$GLOBAL{$caloriecounter} = $GLOBAL{$caloriecounter} + ingredient['cal'];

      return addResult($ingredient);
    }

    function addResult($ingredient){
      echo "<div style='float:right;' class='ingr'><br><ul>";
      echo "<li><b>{$ingredient['type']}</li>";
      echo "<li>{$ingredient['name']}</li>";
      echo "<li>{$ingredient['cal']}</li>";
      echo "<li>{$ingredient['pro']}</li>";
      echo "<li>{$ingredient['fat']}</li>";
      echo "<li>{$ingredient['carb']}</li>";
      //echo "Total Calories: {$GLOVBAL{$caloriecounter}}";
      echo "</ul>";
    }

      
?>

<html>
        <head>
                <title> Created Smoothie </title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                        body{
                                background-image: url("/var/www/froothies/assets/fruits-bg.png");
                                text-align: center;
                        }

                        div.message {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                border: 3px solid pink;
                                border-style: dashed;
                                border-radius: 15px;
                                background-color:white;
                                color:teal;
                                font-family: Arial, Helvetica, sans-serif;
                                padding:50px;
                        }
                </style>
          <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
        </head>
        <body>
                <div class="message">
                        <h1>You successfully created a smoothie.</h1>
                        <h4><a href="../frontend/welcome.php">Go to home page</a></h4>
                </div>
        </body>
</html>

