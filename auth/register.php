<?php
include("../database.php");
if (isset($_POST)) {
    $name = $_POST['name'];;
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    // echo $tmp;
    if ($photo) {
        move_uploaded_file($tmp, "../user/$photo");
    } else {
        $photo = "empty1.png";
    }

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE name = '$name' ");
    if (mysqli_num_rows($sql) > 0) {
        echo '<script>alert("Username Already Exist");location.href="../index.php";</script>';
    } else if ($password = $cpassword) {
        // mysqli_query($conn, "INSERT INTO users (name,password,cpassword,email,phone,dob,gender,photo,address,created_date,modified_date) VALUES ('$name','$password','$cpassword','$email','$phone','$dob','$gender','$photo','$address',now(),now()");

        $query = "INSERT INTO users (name, password, cpassword, email, phone, dob, gender, photo, address, created_date, modified_date) 
          VALUES ('$name', '$password', '$cpassword', '$email', '$phone', '$dob', '$gender', '$photo', '$address', now(), now())";

        $result = mysqli_query($conn, $query);

        // if ($result) {
        //     echo "User record inserted successfully.";
        // } else {
        //     echo "Error: " . mysqli_error($conn);
        // }

        echo '<script>alert("Successfully Registrar,Please Log In");location.href="../index.php";</script>';
    } else {
        echo '<script>alert("Password Do Not Match");location.href="../index.php";</script>';
    }
}
