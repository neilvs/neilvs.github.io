<?php

$link = mysqli_connect('localhost', '', '', 'test');

$last_id = $_POST['last_id'];

$query = "SELECT * FROM imager WHERE id > '$last_id' ORDER BY id DESC";
$result = mysqli_query($link, $query);
while ($r = mysqli_fetch_assoc($result)){
	$response[] = $r;
}
echo json_encode($response);

?>