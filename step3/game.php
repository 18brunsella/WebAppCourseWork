<?php
require 'format.inc.php';
require 'wumpus.inc.php';

$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit
$wumpus = 16; // Room with the wumpus

$cave = cave_array(); // Get the cave
if(isset($_GET['r']) && isset($cave[$_GET['r']]) ) {
    // We have been passed a room number
    $room = $_GET['r'];
}
if(in_array($room, $pits)){
    header("Location: lose.php");
    exit;
}

if($room == $wumpus){
    header("Location: lose.php");
    exit;
}

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
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';
        ?>

        <p class="roomsix">You are in room <?php if($room == $birds){$room = 10; echo $room;
        if(in_array($room, $pits)){
            header("Location: lose.php");
            exit;
        }}else{echo $room;} ?>.</p>
        <?php for($i = 0; $i < 3; $i++){
            if($cave[$room][$i] == $birds){
                echo "<p>You hear birds!</p>";
            }
        }?>
        <?php for($i = 0; $i < 3; $i++){
            if(in_array($cave[$room][$i], $pits)){
                echo "<p>You feel a draft!</p>";
            }
        }
        ?>
        <?php for($i = 0; $i < 3; $i++){
            if($cave[$room][$i] == $wumpus) {
                echo "<p>You smell a wumpus!</p>";
            }else{
                for($j = 0; $j < 3; $j++){
                    if($cave[$cave[$room][$i]][$j] == $wumpus){
                        echo "<p>You smell a wumpus</p>";
                    }
                }
            }
        }
        ?>
    </div>

    <div class="rooms">
        <div class="room">
            <figure>
                <img src="cave2.jpg" width="180" height="135" alt="a rock in a cave">
                <figcaption><p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p>
                            <p><a href=<?php if($cave[$room][0] == $wumpus){echo "win.php";}else{echo "game.php?r=".$room."&a=".$cave[$room][0];} ?>>Shoot Arrow</a></p>
                </figcaption>
            </figure>
        </div>
        <div class="room">
            <figure>
                <img src="cave2.jpg" width="180" height="135" alt="a rock in a cave">
                <figcaption><p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p>
                            <p><a href=<?php if($cave[$room][1] == $wumpus){echo "win.php";}else{echo "game.php?r=".$room."&a=".$cave[$room][1];} ?>>Shoot Arrow</a></p>
                </figcaption>
            </figure>
        </div>
        <div class="room">
            <figure>
                <img src="cave2.jpg" width="180" height="135" alt="a rock in a cave">
                <figcaption><p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p>
                            <p><a href=<?php if($cave[$room][2] == $wumpus){echo "win.php";}else{echo "game.php?r=".$room."&a=".$cave[$room][2];} ?>>Shoot Arrow</a></p>
                </figcaption>
            </figure>
        </div>
    </div>

    <div class="remains">
        <p>You have 3 arrows remaining.</p>
    </div>

</div>
</body>
</html>