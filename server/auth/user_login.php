<?php
include "../../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    $query = "SELECT * FROM USERS WHERE email = LOWER(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['username'];
            $_SESSION['user_type'] = "user";

            header("Location: /CivilIssueResolution/views/user/");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found for this email and user type.";
    }
}

// Close database connection
$conn->close();
?>