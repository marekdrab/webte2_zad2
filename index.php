<?php
require_once "classes/helper/Database.php";


try {
    $db = new Database();

    $resultTop10 = $db->getQuery("select os.id as id , os.name as name, os.surname as surname, COUNT(um.person_id) counter
                                                    from osoby as os
                                                    left join umiestnenia as um on os.id = um.person_id
                                                    left join oh on oh.id = um.oh_id
                                                    where um.placing = 1
                                                    GROUP BY os.id,os.name, os.surname 
                                                    ORDER BY counter  DESC limit 0,10");
    $result = $db->getQuery("select os.id as id, os.name as name,
                                                os.surname as surname,
                                                oh.year as year, 
                                                concat(oh.country, ', ', oh.city) as place,
                                                oh.type as type,
                                                um.discipline as discipline
                                                from osoby as os
                                                left join umiestnenia as um on os.id = um.person_id
                                                left join oh on oh.id = um.oh_id
                                                WHERE um.placing = 1");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<?php include_once "header.php"; ?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Zadanie 2</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="myTable">
                    <thead>
                    <tr>
                        <th>Meno</th>
                        <th>Rok</th>
                        <th>Miesto</th>
                        <th>Typ</th>
                        <th>Disciplína</th>
                        <th></th>
                    </tr>
                    </thead>
                    <?php foreach ($result as $row => $a) { ?>
                        <tr>
                            <td><?php echo '<a href="detail.php?id=' . $a["id"] . '">' . $a["name"] . ' ' . $a["surname"] . '</a>' ?></td>
                            <td><?php echo $a["year"] ?></td>
                            <td><?php echo $a["place"] ?></td>
                            <td><?php echo $a["type"] ?></td>
                            <td><?php echo $a["discipline"] ?></td>
                            <td><a href="edit.php?id=<?php echo $a["id"]; ?>" class="btn btn-dark">Upraviť</a>
                                <a href="delete.php?id=<?php echo $a["id"]; ?>" class="btn btn-dark">Vymazať</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table id="top10">
                        <thead>
                        <tr>
                            <th>Meno</th>
                            <th>Pocet</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($resultTop10 as $row => $b) { ?>
                            <tr>
                                <td><?php echo '<a href="detail.php?id=' . $b["id"] . '">' . $b["name"] . ' ' . $b["surname"] . '</a>' ?></td>
                                <td><?php echo $b["counter"] ?></td>
                                <td><a href="edit.php?id=<?php echo $b["id"]; ?>" class="btn btn-dark">Upraviť</a>
                                    <a href="delete.php?id=<?php echo $b["id"]; ?>" class="btn btn-dark">Vymazať</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 left-allign">
                <a href="new.php" class="btn btn-dark"> Pridať športovca </a>
            </div>
        </div>
    </div>
</body>
</html>