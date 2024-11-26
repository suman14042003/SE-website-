<?php
// Establish connection to the database
$conn = new mysqli('localhost', 'root', '', 'student_enrollment');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Prepare the statement
        $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $user['password'])) {
                echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . ".";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with this email.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Please enter both email and password.";
    }
}

// Close connection
$conn->close();
?>
