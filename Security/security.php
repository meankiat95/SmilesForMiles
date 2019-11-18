<?php

class security{
    function sanitize($input) {
        $input = htmlspecialchars($input);
        $input = strip_tags($input);
        $input = stripslashes($input);
        $input = trim($input);
        return $input;
    }
}

?>