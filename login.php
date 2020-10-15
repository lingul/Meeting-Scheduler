<?php
require_once 'core/init.php';
$user = new User();
if($user->isLoggedIn()) {
    Redirect::to(Config::get('menu/home'));
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tab icon -->
    <link rel="icon" href="img/penme.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- jQuery / Popper.js / Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Meeting-Scheduler Log In</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">Meeting-Scheduler</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo Config::get('menu/home'); ?>">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container img-container">
        <img class="img-responsive" src="img/penme.png">
    </div>

    <div class="container">
        <h1 id="new-user-title">User Login</h1>
        <div class="container form-container">
            <form method="POST" action="" class="login-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input id="form-email" type="email" class="form-control" name="email" id="email" value="<?php echo Input::get('email'); ?>" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="form-name" type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <button class="btn submit-login-btn" value="SUBMIT" id="login" type="submit" name="login">SUBMIT</button>
            </form>
            <?php
                if(Input::exist('login')) {
                    $validate = new Validate();
                    $validateForm = $validate->check($_POST, array(
                        'email' => array(
                            'required' => true
                        ),
                        'password' => array(
                            'required' => true
                        )
                    ));
                    if($validateForm->passed()) {
                        $user = new User();
                        $login = $user->login(Input::get('email'), Input::get('password'));
                        if($login) {
                            Session::flash('login', 'login success');
                            Redirect::to(Config::get('menu/home'));
                        }
                    } else {
                        foreach ($validateForm->errors() as $error) {
                            echo $error . '<br />';
                        }
                    }
                }

            ?>
        </div>
        <!--<script type="text/javascript" src="js/login.js"></script>-->
        <script type="text/javascript" src="js/index.js"></script>
</body>

</html>
