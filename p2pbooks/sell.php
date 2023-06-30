
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookDetails";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Retrieve form data
$bookName = $_POST['book-name'];
$price = $_POST['price'];
$sellerName = $_POST['seller-name'];
$condition = $_POST['condition'];
$location = $_POST['seller-location'];
$phone = $_POST['phone'];
$bookPhoto = $_POST['book-photo'];

// Prepare and execute the SQL INSERT statement
//condition=reserved word 
$sql = "INSERT INTO books (book_name, price, `condition`, seller_name, location, phone, book_photo) 
        VALUES ('$bookName', '$price', '$condition', '$sellerName', '$location', '$phone', '$bookPhoto')";

if ($conn->query($sql) === true) {
  echo "Sell book details added successfully.";

  echo'<br>';
  echo'<a href="browse.php">GO TO BROWSE SECTION</a>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
