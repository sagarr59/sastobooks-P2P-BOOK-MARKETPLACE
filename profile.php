<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please log in to access your profile.'); window.location.href='login.php';</script>";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "sastobooks";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userFullName = $_SESSION['fullname'];

// Fetch books uploaded by the user
$sql = "SELECT * FROM books WHERE seller_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userFullName);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile - SASTOBOOKS</title>
    <link rel="stylesheet" href="profile.css">
    <script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this book?");
}
</script>

</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="homepage.php"><img src="mylogo.png" alt="Logo" class="logo"></a>
            </div>
            <ul class="navigation">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="browse.php">Browse</a></li>
                <li><a href="sell.php">Sell</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="profile-section">
            <h2>Your Profile</h2>
            <p>Welcome, <?php echo $_SESSION['fullname']; ?>!</p>
        </section>

        <section class="book-listing">
    <h2>Your Book Listings</h2>
    <div class="book-grid">
        <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Book">';
            echo "<h3>{$row['book_name']}</h3>";
            echo '<div class="actions">';
            echo '<a href="edit-book.php?book_id=' . $row['book_id'] . '"><button class="edit-btn">Edit</button></a>';
            echo'<br>';
    
            // Add a form for the Delete button
            echo '<form method="POST" action="delete-book.php">';
            echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
            echo'<br>';
            echo '<button type="submit" class="delete-btn" onclick="return confirmDelete()">Delete</button>';
            echo '</form>';
    
            echo '</div>';
            echo '</div>';
        }
    }
    else {
            echo "<p>You haven't uploaded any books yet. <a href='sell.php'>Sell a book now</a>.</p>";
        }
        ?>
    </div>
</section>


    </main>

    <footer>
        <div class="footer">
            <p>&copy; 2023 SASTOBOOKS. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
