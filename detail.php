<?php
require_once "classes/helper/Database.php";

if (isset($_GET["id"])) {
    $db = new Database();

    $result = $db->getQuery("select um.placing as placing, 
                                                    um.discipline as discipline, oh.type as type, oh.year as year, concat(oh.country, ', ', oh.city) as place
                                                    from osoby as os
                                                    left join umiestnenia as um on os.id = um.person_id
                                                    left join oh on oh.id = um.oh_id
                                                    where os.id =" . $_GET["id"]);

    $result2 = $db->getQuery("select name, surname, concat(birth_day,', ',birth_place,', ',birth_country) as birth, 
                                    concat(death_day,', ',death_place,', ',death_country) as death  from osoby as os
                                                    where os.id =" . $_GET["id"]);
}
include_once "header.php";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>
                <?php foreach ($result2 as $row => $a) {
                    echo $a["name"] . ' ' . $a["surname"];
                } ?>
            </h1>
            <p>
                <?php echo $a["birth"] . ' ' . $a["death"]; ?>
            </p>
            <table class="myTable">
                <thead>
                <tr>
                    <th>Typ</th>
                    <th>Rok</th>
                    <th>Miesto</th>
                    <th>Umiestnenie</th>
                    <th>Disciplína</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $row => $b) { ?>
                    <tr>
                        <td><?php echo $b["type"]; ?></td>
                        <td><?php echo $b["year"]; ?></td>
                        <td><?php echo $b["place"]; ?></td>
                        <td><?php echo $b["placing"]; ?></td>
                        <td><?php echo $b["discipline"]; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-dark" href="index.php">Späť</a>
            <a class="btn btn-dark" href="placing.php?id=<?php echo $_GET["id"]; ?>">Pridať umiestnenie</a>
            <a class="btn btn-dark" href="edit.php?id=<?php echo $_GET["id"]; ?>">Upraviť</a>
        </div>
    </div>
</div>