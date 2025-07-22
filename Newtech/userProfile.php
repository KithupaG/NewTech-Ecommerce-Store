<?php
session_start();
date_default_timezone_set('Asia/Colombo'); // Set your server's time zone
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying
}

include "connection.php"; // Ensure the path is correct

// Verify if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
Database::setUpConnection(); // Initialize the connection
$query = "SELECT fname, lname, email, mobile, profile_picture FROM customer WHERE id = '$user_id'";
$result = Database::search($query);

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/profile_pictures/'; // Directory to store uploaded images
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
        }

        $fileName = uniqid() . '_' . basename($_FILES['profile_picture']['name']); // Unique file name
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFilePath)) {
            // Update the profile picture path in the database
            $update_picture_query = "UPDATE customer SET profile_picture = '$uploadFilePath' WHERE id = '$user_id'";
            Database::iud($update_picture_query);
            $user['profile_picture'] = $uploadFilePath; // Update the session or local variable
        } else {
            $message = "Failed to upload profile picture.";
        }
    }

    // Update other profile details
    $update_query = "UPDATE customer SET fname = '$fname', lname = '$lname', email = '$email', mobile = '$mobile' WHERE id = '$user_id'";
    Database::iud($update_query);

    $user['fname'] = $fname;
    $user['lname'] = $lname;
    $user['email'] = $email;
    $user['mobile'] = $mobile;

    $_SESSION['user_name'] = $fname;

    $message = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .profile-header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .alert {
            margin-top: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="profile-header text-center">
            <h2>User Profile</h2>
            <p class="lead text-muted">Update your profile details below</p>
        </div>

        <?php if (isset($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="text-center">
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="profile-picture">
                <?php else: ?>
                    <img src="uploads/profile_pictures/default.png" alt="Default Profile Picture" class="profile-picture">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" class="form-control">
            </div>

            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $user['fname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $user['lname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" class="form-control" value="<?php echo $user['mobile']; ?>" required>
            </div>

            <div class="form-group text-center mt-4 w-100">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>

            <div class="form-group mb-3">
                <!-- Replace the button with a direct link -->
                <div class="form-group mb-3">
                    <a href="send_reset_link.php" class="btn btn-secondary">Change Password?</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (optional but recommended for alerts and modal behavior) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>