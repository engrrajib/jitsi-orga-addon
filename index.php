<?php
    //start session
    session_start();

    //get configuration
    $config = json_decode(file_get_contents("config/config.json"), true);

    //check security options
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
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Own Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?php echo $config["name"]; ?></title>
  </head>
  <body>

    <!-- Navigation-Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $config["homepage"]; ?>" target="_blank"><?php echo $config["name"]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Konferenz beitreten <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="leiter.php">Konferenzleiter-Login</a>
            </div>
        </div>
    </nav>

    <!--Container-->
    <center>
        <div id="container" class="centered-box border border-primary rounded">
            <p>Um der Konferenz beizutreten, bitte die folgenden Felder ausfüllen!</p>

            <!-- Formular -->
            <form action="conference.php" method="post">
                <!-- Fullname -->
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="fullname-description">Vor- und Nachname</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Bsp.: Max Mustermann" aria-label="Vor- und Nachname" aria-describedby="fullname-description" id="fullname" name="fullname" required autofocus>
                </div>
                <br>

                <!-- E-Mail -->
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="email-description">E-Mail</span>
                    </div>
                    <input type="email" class="form-control" placeholder="Nur wenn vorhanden, nicht zwingend notwendig" aria-label="E-Mail" aria-describedby="email-description" id="email" name="email">
                </div>
                <br>

                <!-- Room-Selection -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="room">Konferenzraum</label>
                    </div>
                    <select class="custom-select" id="room" name="room" required>
                        <option selected value="chooseroom">Bitte wählen...</option>
                        <!-- Return all Rooms from config -->
                        <?php
                            foreach ($config["conferences"] as $conference){
                                // echo all options
                        ?>
                                <option value="<?php echo $conference["jitsi-room"]; ?>"><?php echo $conference["name"]; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                
                <!-- Join-Button -->
                <button type="submit" class="btn btn-primary">Konferenz beitreten</button>
                </form>
        </div>
    </center>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>