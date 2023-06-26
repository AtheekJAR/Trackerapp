<?php

require_once("connection.php");

$query = $_GET['query'];

$result = $conn->query($query);

$response = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $response[] = $row;
  }
}
$conn->close();

echo json_encode($response);
// echo $query;
?>
