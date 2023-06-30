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


$sql = "SELECT * FROM books";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>P2P Book Marketplace - Browse</title>
  <link rel="stylesheet" href="browse.css">
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <img src="mylogo.png" alt="Logo">
      </div>
      <ul class="navigation">
        <li><a href="homepage.php">Home</a></li>
        <li><a href="browse.php">Browse</a></li>
        <li><a href="sell.html">Sell</a></li>
        <li><a href="login.html">Login/Signup</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="browse-section">
      <h2>Browse Books</h2>

      <?php
// Loop through the query result
echo '<div class="book-grid">'; // Open the book-grid container
while ($row = $result->fetch_assoc()) {
  // Extract book details
  $bookName = $row['book_name'];
  $price = $row['price'];
  $sellerName = $row['seller_name'];
  $location = $row['location'];
  $phone = $row['phone'];

  // Output the book details dynamically
  echo '<div class="book">';
  echo '<img src="images/book_placeholder.png" alt="Book">';
  echo "<h3>$bookName</h3>";
  echo "<p>Price: Rs. $price</p>";
  echo "<p>Seller: $sellerName</p>";
  echo "<p>Location: $location</p>";
  echo "<p>Phone: $phone</p>";
  echo '<button class="chat-btn">Chat with Seller</button>';
  echo '</div>';
}
echo '</div>'; // Close the book-grid container
?>



      <div class="book-grid">
        <div class="book">
          <img src="images/book1.png" alt="Book 1">
          <h3>नेपालको सेयर बजार</h3>
          <p>Price: Rs.150</p>
          <p>Seller: Ram Thapa</p>
          <p>Location: Kalanki, KTM</p>
          <p>Phone: 9841405060</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book2.png" alt="Book 2">
          <h3>Biology (Class 12)</h3>
          <p>Price: Rs.250</p>
          <p>Seller: Saroj Karki</p>
          <p>Location: Fulbari, Butwal</p>
          <p>Phone: 9845345343</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book3.png" alt="Book 3">
          <h3>Chemistry (Class 12)</h3>
          <p>Price: Rs.200</p>
          <p>Seller: Saroj Karki</p>
          <p>Location: Fulbari, Butwal</p>
          <p>Phone: 9845345343</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book4.png" alt="Book 4">
          <h3>BEYOND POSSIBLE</h3>
          <p>Price: Rs.300</p>
          <p>Seller: Astha Basnet</p>
          <p>Location: Naikap, Kathmandu</p>
          <p>Phone: 9810203040</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book5.png" alt="Book 5">
          <h3>How Hitler Was Made</h3>
          <p>Price: 200</p>
          <p>Seller: Shisir Magar</p>
          <p>Location: Old Bazar, Pokhara</p>
          <p>Phone: 9818333450</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book6.png" alt="Book 6">
          <h3>The Japanese Wife</h3>
          <p>Price: Rs.350</p>
          <p>Seller: Astha Basnet</p>
          <p>Location: Naikap, Kathmandu</p>
          <p>Phone: 9810203040</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book7.png" alt="Book 7">
          <h3>Relativity</h3>
          <p>Price: Rs.250</p>
          <p>Seller: Sagar Raut</p>
          <p>Location: Tinthana, Kathmandu</p>
          <p>Phone: 9818197270</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book8.png" alt="Book 8">
          <h3>DOGLAPAN</h3>
          <p>Price: Rs.220</p>
          <p>Seller: Gautam Bohara</p>
          <p>Location: Tinthana, Kathmandu</p>
          <p>Phone: 9822334455</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book9.png" alt="Book 9">
          <h3>वन रक्षक</h3>
          <p>Price: Rs.130</p>
          <p>Seller: Saroj Karki</p>
          <p>Location: Fulbari, Butwal</p>
          <p>Phone: 9845345343</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>

        <div class="book">
          <img src="images/book10.png" alt="Book 10">
          <h3>Retirement at 50</h3>
          <p>Price: Rs.200</p>
          <p>Seller:Ram Thapa</p>
          <p>Location: Kalanki, KTM</p>
          <p>Phone: 9841405060</p>
          <button class="chat-btn">Chat with Seller</button>
        </div>
        <!-- more books -->
      </div>
    </section>
  </main>
  <footer>
    <div class="container">
      <p>&copy; 2023 Book Marketplace. All rights reserved.</p>
    </div>
  </footer>
  <!--JS-->
  <script src="script.js"></script>
</body>
</html>
         