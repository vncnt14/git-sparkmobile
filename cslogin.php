<?php
include("config.php");

session_start();



if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $sql = "SELECT * FROM carowners WHERE username=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row["password"]) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['service_id'] = $row['service_id'];
            $_SESSION['selected_id'] = $row['selected_id'];
            $_SESSION['vehicle_id'] = $row['vehicle_id'];
            $_SESSION['slot_id'] = $row['slot_id'];
            $_SESSION['shopowner_id'] = $row['shopowner_id'];
            $_SESSION['servicename_id'] = $row['servicename_id'];
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'user') {
                header("Location: csdashboard.php");
                exit();
            } elseif ($row['role'] === 'admin') {
                header("Location: csdashboard_admin.php");
                exit();
            } elseif ($row['role'] === 'staff') {
                header("Location: csdashboard_staff.php");
                exit();    
            } elseif ($row['role'] === 'manager') {
                header("Location: csdashboard_manager.php");
                exit();

                header("Location: dashboard.php");
                exit();
            }
        } else {
            echo '<script>';
            echo 'alert("Invalid Username or Password");';
            echo 'setTimeout(function() { window.location.href = "index.php"; },);';
            echo '</script>';
            exit();
        }
    } else {
        echo '<script>';
        echo 'alert("Invalid Username or Password");';
        echo 'setTimeout(function() { window.location.href = "index.php"; },);';
        echo '</script>';
        exit();
    }

    $stmt->close();
}

$connection->close();
?>