<?php
require 'format.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Wumpus Killed You</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
    <div class="mainimg">
        <img src="wumpus-wins.jpg" width="600" height="325" alt="a cat with bloody fangs holding a brain in its mouth">
    </div>

    <div class="startpage">
        <p>You died and the Wumpus ate your brain!</p>
        <p><a href="welcome.php">New Game</a></p>
    </div>


</div>
</body>
</html>