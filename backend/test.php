<?php

if (!isset($_GET['meals']) && !isset($_GET['events'])){
    exit(0);
}

if ($_GET['meals'] !="" && $_GET['events'] != ""){
    exit(0);
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "i7452067_wp3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['meals'])){
    $meal_id = $_GET['meals'];

    if($meal_id == -1){
        $sql = "SELECT * FROM wp_posts ";
    } else{

    }
    $result = $conn->query($sql);
}



if ($result->num_rows > 0) {
  // output data of each row
  echo json_encode($result->fetch_assoc());

//   while($row = $result->fetch_assoc() != null) {
//     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//   }
} else {
  echo "0 results";
}
$conn->close();

function response($order_id,$amount,$response_code,$response_desc){
	$response['order_id'] = $order_id;
	$response['amount'] = $amount;
	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	echo $json_response;
}

?>