<?php
    //write to files
    //global.log --> all webserver backend (might add one for local db and one for cloud db)
    //auth.log --> authentication database
    //apache.log --> apache /var/www/log/error.log
    require_once('path.inc');
    require_once('rabbitMQLib.inc');
    require_once('get_host_info.inc');

    function requestProcessor($request){
        var_dump($request);
        if($request['type']=="log"){
            $event = $request;
        }else{
            $request['type'] = "OVERWRITTEN || ERROR: TYPE";
            $event = $request['type'];
            return writeLog($event);
        }

        switch($request['src']){
            case "php":
                $event['file'] = "global.log";
            case "apache":
                $event['file'] = "apache.log";
            case "auth":
                $event['file'] = "auth.log";
        }

        

    }


    function writeLog($event){
            $msg = $event['msg'];
            $src = $event['src'];
            $time = time();
            $date = gmdata("y/m-d H:i:s", $time);
            $log_file = $event['file'];
            $log = "Entry from: . $src . \n . $date . \t . $msg";  

            $fh = fopen($log_file, 'a') or die("Cannot Open");
            fwrite($fh, "\n" . $date . "\t" . $file);
            file_put_contents($log_file, $log);
    }

    $server = new rabbitMQServer("RMQ_log.ini", "logServer");
    $server->process_requests('requestProcessor');
    $server->send_request($send);
    exit();

?>
