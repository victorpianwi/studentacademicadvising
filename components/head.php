<?php

session_start();

if (!isset($_SESSION["online"])) {
    if ($url != "log-in" && $url != "register") {
        header("Location: log-in?rd=" . $url);
    } else {
        header("Location: log-in");
    }
    exit;
}


?>