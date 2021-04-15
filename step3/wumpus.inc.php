<?php
/**
 * Create an array that represents the cave
 * @returns Array
 */
function cave_array() {
    $cave = array(1 => array(5, 6, 2),
                2 => array(1, 8, 3),
                3 => array(2,10,4),
                4 => array(3,12,5),
                5 => array(4,14,1),
                6 => array(1,15,7),
                7 => array(6,16,8),
                8 => array(2,7,9),
                9 => array(8,17,10),
                10 => array(3,11,9),
                11 => array(18,12,10),
                12 => array(4,13,11),
                13 => array(19,12,14),
                14 => array(5,13,15),
                15 => array(20,14,6),
                16 => array(7,17,20),
                17 => array(16,9,18),
                18 => array(11,17,19),
                19 => array(13,18,20),
                20 => array(19,16,15));
    return $cave;
}
?>