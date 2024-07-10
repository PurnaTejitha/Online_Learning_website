<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "online");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // Check if the email exists in the profile table
    $sql_check = "SELECT * FROM profile WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Update existing record
        $sql_update = "UPDATE profile SET name = '$name', phone_number = '$phone_number', address = '$address' WHERE email = '$email'";
        if (mysqli_query($conn, $sql_update)) {
            $_SESSION['name'] = $name;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['address'] = $address;
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Insert new record
        $sql_insert = "INSERT INTO profile (name, email, phone_number, address) VALUES ('$name', '$email', '$phone_number', '$address')";
        if (mysqli_query($conn, $sql_insert)) {
            $_SESSION['name'] = $name;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['address'] = $address;
            header("Location: profile.php");
            exit();
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
