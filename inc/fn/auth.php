<?php

include "inc/db/mysql.php";
session_start();

if (isset($_SESSION["user_id"])) {
    $get_user = mysqli_safe_query("SELECT * FROM users WHERE id = %d", $_SESSION["user_id"]);
    if (!mysqli_num_rows($get_user)) {
        header("Location: login");
    }

    $user = mysqli_fetch_object($get_user);
}

function add_to_cart($id)
{
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    if (!in_array($id, $_SESSION["cart"])) {
        $_SESSION["cart"][] = $id;
    } else {
        $key = array_search($id, $_SESSION["cart"]);
        unset($_SESSION["cart"][$key]);
    }
}
