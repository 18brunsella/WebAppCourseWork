<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>You Killed the Wumpus</title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php echo present_header("Stalking the Wumpus"); ?>
<div class="main">
    <div class="mainimg">
        <img src="dead-wumpus.jpg" width="600" height="325" alt="a dead cat with fangs">
    </div>
    <div class="startpage">
        <p>You killed the Wumpus</p>
        <p><a href="welcome.php">New Game</a></p>
    </div>
</div>
</body>
</html>