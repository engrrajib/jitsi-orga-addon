<?php
    //start session
    session_start();

    //get configuration
    $config = json_decode(file_get_contents("config/config.json"), true);

    //redirect if user is already logged in
    if (!isset($_SESSION["leiter_logged_in"])){
        // if variable logged in isn't set yet, set it to false
        $_SESSION["leiter_logged_in"] = false;
    }
    if($_SESSION["leiter_logged_in"] == true){
        header("Location: leiter.php");
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

    <title>Konferenzleiter-Login | <?php echo $config["name"]; ?></title>
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
            </div>
        </div>
    </nav>

    <!--Container-->
    <div id="container">
        <center>
            <!-- Error-Message-->
            <?php
                if(isset($_GET["error"])){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo strval($_GET["error"]); ?>
                    </div>
                    <?php
                }
            ?>
            <!-- Login-Form -->
            <div class="centered-box border border-primary rounded">
                <form action="leiterloginbackend.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="password-description">Passwort:</span>
                        </div>
                        <input type="password" class="form-control" placeholder="Passwort eingeben..." aria-label="Passwort" aria-describedby="password-description" name="password" autofocus required>
                    </div>
                    <button type="submit" class="btn btn-primary">Als Konferenzleiter anmelden</button>
                </form>
            </div>
        </center>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>