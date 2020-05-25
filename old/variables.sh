$request['type'] = log --> if anything else, it is on the wrong queue
$request['src'] = php, apach, auth
$request['msg'] = string, error, log message etc.


error_logging();
E_NOTICE
E_ALL

$event = array();
$event['type] = log --> how to weed out wrong requests/ in case there is an error
$event['file'] = php, apache, auth
$event['level'] = error_level 
---->  PHP value
            1       E_ERROR ---> WRITE TO LOG
            2       E_WARNING ---> WRITE TO LOG
            8       E_NOTICE ---> PRINT TO CONSOLE 
            2048    E_STRICT ---> NOT 'STRICTLY' AN ERROR
            8191    E_ALL ---> ALL OF THEM
            
$event['msg'] = string
    --> 
$event['line'] = line number, printed "line " + $event['line']


