<?php 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Page</title>

        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!--<link href="assets/dist/css/signin.css" rel="stylesheet">-->
        <link rel="stylesheet" href="assets/dist/css/floating-labels.css">
    <style>
    body {
        background-image: url("assets/brand/Kyra-1.svg");
        background-repeat: no-repeat;
        background-position: center;
    }

    .logo-styling {
        margin-left: 85px;

    }
    </style>
</head>

<body class="">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <!-- <div class="card-body p-0" style="background: green;"> -->
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <!-- <img src="photo/favicon.png" alt="logo" class="img-rounded" width="60" height="60"> -->
                                    </div>
                                    <main class="form-signin bg-light">
                                        <form action="proses.php" method="post">
                                            <img class="mb-4 logo-styling center" src="assets/brand/Kyra.svg" alt="Logo"
                                                width="120" height="57">
                                            <h1 class="h3 mb-3 fw-normal text-center">Form Login
                                            </h1>
                                            <p class="text-center">Insert Username and Password!</p>
                                            <div class="form-label-group">
                                                <input type="text" name="username"
                                                    class="form-control form-control-user" placeholder="Username"
                                                    autofocus autocomplete="off" required>
                                                <label>Insert your username</label>
                                            </div>
                                            <div class="form-label-group">
                                                <input type="password" name="password"
                                                    class="form-control form-control-user" placeholder="Password"
                                                    autocomplete="off" required>
                                                <label>Insert your password</label>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary btn-user btn-block">Login</button>

                                            <p class="mt-5 mb-3 text-muted text-center">&copy; 2020–<?= date('Y')?></p>
                                        </form>
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>