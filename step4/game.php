<?php
    require 'format.inc.php';
    require 'lib/game.inc.php';
    $view = new Wumpus\WumpusView($wumpus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stalking the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
    <div class="mainimg">
        <img src="cave.jpg" width="600" height="325" alt="an entrance to a cave">
    </div>

    <div class="quotes">
        <?php
        echo $view->presentStatus();
        ?>
    </div>

    <div class="rooms">
        <div class="room">
            <figure>
                <?php
                echo $view->presentRoom(0);
                ?>
            </figure>
        </div>
        <div class="room">
            <figure>
                <?php
                echo $view->presentRoom(1);
                ?>
            </figure>
        </div>
        <div class="room">
            <figure>
                <?php
                    echo $view->presentRoom(2);
                ?>
            </figure>
        </div>
    </div>

    <div class="remains">
        <?php
        echo $view->presentArrows();
        ?>
    </div>

</div>
</body>
</html>