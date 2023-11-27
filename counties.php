<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <a href="./index.php"><i class="fa fa-home"></i></a>
    <h1>Megyék</h1>
<table>
    <thead>
        <th>#id</th><th>Megnevezés</th><th>Művelet&nbsp;
            <button><a href="./county.php"><i class="fa fa-plus"></i></a>
            </button></th>
    </thead>
<tbody>

    <form method="post" action="counties.php">
        <input type="text" name="needle" value="">
        <button type="submit" name="btn-search" method="post">Keres</button>
    </form>

    <?php
        require_once('ItemRepository.php');
        $ItemRepository = new ItemRepository();

        if (isset($_POST['btn-save'])) {
            $countyName = $_POST['county_name'];
            $countyId = $_POST['county_id'];

            $ItemRepository->updateCounty($countyId, $countyName);
        }

        if (isset($_POST['btn-save-new'])) {
            $countyName = $_POST['county_name'];

            $ItemRepository->saveCounty($countyName);
        }

        if (isset($_POST['btn-search'])) {
            $needle = $_POST['needle'];

            $counties = $ItemRepository->searchCounty($needle);
        }

        if (isset($_POST['btn-del'])) {
            $id = $_POST['id'];

            $ItemRepository->deleteCounty($id);
        }

        
    if (!isset($counties)) {
        $counties = $ItemRepository ->getAllCounties();
    }

        foreach($counties as $county){
            echo ''
            .'<tr>'
                .'<td>'.$county['id'].'</td>'
                .'<td>'.$county['name'].'</td>'
                .'<td>'.'<div style="display: flex">'
                    .'<form method="post" action="county.php">
                        <button type="submit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <input type="hidden" name="id" value="' .$county['id'].'">
                        </form
                        '
                    .'</div></td>'

            .'</tr>';
        }   
?>
        
    
</tbody>
</table>
</body>
</html>