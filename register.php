<?php
include_once "Database.php";
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['number']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Handle image upload only if an image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $filename = $_FILES['image']['name'];
        $location = 'admin/image/' . $filename;

        // File extension validation
        $file_extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
        $image_ext = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($file_extension, $image_ext)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
                $image_uploaded = $filename; // Store the filename for database insertion
            } else {
                echo "Image upload failed.";
                exit();
            }
        } else {
            echo "Invalid image format.";
            exit();
        }
    } else {
        $image_uploaded = NULL; // No image uploaded, store as NULL or skip field in query
    }

    // Insert into the database with image if available
    if ($image_uploaded) {
        $insert_record = mysqli_query($conn, "INSERT INTO user (username, email, mobile, city, password, image) VALUES ('$username', '$email', '$mobile', '$city', '$password', '$image_uploaded')");
    } else {
        $insert_record = mysqli_query($conn, "INSERT INTO user (username, email, mobile, city, password) VALUES ('$username', '$email', '$mobile', '$city', '$password')");
    }

    if (!$insert_record) {
        echo "Registration failed.";
    } else {
        echo "Registration successful. Redirecting to login page...";
        echo "<script>window.location = 'login_form.php';</script>";
    }
}
?>
