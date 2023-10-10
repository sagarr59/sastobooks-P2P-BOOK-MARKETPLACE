<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieving form data
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];

  //Validatoin
  $errors = [];

  //(at least 2 words)
  $nameWords = explode(' ', $fullname);
  if (count($nameWords) < 2) {
    $errors[] = "Full name should contain at least 2 words.";
  }

  //email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  //password (minimum 8 characters)
  if (strlen($password) < 8) {
    $errors[] = "Password should be at least 8 characters long.";
  }

  // pass $ con. pass equal
  if ($password !== $confirmPassword) {
    $errors[] = "Password and confirm password do not match.";
  }

  if (count($errors) > 0) {
    // error msg
    $errorMessage = implode("\\n", $errors);
    echo "<script>alert('$errorMessage'); window.location.href='signup.php';</script>";
    exit();
  } else {
 

    // Database connection
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $database = "sastobooks";

    $conn = new mysqli($servername, $username, $pass, $database);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Inserting
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      // User signup successfully

      $_SESSION['email'] = $email;
      $_SESSION['fullname'] = $fullname;

      // Redirect to success page
      header("Location: homepage.php");
      exit();
    } else {
      // Error in db insertion
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}
?>



<!--HTML code -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SASTOBOOKS - Sign Up</title>
  <link rel="stylesheet" href="signup.css">
</head>

<body>
  <div class="container">

  <div class="image-container">
        <img src="1.png" alt="Login Image">
      </div>

      <div class="form-container">
    <a href="homepage.php"><img src="mylogo.png" alt="Logo" class="logo"></a>
    <h1>Sign Up</h1>
    <form action="signup.php" method="POST">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" required >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
      </div>
      <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Log in</a></p>
  </div>
</div>
</body>

</html>
