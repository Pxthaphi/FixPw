<?php
$servername = "localhost";
$username = "scinno_DB126";
$password = "scinno_DB126";
$dbname = "scinno_DB126"; // Uncomment and set the database name

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>