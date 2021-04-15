<?php
require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

define("WUMPUS_SESSION", 'wumpus');

// The room will start at 11 for cheat mode
if(isset($_GET['c'])){
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);   // Seed: 1422668587
}

// If there is a Wumpus session, use that. Otherwise, create one
if(!isset($_SESSION[WUMPUS_SESSION])) {
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus();
}

$wumpus = $_SESSION[WUMPUS_SESSION];