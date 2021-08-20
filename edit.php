<?php
require_once "classes/helper/Database.php";
$db = new Database();

if (isset($_GET["id"])) {
    $result = $db->getQuery("select * from osoby where id=" . $_GET["id"]);
    foreach ($result as $row => $a) {
        $name = $a["name"];
        $surname = $a["surname"];
        $birth_day = $a["birth_day"];
        $birth_place = $a["birth_place"];
        $birth_country = $a["birth_country"];
        $death_day = $a["death_day"];
        $death_place = $a["death_place"];
        $death_country = $a["death_country"];
    }
}
if ($_SERVER[ 'REQUEST_METHOD' ]=='POST') {
    if($_POST["death_day"]>$_POST["birth_day"]){
        $death_day = date('j.n.Y',strtotime($_POST["death_day"]));

    }
    else{
        $death_day = null;
    }
    $db->executeQuery("update osoby set name='".$_POST['name']."', surname='".$_POST['surname']."', birth_day='".date('j.n.Y',strtotime($_POST['birth_day']))."', 
                                birth_place='".$_POST['birth_place']."', birth_country='".$_POST['birth_country']."', death_day='".$death_day."',
                                death_place='".$_POST['death_place']."', death_country='".$_POST['death_country']."' where id=".$_GET["id"]);
    echo "<script>location.href='detail.php?id=".$_GET["id"]."'</script>";
}


include_once "header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 left-allign">
            <?php include_once "form.php";?>

        </div>
    </div>
</div>


