<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form inputs
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate the inputs (you can add your own validation logic here)

  // Assuming you have a database connection
  $servername = "localhost";
  $username = "root";
  $db_password = "";
  $dbname = "login_register";

  // Create a new connection
  $conn = new mysqli($servername, $username, $db_password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Sanitize the inputs to prevent SQL injection
  $email = $conn->real_escape_string($email);
  $password = $conn->real_escape_string($password);

  // Hash the password (optional)
  // $hashedPassword = hash('sha256', $password);

  // Prepare and execute the SQL statement
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result && $result->num_rows == 1) {
    // User login successful
    $_SESSION['email'] = $email;
    header("Location: homepage.php"); // Redirect to the homepage or any other page you want
    exit();
  } else {
    // User login failed
    $error = "Invalid email or password";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
<body>
  <div class="container">
    <img src="blacklogo.png" alt="Logo" class="logo">

    <h1>Login</h1>
    <form  method="POST" action= "loginn.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn" name="button">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.html">Sign up</a></p>
  </div>
</body>

</html>
+