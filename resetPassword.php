<?php
require_once("config.php");
$msg = "";
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    # <> je isto kao i !=
    $stmt = $conn->prepare("SELECT id FROM users WHERE email =? AND token =? AND token <> '' AND tokenExpire>NOW()");

    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if (isset($_POST['submit'])) {
            $newpass = sha1($_POST['newpass']);
            $cnewpass = sha1($_POST['cnewpass']);

            if ($newpass == $cnewpass) {
                $stmt_u = $conn->prepare("UPDATE users SET token='', password=? WHERE email = ?");
                $stmt_u->bind_param("ss", $newpass, $email);
                $stmt_u->execute();

                $msg = "Password changed successfully!<br><a href='index.php'>Login Here</a>";
            } else {
                $msg = "Password did not match!";
            }
        }
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-5">
                <h3 class="text-center bg-dark text-light p-2 rounded">Reset your password here!</h3>
                <h4 class="text-success text-center"><?php echo $msg; ?></h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input type="password" name="newpass" class="form-control" placeholder="New Password" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" name="cnewpass" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-success btn-block" value="Reset Password">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</body>

</html>