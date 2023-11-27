<?php 
if (isset($_POST['id'])){
    require_once 'ItemRepository.php';
    $countyId = $_POST['id'];

    $itemRepository = new ItemRepository();
    $county = $itemRepository->getCountyById($countyId);

echo'
    <form method="post" action="counties.php">
    <input type="text" name="county_name" value="'.$county['name'].'">
    <input type="hidden" name="county_id" value="'.$county['id'].'">
    <button type="submit" name="btn-save" method="post">Ment</button>
    <button type="submit" name="btn-cancel" method="post">Mégse</button>
    </form>';
}
else {
    echo '
    <form method="post" action ="counties.php">
        <input type="text" name="county_name" value="">
        <button type ="submit" name="btn-save-new" method="post">Ment</button>
        <button type"submit" name="btn-cancel" method="post">Mégse</button>
    </form>';
}

?>