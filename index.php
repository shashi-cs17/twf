<html>
<head><title>TWF ASSESSMENT TASK API consumer</title></head>
<body>
<h2>TWF ASSESSMENT TASK API consumer</h2>
<form action='' method='post'>
ENTER EXPRESSION : <input type='text' name='exp'><input type="submit" value="GET RESULT"><br>
</form>
<?php

	if (isset($_POST['exp'])) {
		
 		$input = $_POST['exp'];
		
 			$url = "https://twf-full-stack-dev-task.herokuapp.com/api.php?input=".$input;
 		
 		$client = curl_init($url);
 		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
 		$response = curl_exec($client);
 		
 		$result = json_decode($response);
 		
 		
		echo "<br><hr>EXPRESSION : ".$input."<br><br>";
 		echo "MINIMUM COST : ".$result->data;
 		
	}
	
?>
	<br><hr>
</body>
</html>
