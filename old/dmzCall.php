<?php
    require_once('loginDB.php');

	$name = 'kiwi';


    $sql ="SELECT * from fruit WHERE name = '$name'";
	$result = mysqli_query($mydb,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if($count == 1){
		return $count;
	}else{
	       	$APP_ID = '9e081409';
   		 $APP_KEY = 'c122653d4096a00999bf36f4e1d4958e';
   		 $url = "https://api.edamam.com/api/food-database/parser?ingr=$name&category=generic-foods&category-label=food&app_id=9e081409&app_key=c122653d4096a00999bf36f4e1d4958e";
   		 $ch = curl_init();


   		 curl_setopt($ch, CURLOPT_URL, $url);
   		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   		 curl_setopt($ch, CURLOPT_HEADER, 0);

   		 $jsonData = curl_exec($ch);

   		 curl_close($ch);

   		 $jsonData = stripslashes(html_entity_decode($jsonData));
   		 $array = json_decode($jsonData, true);

   		 $name = $array['parsed'][0]['food']['label'];
		 $cal = $array['parsed'][0]['food']['nutrients']['ENERC_KCAL'];
		 $pro = $array['parsed'][0]['food']['nutrients']['PROCNT'];
		 $fat = $array['parsed'][0]['food']['nutrients']['FAT'];
		 $carb = $array['parsed'][0]['food']['nutrients']['CHOCDF'];
		
		$sql ="INSERT INTO fruit(name, calories, protein, fat, carbs) VALUES ('$name', '$cal', '$pro', '$fat', '$carb')";
	        $result = mysqli_query($mydb,$sql);

		
	}
	
	
    
   
?>

