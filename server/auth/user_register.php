<?php
// Include database connection
include "../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if (empty($name) || empty($email) || empty($password)) {
        die("All required fields must be filled out!");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $check_query = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("Email already exists. Please try another.");
    }

    $insert_query = "INSERT INTO Users (username, email, address, password, contact) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssss", $name, $email, $address, $hashed_password, $phone);


    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: /CivilIssueResolution/user_login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>