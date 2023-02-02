<?php require_once("session.php"); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">BlexE-Comm</a>

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php echo $username ?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Setting</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>

                </div>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="text-center display-4">Welcome</h1>
                <h1 class="text-center display-2 bg-info rounded p-1 text-light"><?= $name; ?></h1>
                <h2 class="text-center"><?= $email; ?></h2>
                <h2 class="text-center">Registered On: <?= $created_at ?></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse suscipit arcu sed
                    mauris luctus, gravida hendrerit mauris commodo. Nulla facilisi. Suspendisse ac augue sed eros
                    lobortis posuere eu ut neque. Sed nulla turpis, lobortis non bibendum ut, dapibus posuere felis.
                    Mauris et mauris dictum, ullamcorper odio in, tincidunt dolor. Vestibulum ante ipsum primis in faucibus
                    orci luctus et ultrices posuere cubilia curae;
                    Nullam nec lobortis dui, in dignissim massa.</p>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>