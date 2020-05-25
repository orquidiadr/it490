<?php
session_start();
if(isset($_SESSION['userid'])){

}else{
	header("Location: ../frontend/index.php");
}

    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("AMD_Server.ini", "AMD_Server");

    $search_query = "";
    $search_result = array();

    if(isset($_POST['search_query'])){
        $search_query = $_POST['search_query'];
        $type = $_POST['type'];
        $request['type'] = $type;
        $request['name'] = $search_query;
        $response = $client->send_request($request);
        process_response($response);
    }
    

    function process_response($response){
        //var_dump($response);
        $search_result = array();
        $search_result['type'] = $response['type'];
        $search_result['name'] = $response['name'];
        $search_result['cal'] = $response['cal'];
        $search_result['pro'] = $response['pro'];
        $search_result['fat'] = $response['fat'];
        $search_result['carb'] = $response['carb'];

       return formatResult($search_result);

    }

    function formatResult($search_result){
        echo "<div style='float:right;' class='search'><br><br><br><tr>";
        echo "<td><b>{$search_result['type']}</b></td></br>";
        echo "<td><b>{$search_result['name']}</b></td></br>";
        echo "<td> Calories: {$search_result['cal']}g</td></br>";
        echo "<td> Protein: {$search_result['pro']}g</td></br>";
        echo "<td> Fat: {$search_result['fat']}g</td></br>";
        echo "<td> Carbohydrates: {$search_result['carb']}g</td>";
        echo "</tr></div>";
    }





?>
<html>
    <head>
        <link rel="stylesheet" href="../frontend/css/nav.css">
        <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
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
</html>
