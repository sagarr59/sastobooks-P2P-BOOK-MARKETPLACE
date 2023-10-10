<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please log in to access your profile.'); window.location.href='login.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sastobooks";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to delete the book
    $deleteSql = "DELETE FROM books WHERE book_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $bookId);

    if ($deleteStmt->execute()) {
        echo "<script>alert('Book deleted successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "Error deleting book: " . $conn->error;
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
