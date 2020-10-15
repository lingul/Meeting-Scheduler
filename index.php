<?php require_once 'core/init.php';
if(Session::exists('login')) {
    echo Session::flash('login');
}
if(Session::exists('register')) {
    echo Session::flash('register');
}
if(Session::exists('eventcreate')) {
    echo Session::flash('eventcreate');
}
$user = new User();
$events = new Events();
$attendens = new Attendens();
$userEvents = '{}';
if ($user->isLoggedIn()) {
    $userEvents = $events->getEvents(Session::get(Config::get('session/session_name')), true);
    $attendens = $attendens->getEvents(Session::get(Config::get('session/session_name')));
}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tab icon -->
    <link rel="icon" href="img/penme.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <link rel="stylesheet" href="css/style4.css">

    <!-- Calendar stuff -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
    <link rel="stylesheet" href="schedule-template/css/reset.css">
    <!-- CSS reset -->
    <link rel="stylesheet" href="schedule-template/css/style.css">
    <!-- Resource style -->

    <title>Meeting-Scheduler Home</title>

    <!-- jQuery / Popper.js / Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

</head>
<body>
    <div class="wrapper">
        <!-- Page Content Holder -->
        <div id="content">

            <!-- Main Content -->
            <div class="container">
                <br>
                <div class="row justify-content-center align-items-center">
                    <div class="col-3 text-center">
                        <button class="btn btn-success btn-lg" id="last_wk_btn">Last Week</button>
                    </div>
                    <div class="col-4 text-center" id="month_year_text">

                    </div>
                    <div class="col-2 text-center">
                        <button class="btn btn-success btn-lg" id="next_wk_btn">Next Week</button>
                    </div>
                </div>
            </div>
            <div id="calendar">
                <!-- Toolbar with date information displayed here -->
                <div class="toolbar">
                </div>
                <!-- Calendar displayed here-->
                <div id="schedule" class="cd-schedule loading pre-scrollable">
                    <div class="timeline">
                        <ul>
                            <li id="0:00">
                                <span>12:00 AM</span>
                            </li>
                            <li id="0:30">
                                <span>00:30</span>
                            </li>
                            <li id="1:00">
                                <span>1:00 AM</span>
                            </li>
                            <li id="1:30">
                                <span>01:30</span>
                            </li>
                            <li id="2:00">
                                <span>2:00 AM</span>
                            </li>
                            <li id="2:30">
                                <span>02:30</span>
                            </li>
                            <li id="3:00">
                                <span>3:00 AM</span>
                            </li>
                            <li id="3:30">
                                <span>03:30</span>
                            </li>
                            <li id="4:00">
                                <span>4:00 AM</span>
                            </li>
                            <li id="4:30">
                                <span>04:30</span>
                            </li>
                            <li id="5:00">
                                <span>5:00 AM</span>
                            </li>
                            <li id="5:30">
                                <span>05:30</span>
                            </li>
                            <li id="6:00">
                                <span>6:00 AM</span>
                            </li>
                            <li id="6:30">
                                <span>06:30</span>
                            </li>
                            <li id="7:00">
                                <span>7:00 AM</span>
                            </li>
                            <li id="7:30">
                                <span>07:30</span>
                            </li>
                            <li id="8:00">
                                <span>8:00 AM</span>
                            </li>
                            <li id="8:30">
                                <span>08:30</span>
                            </li>
                            <li id="9:00">
                                <span>9:00 AM</span>
                            </li>
                            <li id="9:30">
                                <span>09:30</span>
                            </li>
                            <li id="10:00">
                                <span>10:00 AM</span>
                            </li>
                            <li id="10:30">
                                <span>10:30</span>
                            </li>
                            <li id="11:00">
                                <span>11:00 AM </span>
                            </li>
                            <li id="11:30">
                                <span>11:30</span>
                            </li>
                            <li id="12:00">
                                <span>12:00 PM</span>
                            </li>
                            <li id="12:30">
                                <span>12:30</span>
                            </li>
                            <li id="13:00">
                                <span>1:00 PM</span>
                            </li>
                            <li id="13:30">
                                <span>13:30</span>
                            </li>
                            <li id="14:00">
                                <span>2:00 PM</span>
                            </li>
                            <li id="14:30">
                                <span>14:30</span>
                            </li>
                            <li id="15:00">
                                <span>3:00 PM</span>
                            </li>
                            <li id="15:30">
                                <span>15:30</span>
                            </li>
                            <li id="16:00">
                                <span>4:00 PM</span>
                            </li>
                            <li id="16:30">
                                <span>16:30</span>
                            </li>
                            <li id="17:00">
                                <span>5:00 PM</span>
                            </li>
                            <li id="17:30">
                                <span>17:30</span>
                            </li>
                            <li id="18:00">
                                <span>6:00 PM</span>
                            </li>
                            <li id="18:30">
                                <span>18:30</span>
                            </li>
                            <li id="19:00">
                                <span>7:00 PM</span>
                            </li>
                            <li id="19:30">
                                <span>19:30</span>
                            </li>
                            <li id="20:00">
                                <span>8:00 PM</span>
                            </li>
                            <li id="20:30">
                                <span>20:30</span>
                            </li>
                            <li id="21:00">
                                <span>9:00 PM</span>
                            </li>
                            <li id="21:30">
                                <span>21:30</span>
                            </li>
                            <li id="22:00">
                                <span>10:00 PM</span>
                            </li>
                            <li id="22:30">
                                <span>22:30</span>
                            </li>
                            <li id="23:00">
                                <span>11:00 PM</span>
                            </li>
                            <li id="23:30">
                                <span>23:30</span>
                            </li>
                        </ul>
                    </div>
                    <!-- .timeline -->

                    <div class="events">
                        <ul>
                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Sunday<br>
                                        <p id="date-label-0"></p>
                                    </span>
                                </div>

                                <ul id="SundayInfo">

                                </ul>
                            </li>
                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Monday<br>
                                        <p id="date-label-1"></p>
                                    </span>
                                </div>

                                <ul id="MondayInfo">

                                </ul>
                            </li>

                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Tuesday<br>
                                        <p id="date-label-2"></p>
                                    </span>
                                </div>

                                <ul id="TuesdayInfo">

                                </ul>
                            </li>

                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Wednesday<br>
                                        <p id="date-label-3"></p>
                                    </span>
                                </div>

                                <ul id="WednesdayInfo">

                                </ul>
                            </li>

                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Thursday<br>
                                        <p id="date-label-4"></p>
                                    </span>
                                </div>

                                <ul id="ThursdayInfo">

                                </ul>
                            </li>

                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Friday<br>
                                        <p id="date-label-5"></p>
                                    </span>
                                </div>

                                <ul id="FridayInfo">

                                </ul>
                            </li>
                            <li class="events-group">
                                <div class="top-info">
                                    <span>
                                        Saturday<br>
                                        <p id="date-label-6"></p>
                                    </span>
                                </div>

                                <ul id="SaturdayInfo">

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="event-modal">
                        <header class="header">
                            <div class="content">
                                <span class="event-date"></span>
                                <h3 class="event-name"></h3>
                            </div>
                            <div class="header-bg"></div>
                        </header>
                        <div class="body">
                            <p id="eventID"></p>
                            <div class="event-info">
                                <p id="event-text"></p>
                                <div id="indexBtns">
                                    <button class="btn-lg" id="editEvent" name="event">Edit Event</button>
                                    <span id="expiredSpan" style="display: none; color: red;"> Event is expired and can no longer be edited </span>
                                    <button class="btn-lg" id="deleteBtn">Delete Event</button>
                                </div>
                            </div>

                            <div class="body-bg"></div>
                        </div>
                        <a href="#0" class="close">Close</a>
                    </div>
                    <div class="cover-layer"></div>
                </div>
            </div>
        </div>
        <!-- Setup Events -->
        <div id="setupEventModal" class="modal">
            <div class="modalContent">
                <div class="container img-container">
                    <img class="img-responsive" src="img/penme.png">
                </div>
            </div>
        </div>

        <!-- Sidebar Holder -->
        <nav id="sidebar" class="active">

            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <h3>Menu</h3>
                <div class="img-collapse">
                    <img src="img/penme.png" alt="PenMe">
                </div>
            </div>

            <ul class="list-unstyled">
            <?php
                if ($user->isLoggedIn()) {
                ?>
                <li id="setup-nav-btn">
                    <a aria-expanded="false" href="<?php echo Config::get('menu/createEvent'); ?>">Setup Event
                        <div class="menuIcons"><i class="fas fa-sign-in-alt"></i></div>
                    </a>
                </li>
                <?php
                }
                if (!$user->isLoggedIn()) {
                ?>
                <li class="nav-item">
                    <a class="nav-link login-btn" aria-expanded="false" href="<?php echo Config::get('menu/login'); ?>">Log In
                        <div class="menuIcons"><i class="fas fa-sign-in-alt"></i></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sign-up-btn" aria-expanded="false" href="<?php echo Config::get('menu/register'); ?>">Sign Up
                        <span class="sr-only">(current)</span>
                        <div class="menuIcons"><i class="fas fa-user-plus"></i></div>
                    </a>
                </li>
                <?php
                } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link logout-btn" href="<?php echo Config::get('menu/logout'); ?>" aria-expanded="false">Log Out
                        <div class="menuIcons"><i class="fas fa-sign-out-alt"></i></div>
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
    <input type="hidden" id="userEvents" value='<?php
        if($userEvents && $attendens) {
            echo json_encode(array_merge($userEvents, $attendens));
        } else if($userEvents) {
            echo json_encode($userEvents);
        } else if($attendens) {
            echo json_encode($attendens);
        } else {
            echo '';
        } ?>'>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/events.js"></script>

    <!-- Schedule template scripts -->
    <script src="schedule-template/js/modernizr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>
        if (!window.jQuery) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
    </script>
    <script src="schedule-template/js/main.js"></script>

    <!-- Resource jQuery -->
</body>

</html>
