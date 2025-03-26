<?php
include "../../config/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    $query = "SELECT * FROM ADMIN WHERE admin_email = LOWER(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify user credentials
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['id'] = $user['admin_id'];
            $_SESSION['name'] = $user['admin_name'];
            $_SESSION['email'] = $user['admin_email'];
            $_SESSION['user_type'] = "admin";

            header("Location: /CivilIssueResolution/views/admin/");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found for this email and user type.";
    }
}

$conn->close();
?>