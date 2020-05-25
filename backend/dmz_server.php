<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    #require_once('RMQ_server.ini');


    function requestProcessor($request){
        var_dump($request);
        if(isset($request['name'])){
            $food = $request['name'];
            $type = $request['type'];
        }else{
            $food = 'apple';
        }
        return fetchData($food, $type);

    }

    function fetchData($food, $type){
        $APP_ID = '9e081409';
        $APP_KEY = 'c122653d4096a00999bf36f4e1d4958e';
        $ch = curl_init();
        
        $url = "https://api.edamam.com/api/food-database/parser?ingr=$food&category=generic-foods&category-label=food&app_id=9e081409&app_key=c122653d4096a00999bf36f4e1d4958e";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);


        
        $jsonData = curl_exec($ch);

        //$jsonData = stripslashes(html_entity_decode($jsonData));
        $array = json_decode($jsonData, true);
        
        
        curl_close($ch);

        

        $name = $array['parsed'][0]['food']['label'];
		$cal = $array['parsed'][0]['food']['nutrients']['ENERC_KCAL'];
		$pro = $array['parsed'][0]['food']['nutrients']['PROCNT'];
		$fat = $array['parsed'][0]['food']['nutrients']['FAT'];
		$carb = $array['parsed'][0]['food']['nutrients']['CHOCDF'];
        
        $response['name'] = $food;
        $response['type'] = $type;
        $response['cal'] = $cal;
        $response['pro'] = $pro;
        $response['fat'] = $fat;
        $response['carb'] = $carb;

        

        return $response;
    }

    

    $server = new rabbitMQServer("RMQ_server.ini","RMQ_Server");
    $server->process_requests('requestProcessor');
    $server->send_request($response);



?>
