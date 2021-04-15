<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Stalking the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
    <div class="mainimg">
        <img src="cave-wumpus.jpg" width="600" height="325" alt="a cat with bloody fangs in a cave">
    </div>

    <div class="startpage">
        <p> Welcome to <i>Stalking the Wumpus</i></p>
        <p><a href="instructions.php">Instructions</a></p>
        <p><a href="game.php">Start Game</a></p>
    </div>

</div>


</body>
</html>