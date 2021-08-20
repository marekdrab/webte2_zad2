<?php
require_once "classes/helper/Database.php";



$db = new Database();
$db->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER[ 'REQUEST_METHOD' ]=='POST'){
    try{
        if(isset($_POST["death_place"])&&isset($_POST["death_country"])&&$_POST["death_day"]>$_POST["birth_day"]){
            $death_day = date('j.n.Y',strtotime($_POST["death_day"]));
            $death_place = $_POST["death_place"];
            $death_country = $_POST["death_country"];
        }
        else{
            $death_day = null;
            $death_place = null;
            $death_country = null;
        }
        $stmt = $db->getConnection()->prepare("INSERT INTO osoby (name,surname,birth_day, birth_place, birth_country, 
                                                                        death_day, death_place, death_country)
                                                VALUES ('".$_POST['name']."', '".$_POST['surname']."','".date('j.n.Y',strtotime($_POST['birth_day']))."',
                                                '".$_POST['birth_place']."','".$_POST['birth_country']."','".$death_day."','".$death_place."','".$death_country."')");
        $stmt->execute();
        $result = $db->getQuery("select id from osoby where name like '".$_POST['name']."' and surname like '".$_POST['surname']."'");
        foreach( $result as $row=>$c )
        {
            $id = $c["id"];
        }
    }
    catch (Exception $e){
        $errors = $e;
    }
   if(!$errors){
        echo "<script>location.href='detail.php?id=".$id."'</script>";
    }
}



include_once "header.php";
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 left-allign">
            <?php if( isset( $errors ) && !empty( $errors ) ): ?>
                    <?php foreach( $errors as $error ): ?>
                        <span class="error">
                            <?php echo $error[2]; ?>
                        </span>
                    <?php endforeach; ?>
            <?php endif; ?>

            <?php include_once "form.php";?>
        </div>
    </div>
</div>