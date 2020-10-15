<?php
    require_once 'core/init.php';
    $user = new User();
    if(!$user->isLoggedIn()) {
        Redirect::to(Config::get('menu/home'));
    }
    if(Input::exist('createEvent')) {
        $validate = new Validate();
        $validateForm = $validate->check($_POST, array(
            'title' => array(
                'required' => true,
                'min' => 2,
                'max' => 100
            ),
            'location' => array(
                'required' => true,
                'min' => 2,
                'max' => 100
            ),
            'description' => array(
                'required' => false,
                'min' => 2
            ),
            'Reminders' => array(
                'required' => false,
                'max' => 100
            ),
            'datepicker' => array(
                'required' => true,
                'nonCreateBeforeTodaysDate' => true
            ),
            'startTime' => array(
                'required' => true
            ),
            'endTime' => array(
                'required' => true
            )
        )); 
        if($validateForm->passed()) {
            $event = new Events();
            try {
                $event->create(array(
                    'useremail' => Session::get(Config::get('session/session_name')), 
                    'title' => escape(Input::get('title')),
                    'description' => escape(Input::get('description')),
                    'date' => Input::get('datepicker'),
                    'timestart' => Input::get('startTime'),
                    'timeend' => Input::get('endTime')
                ));

                //TODO: Check time is avalible
                Session::flash('eventcreate', 'You Created a new event successfully!');
                Redirect::to(Config::get('menu/home'));
            } catch(Exception $e) {
                echo $e . '<br />';
            }   
        } else {
            foreach ($validateForm->errors() as $error) {
                echo $error . '<br />';
            }
        }
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
        <title>Meeting-Scheduler Setup A New Event</title>
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
                        <a class="nav-link" href="<?php echo Config::get('menu/home');?>">Home</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container img-container">
            <img class="img-responsive" src="img/penme.png">
        </div>
        <div class="container">
            <h1 id="new-event-title">Setup A New Event</h1>
            <div class="container event-container">
                <form class="event-form" action="" method="POST">
                    <div class="row">
                        <div class="col-md-12 calendar-col">
                            <div class="col-md-4 date-col">
                                <label id="dateLabel"> Event Date*:
                                    <input type="date" id="datepicker" name="datepicker" required/>
                                </label>
                            </div>
                            <div class="col-md-8 time-col">
                                <label id="startLabel"> Event Start Time*:
                                    <input type="time" id="startTime" name="startTime" min="0:01" max="23:59" required />
                                </label>
                                <label id="endLabel"> Event End Time*:
                                    <input type="time" id="endTime" name="endTime" min="0:01" max="23:59" required />
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 inputs-col">
                            <div class="form-group">
                                <input id="form-title" type="text" class="form-control" name="title" placeholder="Title" required/>
                            </div>
                            <div class="form-group">
                                <input id="form-location" type="text" class="form-control" name="location" placeholder="Location" required/>
                            </div>
                            <div class="form-group">
                                <input id="form-reminders" type="text" class="form-control" name="Reminders" placeholder="Reminders" />
                            </div>
                        </div>
                        <div class="col-md-6 inputs-col">
                            <div class="form-group">
                                <textarea id="form-desc" type="text" class="form-control" name="description" placeholder="Description" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn setup-event-btn" value="Create Event" id="createEvent" type="submit" name="createEvent">Create Event</button>
                </form>
            </div>
        </div>
    </body>
</html>