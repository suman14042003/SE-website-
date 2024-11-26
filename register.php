<?php
// Establish connection to the database
$conn = new mysqli('localhost', 'root', '', 'student_enrollment'); // Ensure the correct DB name

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // Ensure password is not hashed twice

    if (!empty($name) && !empty($email) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        // Execute and check if successful
        if ($stmt->execute()) {
            header("Location: thank-you.html");
            exit(); // Ensure no further code runs after the redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "All fields are required!";
    }
    // Close connection
    $conn->close();
}
?>


