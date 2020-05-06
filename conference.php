<?php
    // MAIN SCRIPT
    //start session
    session_start();

    //get config
    $config = json_decode(file_get_contents("config/config.json"), true);

    //check if user is logged in
        if (!isset($_SESSION["logged_in"])){
            // if variable logged in isn't set yet, set it to false
            $_SESSION["logged_in"] = false;
        }
        if($_SESSION["logged_in"] !== true){
            // if user isn't logged in
            if($config["password"] !== ""){
                //if password is set
                header("Location: login.php");
            }
            // if no password is set, everyone can access the site => proceed
        }
    
    // get variables
    //  name
        if (isset($_POST["fullname"])){
            $fullname = $_POST["fullname"];
        } else {
            die("403: Forbidden (Error: 0x002 Kein Name angegeben)");
        }
    //  email
        if (isset($_POST["email"])){
            $email = $_POST["email"];
        } else {
            $email = "";
        }
    //  conference-room
        if (isset($_POST["room"]) && $_POST["room"] !== "chooseroom"){
            $room = $_POST["room"];
        } else {
            die("403: Forbidden (Error: 0x003 Manipulation festgestellt)");
        }
    
    // get name of conference-room
        foreach($config["conferences"]as $conference){
            if($conference["jitsi-room"] == $room){
                $conferencename = $conference["name"];
            }
        }
    // Return HTML
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Own Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/callstyle.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Jitsi Meet API -->
    <script src='https://meet.jit.si/external_api.js'></script>

    <title><?php echo $conferencename; ?> | <?php echo $config["name"]; ?></title>
  </head>
  <body>
    <!-- Navigation-Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $config["homepage"]; ?>" target="_blank"><?php echo $config["name"]; ?></a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- Navigation - Links -->
            </div>
        </div>
        <span class="navbar-text">
            <?php echo $fullname; if($email !== ""){?> - <?php echo $email; }; ?>
        </span>
    </nav>

    <!--Container-->
    <div id="container" class="container-fluid">
        <!-- Jitsi Meet Container -->
        <div id="callcontainer"></div>
    </div>

    <!-- Script to run jitsi meet -->
    <script>
        // Variables
        var ownID = -1;
        const displayname = '<?php echo $fullname; ?>';
        const email = '<?php echo $email; ?>';
        const domain = '<?php echo $config["jitsi-domain"]; ?>';
        const options = {
            roomName: '<?php echo $room; ?>',
            userInfo: {
                email: '<?php echo $email; ?>',
                displayName: '<?php echo $fullname; ?>'
            },
            interfaceConfigOverwrite:{
                SHOW_JITSI_WATERMARK: false,
                TOOLBAR_BUTTONS: [
                    'microphone', 'camera', 'desktop', 'closedcaptions', 'desktop',
                    'fodeviceselection', 'hangup', 'chat',
                    'etherpad', 'raisehand',
                    'videoquality', 'filmstrip',
                    'tileview', 'videobackgroundblur'
                ],
            },
            parentNode: document.querySelector('#callcontainer')
        };
        const api = new JitsiMeetExternalAPI(domain, options);

        // set conference name
        api.executeCommand('subject', '<?php echo $conferencename; ?>');

        // event listener functions
        //  room left
        function leaveRoom(object){
            document.location = "leave.php";
        }

        // add event listeners
        api.addEventListeners({
            videoConferenceLeft: leaveRoom
        });

        // join silent
        api.isAudioMuted().then(unmuted => {
            api.executeCommand('toggleAudio');
        });

        // join without video
        api.isVideoMuted().then(unmuted => {
            api.executeCommand('toggleVideo');
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>