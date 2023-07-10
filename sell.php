<?php
/*
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
  // Display an alert message
  echo "<script>alert('Please log in before selling a book.'); window.location.href='login.php';</script>";
  exit();
}
*/

$servername = "localhost";
$username = "root";
$password = "";
$database = "bookDetails";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$bookName = $_POST['book-name'];
$price = $_POST['price'];
$sellerName = $_POST['seller-name'];
$condition = $_POST['condition'];
$location = $_POST['seller-location'];
$phone = $_POST['phone'];

// SQL INSERT statement
$sql = "INSERT INTO books (book_name, price, `condition`, seller_name, location, phone) 
        VALUES ('$bookName', '$price', '$condition', '$sellerName', '$location', '$phone')";

if ($conn->query($sql) === true) {
  // Book details added successfully
  echo "<script>alert('Sell book details added successfully.'); window.location.href='browse.php';</script>";
} else {
  // Error occurred
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
