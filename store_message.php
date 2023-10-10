<?php
session_start();

if (isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $receiver_id = $_POST['receiver_id'];
    $message_text = $_POST['message'];

    // Include your database connection code here

    // Insert the message into the database
    $sql = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $_SESSION['u_id'], $receiver_id, $message_text);

    if ($stmt->execute()) {
        echo "Message sent successfully";
    } else {
        echo "Error sending message: " . $stmt->error;
    }
}
?>
