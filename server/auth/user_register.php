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

    if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
        die("All required fields must be filled out!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. Please enter a valid email address.");
    }

    if (strlen($password) < 6) {
        die("Password must have at least 6 characters.");
    }

    if (strlen($phone) !== 10 || !is_numeric($phone)) {
        die("Phone number must have 10 characters.");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $check_query = "SELECT * FROM Users WHERE email = ? or username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("Email or Username already exists. Please try another.");
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