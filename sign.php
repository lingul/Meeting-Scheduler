<?php require_once 'core/init.php';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- jQuery / Popper.js / Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <title>Meeting-Scheduler Sign Up</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">Meeting-Scheduler</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo Config::get('menu/home');?>">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container img-container">
        <img class="img-responsive" src="img/penme.png">
    </div>

    <div class="container">
        <h1 id="new-user-title">New User Registration</h1>
        <div class="container form-container">
            <form method="POST" action="" class="new-user-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input id="form-fname" type="text" class="form-control" name="firstName" id="firstName" value="<?php echo escape(Input::get('firstName')); ?>" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input id="form-lname" type="text" class="form-control" name="lastName" id="lastName" value="<?php echo escape(Input::get('lastName')); ?>" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input id="form-email" type="email" class="form-control" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="form-name" type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <button class="btn submit-signup-btn" value="SUBMIT" id="register" type="submit" name="register">SUBMIT</button>
            </form>
            <?php
            require_once 'core/init.php';
                if(Input::exist('register')) {
                    $validate = new Validate();
                    $validateForm = $validate->check($_POST, array(
                        'firstName' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ),
                        'lastName' => array(
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ),
                        'email' => array(
                            'required' => true,
                            'email' => true,
                            'unique' => 'users',
                            'min' => 2
                        ),
                        'password' => array(
                            'required' => true,
                            'min' => 4,
                            'max' => 100
                        )
                    ));
                    if($validateForm->passed()) {
                        $user = new User();
                        try {
                            $user->signup(array(
                                'email' => Input::get('email'),
                                'firstname' => escape(Input::get('firstName')),
                                'lastname' => escape(Input::get('lastName')),
                                'password' => Input::get('password')
                            ));
                            Session::flash('register', 'You registered successfully!');
                            Redirect::to(Config::get('menu/home'));
                        } catch(Exception $e) {}
                    } else {
                        foreach ($validateForm->errors() as $error) {
                            echo $error . '<br />';
                        }
                    }
                }

            ?>
        </div>

    </div>
    <script type="text/javascript" src="js/index.js"></script>

</body>

</html>
