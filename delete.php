<?php
require_once "classes/helper/Database.php";

if (isset($_GET["id"])) {
    $db = new Database();
    $db->deleteById($_GET["id"]);
    echo "<script>location.href='index.php';</script>";}