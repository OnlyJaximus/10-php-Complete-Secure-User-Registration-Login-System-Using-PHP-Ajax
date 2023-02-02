<?php

// echo "<pre>";
// print_r($_POST);


// ******** Registration ********
// Array
// (
//     [name] => Branko 
//     [uname] => bleki
//     [email] => blesicb@yahoo.com
//     [pass] => 123456
//     [cpass] => 123456
//     [action] => register
// )


// ******** Login ********
// Array
// (
//     [username] => Bleki
//     [password] => 123456
//     [action] => login
// )

//  ******** Forgot password ********
// Array
// (
//     [femail] => blesicb@yahoo.com
//     [action] => forgot
// )

# ******** ******** ******** ******** ******** ******** ********  ******** 
require_once("config.php");



# ***************  Register process **********************
if (isset($_POST['action']) && $_POST['action'] == "register") {

    $name = check_input($_POST['name']);
    $uname = check_input($_POST['uname']);
    $email = check_input($_POST['email']);
    $pass = check_input($_POST['pass']);
    $cpass  = check_input($_POST['cpass']);

    $pass = sha1($pass);
    $cpass = sha1($cpass);

    $created = date("Y-m-d");

    if ($pass != $cpass) {
        echo "Password did not matched!";
        exit;
    } else {
        $sql = $conn->prepare("SELECT username, email FROM users WHERE username=? OR email=?");
        $sql->bind_param("ss", $uname, $email);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);


        if (isset($row['username']) && $row['username'] == $uname) {
            echo "Username not available try different!";
        } elseif (isset($row['email']) && $row['email'] == $email) {
            echo "Email is already registered, try different!";
        } else {

            $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, created_at)
                VALUES (?,?,?,?,?)");

            $stmt->bind_param("sssss", $name, $uname, $email, $pass, $created);

            if ($stmt->execute()) {
                echo "Registered Successfully. Login now!";
            } else {
                echo "Something went wrong! Please try again!";
            }
        }
    }
}


# ***************  login process **********************
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    session_start();

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $stmt_login = $conn->prepare("SELECT * FROM users WHERE username =? AND password =?");
    $stmt_login->bind_param("ss", $username, $password);
    $stmt_login->execute();
    $user = $stmt_login->fetch();

    if ($user != null) {
        $_SESSION['username'] = $username;
        echo "ok";

        if (!empty($_POST['rem'])) {
            setcookie("username", $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("password", $_POST['password'], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE['username'])) {
                setcookie("username", "");
            }
            if (isset($_COOKIE['password'])) {
                setcookie("password", "");
            }
        }
    } else {
        echo "Login Failed! Check your username and password";
    }
}



# ***************  Forgot process **********************
if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
    $femail = $_POST['femail'];

    $stmt_p = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt_p->bind_param("s", $femail);
    $stmt_p->execute();
    $res = $stmt_p->get_result();

    if ($res->num_rows > 0) {
        $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $stmt_i = $conn->prepare("UPDATE users SET token=?, tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
         WHERE email=?");
        $stmt_i->bind_param("ss", $token, $femail);
        $stmt_i->execute();

        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = "testmercatesting@gmail.com";
        $mail->Password = "glcqcslljdltrrph";

        $mail->addAddress($femail);
        $mail->setFrom('testmercatesting@gmail.com', "BlexE-comm");
        $mail->Subject = 'Reset Password';
        $mail->isHTML(true);

        $mail->Body = "<h3>Click the below link to reset your password</h3><br>
        <a href='http://localhost/comp_login/resetPassword.php?email=$femail&token=$token'>
        http://localhost/comp_login/resetPassword.php?email=$femail&token=$token</a><br><h3>Regards<br>BlexE-Comm</h3>";

        if ($mail->send()) {
            echo "We have send you the reset link in your email ID, please check your email!";
        } else {
            echo "Something went wrong, please try again letter!";
        }
    }
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
