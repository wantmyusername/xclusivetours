<?php
session_start();

$userinfo = array(
                'admin'=>'pass',
                );
if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
        header('location:admin.php');

    }else {
        $err='<div class="fail">Contraseña incorrecta</div>';

    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Xclusive Tours Cancun</title>
    </head>
    <style>
        input.form-control{
            text-transform: uppercase;
        }
    </style>
    <body>
        <div class="container">
                        <form class="form-horizontal" name="login" action="" method="POST">
                <fieldset>
                    <h4 class="mt-4">Xclusive Tours Cancun</h4>
                    <div class="form-group">
                        <!-- Username -->
                        <label class="control-label" for="username">Usuario</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Contraseña</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="form-control" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <input type="submit" name="submit" value="Acceder" / class="btn btn-primary btn-lg btn-block">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
