<?php
    require_once 'core/init.php';
    $user = new User();

    //user online
    //user invited to event
    if(!Input::exist('id', 'get') || !$user->isLoggedIn()) {
        Redirect::to(Config::get('menu/home'));
    }
    $viewEvent = new Events();
    $viewEvent = $viewEvent->getEvents(Input::get('id'))[0];
    $attendens = new Attendens();
    $attendens = $attendens->getAttendens(Input::get('id'));
    $vote = new Vote();
    $vote = $vote->getAllByEventid(Input::get('id'));
    $found = false;
    if($attendens) {
        foreach($attendens as $obj) {
            if($obj->email === Session::get(Config::get('session/session_name'))) {
                $found = true;
            }
        }
    }

    if(!$found && Session::get(Config::get('session/session_name')) !== $viewEvent->useremail){
        Redirect::to(Config::get('menu/home'));
    }
    if(Input::exist('addAntendens')) {
        $event = new Events();
        $id = Input::get('eventid');
        $event = $event->getEvents($id)[0];
        if($event){
            if (Session::get(Config::get('session/session_name')) === $event->useremail) {
                $emails = array();

                if(strpos(Input::get('emails'), ',')) {
                    $emails = explode(",", Input::get('emails'));
                } else {
                    $emails = array(Input::get('emails'));
                }
                $attendens = new Attendens();
                foreach($emails as $email) {
                    if($email !== Session::get(Config::get('session/session_name'))) {
                        $attendens->create(array(
                            'eventid' => $id,
                            'email' => $email
                        ));
                    }
                }
            }
        }
    }
    if(Input::exist('submitvote')) {
        $id = Input::get('id', 'get');
        $vote = new Vote();
        if(!$vote->find(Session::get(Config::get('session/session_name')), $id)) {
            try {
                if(Input::get('vote') === 'yes' || Input::get('vote') === 'no'){
                    $vote->create(array(
                        'useremail' => Session::get(Config::get('session/session_name')),
                        'eventid' => $id,
                        'vote' => Input::get('vote'),
                        'comment' => null
                    ));
                } else if(Input::get('comment') !== '') {
                    $vote->create(array(
                        'useremail' => Session::get(Config::get('session/session_name')),
                        'eventid' => $id,
                        'vote' => null,
                        'comment' => Input::get('comment')
                    ));
                }
                //TODO: Check time is avalible
                Session::flash('votesuccess', 'You have now voted!');
                Redirect::to('viewevent.php?id='.$id);
            } catch(Exception $e) {
                echo $e . '<br />';
            }
        } else {
            echo 'you have already voted';
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
        <title>Meeting-Scheduler View Event</title>
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

        <div class="container" >
            <h1 id="new-user-title"><?php echo $viewEvent->title;?></h1>
            <div class="row">
                <div class="col-md-12 calendar-col">
                    <div class="col-md-6 date-col">
                        <label> <b>Date:</b>
                            <?php echo $viewEvent->date;?>
                            <?php echo '<br />';?>
                        </label><br />
                        <label> <b>Time:</b>
                            <?php echo $viewEvent->timestart . ' - ' . $viewEvent->timeend;?>
                        </label>
                        <?php echo '<br />';?>
                        <label> <b>Host:</b>
                            <?php echo $viewEvent->useremail;?>
                        </label>
                        <?php echo '<br />';?>
                        <div class="col-md-12 calendar-col">
                            <label id="startLabel"> <b>Description:</b> <br />
                                <?php echo $viewEvent->description;?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 time-col">
                        <label id="startLabel"> <h5>Attendens</h5>
                            <ul style="list-style: none; text-align: center; padding-left: 0;">
                            <?php
                                if($attendens) {
                                    foreach($attendens as $obj) {
                                        echo '<li>' . $obj->email . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </label>
                    </div>
                </div>

                <?php if($found){ ?>
                    <div class="col-md-12 calendar-col">
                        <h1 id="new-user-title">Vote</h1>
                        <form action="" method="POST">
                            <label id="startLabel"> Vote:
                                <select name="vote" id="Vote">
                                <option value="">-</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                            </label>
                            <label id="endLabel">OR Suggest another time:
                                <textarea type="text" class="form-control" name="comment" id="comment" placeholder="Comment" rows="3"></textarea>
                            </label>
                            <button class="btn setup-event-btn" value="Submit Vote" id="submitvote" type="submit" name="submitvote">Submit Vote</button>
                        </form>
                    </div>
                <?php }?>

            </div>
            <?php if(Session::get(Config::get('session/session_name')) === $viewEvent->useremail) { ?>
            <div class="row">
                <div class="col-md-12 calendar-col">
                        <h1 id="new-user-title">Vote Submits</h1>
                        <?php
                        $result = array();
                        if($vote){
                            foreach($vote as $v) {
                                if($v->vote === 'yes') {
                                    array_push($result, $v->useremail);
                                    array_push($result, " ", "Yes", '<br />');
                                } else if($v->vote === 'no') {
                                    array_push($result, $v->useremail);
                                    array_push($result, " ", "No", '<br />');
                                } elseif($v->comment) {
                                    array_push($result, $v->useremail);
                                    array_push($result, " ", $v->comment, '<br />');
                                }
                            }
                        }
                        ?>
                        <div class="col-md-12">
                            <?php
                            foreach($result as $r) {
                                echo $r;
                            }?>
                        </div>

                    </div>
            </div>
            <div class="modal-content" style="min-height: 500px;min-width: 750px">
                <div class="modal-header row" style="margin-right: 0; margin-left: 0;">
                    <div class="col-md-12">
                        <h2>Add Attendens</h2>
                    </div>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-10">
                            <input id="form-invitedUser" type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-2">
                            <button class="btn addUser" value="Add User">Add Email</button>
                        </div>
                    </div>
                    <div class="list-container">
                        <ul id="userList">

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <input type="hidden" name="emails" id="emails" value="">
                        <input type="hidden" name="eventid" id="eventid" value="<?php echo $viewEvent->id; ?>">
                        <button class="btn cancel" style="width:auto;" id="addAntendens" type="submit" name="addAntendens" value="Add">Add</button>
                    </form>
                </div>
            </div>
            <?php }?>
        </div>
        <script type="text/javascript" src="js/events.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script>
            if (!window.jQuery) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
        </script>
    </body>
</html>
