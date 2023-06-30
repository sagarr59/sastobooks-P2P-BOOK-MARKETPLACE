<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];

  // Perform form validation
  if ($password !== $confirmPassword) {
    // Password and confirm password do not match
    echo "Error: Passwords do not match.";
  } else {
    // Form data is valid, perform further processing (e.g., database insertion, user authentication)

    // Database connection
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $database = "login_register";

    // Create connection
    $conn = new mysqli($servername, $username, $pass, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      // User registration successful

      // Perform user authentication (e.g., generate session, set cookies)
      $_SESSION['email'] = $email;
      // You can set more session variables as needed

      // Redirect to success page
      header("Location: homepage.php");
      exit();
    } else {
      // Error in database insertion
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}
?>
