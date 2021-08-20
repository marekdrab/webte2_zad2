<?php
require_once "classes/helper/Database.php";

$db = new Database();
$db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function validate_fields(){
    $db = new Database();
    $db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db->getQuery("select case when ".$_POST["year"]." in (select year from oh where type like '".$_POST['type']."') 
                                then 1 else 0 end as validYear");
}

if($_SERVER[ 'REQUEST_METHOD' ]=='POST') {
    $result = validate_fields();
    foreach ($result as $row=>$a){
        $result = $a["validYear"];
    }
    if($result==0){
        $error = 'Zadany rok nezodpoveda typu olympiady';
    }else{
        $id = $_GET["id"];
        $year = $_POST["year"];
        $type = $_POST["type"];
        $placing = $_POST["placing"];
        $discipline = $_POST["discipline"];
        $db->executeQuery("INSERT INTO umiestnenia (person_id, oh_id, placing, discipline)
                                 VALUES (".$id.",(select id from oh where oh.year=".$year." and oh.type like '".$type."'),
                                 ".$placing.",'".$discipline."')");
        echo "<script>location.href='detail.php?id=".$id."'</script>";
    }
}

include_once "header.php";
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php if( isset( $error ) && !empty( $error ) ): ?>
                    <span class="error">
                            <?php echo $error; ?>
                        </span>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="year">Rok</label>
                    <input class="form-control" type="number" name="year" id="year" required>
                </div>
                <div class="form-group">
                    <label for="type">ZOH</label>
                    <input class="form-check-input" type="radio" value="ZOH" name="type" id="type" required>
                    <label for="type">LOH</label>
                    <input class="form-check-input" type="radio" value="LOH" name="type" id="type">
                </div>
                <div class="form-group">
                    <label for="placing">Miesto</label>
                    <input class="form-control" type="number" name="placing" id="placing" required>
                </div>
                <div class="form-group">
                    <label for="discipline">Disciplína</label>
                    <input class="form-control" type="text" name="discipline" id="discipline" required>
                </div>
                <button class="btn btn-dark" type="submit" >Pridať</button>
            </form>
        </div>
    </div>
</div>
