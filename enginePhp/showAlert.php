<?php
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    if(isset($_SESSION["errorMsg"]) && $_SESSION["errorMsg"]!=""){
        $msg = $_SESSION["errorMsg"];
        echo "<div id=\"alert\" class=\"return alert\">$msg</div>";
        $_SESSION["errorMsg"] = "";
    }
    else if(isset($_SESSION["successMsg"]) && $_SESSION["successMsg"]!=""){
        $msg = $_SESSION["successMsg"];
        echo "<div id=\"alert\" class=\"delivered alert\">$msg</div>";
        $_SESSION["successMsg"] = "";
    }