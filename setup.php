<?php
require_once 'core/init.php';


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
    <title>Meeting-Scheduler Event Setup</title>
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a id="setup-nav-btn" class="nav-link" href="setup.html">Setup Event
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="import-nav-btn" class="nav-link" href="import.html">Import Schedule</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link sign-up-btn" href="sign.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link login-btn" href="login.html">Log In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link logout-btn" href="javascript:void(0)">Log Out</a>
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

            <div class="row">

                <div class="col-md-12 calendar-col">

                    <div class="col-md-6 date-col">

                        <label id="dateLabel"> Event Date*:
                            <input type="date" id="datepicker" />
                        </label>

                    </div>

                    <div class="col-md-6 time-col">

                        <label id="startLabel"> Event Start Time*:
                            <input type="time" id="startTime" min="6:00" max="24:00" required />
                        </label>

                        <label id="endLabel"> Event End Time*:
                            <input type="time" id="endTime" min="6:00" max="24:00" required />
                        </label>

                    </div>

                </div>

                <div class="col-md-4 title-col">

                    <ul class="new-event-inputs">

                        <li>Title*</li>
                        <li>Location*</li>
                        <li>Description*</li>
                        <li>Reminders</li>
                        <label>* = Required</label>

                    </ul>

                    <div class="row privacy-row">

                        <div class="col-md-3 priv-title">

                            <span id="priv-title">Privacy:</span>

                        </div>

                        <div class="col-md-3 priv-list">

                            <select id="privacy">

                                <option value="public" selected>Public (Default)</option>
                                <option value="private">Private</option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- make some fields required -->
                <div class="col-md-4 inputs-col">

                    <form class="event-form">

                        <div class="form-group">

                            <input id="form-title" type="text" class="form-control" name="title" placeholder="Title">

                        </div>

                        <div class="form-group">

                            <input id="form-location" type="text" class="form-control" name="location" placeholder="Location">

                        </div>
                        <div class="form-group">

                            <input id="form-desc" type="text" class="form-control" name="description" placeholder="Description">

                        </div>
                        <div class="form-group">

                            <input id="form-reminders" type="text" class="form-control" name="Reminders" placeholder="Reminders">

                        </div>

                    </form>
                    <div>

                        <!-- need functionality to invite peopole (possible pop up/dropdown) -->
                        <button class="btn" id="form-add-attend-btn">Add Attendees</button>

                        <!-- modal for adding attendees -->
                        <div id="inviteModal" class="modal">

                            <!-- content -->
                            <div class="modal-content">

                                <div class="modal-header row">
                                    <div class="col-md-6">
                                        <h2>Add Participants</h2>
                                    </div>
                                    <div class="col-md-3">
                                        <h2>Duration</h2>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="numInputSm" type="number" id="durationHr" min="0" max="24" required>&nbsp;Hr&nbsp;
                                        <input class="numInputSm" type="number" id="durationMin" min="0" max="24" required>&nbsp;Min
                                    </div>
                                </div>

                                <div class="modal-body">

                                    <form class="invite-form">

                                        <div class="row">
                                            <div class="col-md-10">

                                                <input id="form-invitedUser" type="email" class="form-control" name="invitedUser" placeholder="Email">

                                            </div>

                                            <div class="col-md-2">

                                                <button class="btn addUser">Add User</button>

                                            </div>

                                        </div>

                                    </form>

                                    <div class="list-container">

                                        <ul id="userList">



                                        </ul>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button id="closeBtn" class="btn cancel">Ok</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 availabilities-col">
                    <p>Available Times</p>
                    <div class="pre-scrollable">
                        <ul id="availablilities-list">
                            <!-- buttons with available times go here -->
                        </ul>
                    </div>
                </div>

            </div>

            <button class="btn setup-event-btn">Create Event</button>

        </div>
    </div>
    <br>

    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/events.js"></script>

</body>

</html>
