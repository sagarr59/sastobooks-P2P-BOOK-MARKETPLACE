<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "sastobooks";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the book_id from the URL
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    // Query the database to fetch the details of the selected book based on $book_id
    $sql = "SELECT * FROM books WHERE book_id = $book_id"; // Adjust your SQL query accordingly
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Retrieve book details
        $bookName = $row['book_name'];
        $price = $row['price'];
        $sellerName = $row['seller_name'];
        $location = $row['location'];
        $phone = $row['phone'];
        $imageData = $row['image_data'];

        // Include the HTML and display the book details
    } else {
        // Handle the case where the book with the given ID was not found
        echo "Book not found.";
    }
} else {
    // Handle the case where no book_id is provided in the URL
    echo "Book ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <!-- Include your shared CSS file -->
    <link rel="stylesheet" href="browse.css">
    <!-- Include the new CSS file for book details -->
    <link rel="stylesheet" href="book_listing.css">
    <!-- Add font-awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Add the custom CSS for the chat button -->
   
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="homepage.php"><img src="mylogo.png" alt="Logo"></a>
            </div>
            <ul class="navigation">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="browse.php">Browse</a></li>
                <li><a href="sell.php">Sell</a></li>
                <?php
        
        if (isset($_SESSION['email'])) {
          echo '<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>'; // User icon linked to profile page
          echo '<li><a href="logout.php">Logout</a></li>';
        } else {
          echo '<li><a href="login.php">Login/Signup</a></li>';
        }
      ?>
                
            </ul>
        </nav>
    </header>
    <main>
        <!-- Display the book details fetched from the database -->
        <section class="book-details">
            <div class="book-left">
                <!-- Specify a fixed width and height for the book image -->
                <img class="book-image" src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="Book" width="400" height="500">
            </div>
            <div class="book-right">
                <h2><?php echo $bookName; ?></h2>
                <p>Price: Rs. <?php echo $price; ?></p>
                <p>Seller: <?php echo $sellerName; ?></p>
                <p>Location: <?php echo $location; ?></p>
                <p>Phone: <?php echo $phone; ?></p>
                <?php
                if (isset($_SESSION['fullname'])) {
                    if ($_SESSION['fullname'] === $sellerName) {
                        echo '<p class="chat-disabled">Chat Disabled for You</p>';
                    } else {
                        echo '<button class="chat-btn" onclick="openChat()">Chat with ' . $sellerName . '</button>';
                    }
                } else {
                    echo '<p class="chat-disabled">Login to Chat with Seller</p>';
                }
                ?>
            </div>
        </section>
    </main>
    <!-- Chatbox structure -->
    <div id="chatbox" class="chatbox">
    <div class="chat-header">
    <i class="fas fa-user-circle person-icon"></i> <!-- Font Awesome icon -->
    <span><?php echo $sellerName; ?></span>
    <button id="close-chat" class="close-chat" onclick="closeChat()">Close</button>
</div>

        <div class="chat-messages" id="chat-messages">
            <!-- Chat messages will be displayed here -->
        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type your message...">
            <button id="send-button" class="send-button" onclick="sendMessage()">Send</button>
        </div>
    </div>
    <footer>
        <div class="footer">
            <p>&copy; 2023 SASTOBOOKS. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // JavaScript for the chat functionality
        function openChat() {
            document.getElementById("chatbox").style.display = "block";
        }
        function closeChat() {
            document.getElementById("chatbox").style.display = "none";
        }
        function sendMessage() {
            const message = document.getElementById("message-input").value;
            const chatMessages = document.getElementById("chat-messages");
            chatMessages.innerHTML += `<p><strong>You:</strong> ${message}</p>`;
            document.getElementById("message-input").value = "";
    
        }
    </script>
</body>
</html>
