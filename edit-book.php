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

if (isset($_GET['book_id']) && is_numeric($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Fetch book details using the book_id
    $sql = "SELECT * FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Store book details in variables
        $bookName = $row['book_name'];
        $price = $row['price'];
        $location = $row['location'];
        $phone = $row['phone'];
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Invalid book ID.";
    exit();
}

/// Handle form submission for editing the book name and price
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newBookName = $_POST['editBookName'];
    $newPrice = $_POST['editPrice'];

    // Update book name and price in the database
    $updateSql = "UPDATE books SET book_name = ?, price = ? WHERE book_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssi", $newBookName, $newPrice, $bookId);
    
    if ($updateStmt->execute()) {
        echo "<script>alert('Book details updated successfully.'); window.location.href='browse.php';</script>";
    } else {
        echo "Error updating book details: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - SASTOBOOKS</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="edit.css">
 
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
            <h2>Edit Book Details</h2>
            <p>Welcome, <?php echo $_SESSION['fullname']; ?>!</p>
        </section>

        <section class="edit-book-form">
    <form method="POST">
        <div class="form-group">
            <label for="editBookName">Book Name:</label>
            <input type="text" id="editBookName" name="editBookName" value="<?php echo $bookName; ?>" required>
        </div>
        <div class="form-group">
            <label for="editPrice">Price:</label>
            <input type="text" id="editPrice" name="editPrice" value="<?php echo $price; ?>" required>
        </div>
        <div class="form-group">
            <button type="submit">Save Changes</button>
        </div>
    </form>
</section>

    </main>

    <footer>
        <div class="footer">
            <p>&copy; 2023 SASTOBOOKS. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
