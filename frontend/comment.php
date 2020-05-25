<?php
    session_start();
        if(isset($_SESSION['userid'])){

        }else{
                header("Location: ../frontend/index.php");
        }
        require_once('../backend/path.inc');
        require_once('../backend/get_host_info.inc');
        require_once('../backend/rabbitMQLib.inc');

        $username=$_SESSION['userid'];

        $client = new rabbitMQClient("comment.ini","commentServer");

        if(isset($_POST['submit'])){
              $username = $_POST['username'];
              $comments=$_POST['comments'];


                $request = array();
                $request['username'] = $username;
                $request['comments'] = $comments;

                $response = $client->send_request($request);
        }
?>

<html>
        <head>
                <title> Successful Website Review</title>
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
                        <h1>Thank you for leaving a comment. We appreciate your time</h1>
                        <h4><a href="../frontend/welcome.php">Go to home page</a></h4>
                </div>
        </body>
</html>


