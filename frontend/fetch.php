<?php

//Database connection using PDO

//$connect = new PDO('mysql:host=localhost;dbname=recipe_db', 'root', '');
//        require_once('../backend/path.inc');
  //      require_once('../backend/get_host_info.inc');
    //    require_once('../backend/rabbitMQLib.inc');

     

                $servername= "10.0.0.31";
                $user = "nemo";
                $password = "dory123";
                $db = "reef";

                $connect = mysqli_connect($servername, $user, $password, $db);

                if (!$connect){
                        die("Connection Failed: " . mysqli_connect_error());
                }else{
	       
			echo "Successful connection";
      
		}

//Get all recipe data order by descending.
$query = "
SELECT * FROM all_recipes ORDER BY id DESC
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $rating = count_rating($row['id'], $connect);
 $color = '';
 $output .= '
 <h3 class="text-primary">'.$row['recipe_name'].'</h3>
  <ul class="list-inline">
    <li>Made By</li>
    <li class="text-success"><h4>'.$row['user_name'].'</h4></li>
  </ul>
 <ul class="list-inline" data-rating="'.$rating.'" title="Average Rating - '.$rating.'">
 ';
 
 for($count=1; $count<=5; $count++)
 {
  if($count <= $rating)
  {
   $color = 'color:#ffcc00;';
  }
  else
  {
   $color = 'color:#ccc;';
  }
  $output .= '<li title="'.$count.'" id="'.$row['id'].'-'.$count.'" data-index="'.$count.'"  data-recipe_id="'.$row['id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.' font-size:25px;">&#9733;</li>';
 }
 $output .= '
 <li><span class="badge" style="margin-top: -6px; background-color: #11b511;">('.$rating.')</span><li>
 </ul>

 <hr />
 ';
}
echo $output;


//get average rating for each recipe.
function count_rating($recipe_id, $connect)
{
 $output = 0;
 $query = "SELECT AVG(rating) as rating FROM rating WHERE recipe_id = '".$recipe_id."'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output = round($row["rating"]);
  }
 }
 return $output;
}


?>
