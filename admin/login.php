<?php
    session_start();
    include("includes/database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Administration</title>
    
    
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .center-screen {
            display: flex;
            min-height: 80vh;
            align-items: center;
            justify-content: center;
            text-align: center;
          
            }
    </style>
</head>
    
<body class="bg-gradient-dark">
    <div class="center-screen">
        <div class="container">
        <div class="row justify-content-center">
                        <div class="card-body col-md-7">

                                        <div class="text-center">
                                            <h1 class="h1 text-danger mb-2 " style="text-decoration:underline">MCC Admin Login</h1>
                                        </div>
                                        <form class="user" method="post" class="was-validated">
                                            <div class="form-group">
                                                <input type="email" class="form-control "
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Email Address" required name="admin_email" >
                                                    <div class="invalid-feedback">
                                                        Email address invalid, try again.
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                    id="exampleInputPassword" placeholder="Password" required name="password" >
                                                    <div class="invalid-feedback">
                                                    Password invalid, try again.
                                                    </div>
                                            </div>
                                            <div class="px-5">
                                            <div class="px-5">
                                            <div class="form-group px-5">
                                            <button class="btn btn-danger btn-user btn-block border border-light" type="submit" name="admin_login">Log in</button>
                        </div>
                        </div>
                        </div>
                        </div>
            </div>    
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['admin_login'])) {

        $dbCon = new dbConnect();


        $adminEmail = mysqli_real_escape_string($dbCon->getConn(),$_POST['admin_email']);
        $adminPassword = mysqli_real_escape_string($dbCon->getConn(),$_POST['password']);

        $query = "select * from admin where Email='$adminEmail' AND Password='$adminPassword'";

        $Qresult = $dbCon->query($query);

        $count = mysqli_num_rows($Qresult);

        $dbCon->closeConnect();


        if($count == 1) {
            $_SESSION['admin_email'] = $adminEmail;

            echo "<script>window.open('index.php?dashboard','_self')</script>";
            
        }
        else {
            
            echo "<script>alert('Email Or Password Incorrect, please try again.')</script>";
            
        }
    }
?>