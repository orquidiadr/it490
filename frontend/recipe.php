<?php

     $client = new rabbitMQClient("testRabbitMQ.ini", "testdb");
	 
	 $request = array();
	 $recipe=$_POST['Recipe'];
	 $fruit=$_POST['Fruit'];
	 $vegetable=$_POST['Vegetables'];
	 $protein=$_POST ['Protein'];
	 $base=$_POST ['Base'];
	 
	
	 $request['recipe'] = $recipe;
	 $request['fruit'] = $fruit;
	 $request['vegetable'] = $vegetable;
	 $request['protein'] = $protein;
	 $request['base'] = $base;
	 
	 $client-> send_request($request);
	
?>

<!DOCTYPE html>
<html>
<head>
<style>
h2 {
   color: blue;

   }
 h3 {
   color: tomato;
   }
 b{
    color: tomato;

        }


 </style>


<center><h2>Lets Make Some Froothies!!!!</h2></center><br><br>

<body>
<form action="/recipe.html" method= "post">

  <b>Give your Recipe a Name:</label></b> <input type="text" id="RecipeName" name="Recipe"><br>

  <h3>Fruit:</label><br> <input type="text" id="FruitName" name="Fruit" > <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Vegetables:</label><br> <input type="text" id="VegetableName" name="Vegetables"> <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Protein:</label><br> <input type="text" id="ProteinName" name="Protein">  <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Base:</label><br> <input type="text" id="BaseName" name="Base">  <button onclick="alert('Added!')">ADD</button><br>
  
</form> 


</body>
</html>

