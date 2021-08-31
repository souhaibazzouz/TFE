<?php
session_start();
include 'db_conn.php';
include 'database.php';

if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['latCoor'])
    && isset($_POST['lngCoor']) && isset($_POST['tot_slot'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $latCoor = $_POST['latCoor'];
    $lngCoor = $_POST['lngCoor'];
    $tot_slot = $_POST['tot_slot'];

    $conn = OpenCon();

    try{
        $sql= "INSERT INTO `parking` (`idParking`, `name`, `adress`, `latCoor`, `lngCoor`, `tot_slot`,
                       `empty_slot`, `date`) VALUES (NULL, '$name', '$address', '$latCoor', '$lngCoor',
                                                     '$tot_slot', NULL, current_timestamp());";
        $alpha = $conn->exec($sql);

        if ($alpha){
            $insert_parking_statut = "INSERT INTO `statutp_parking` (`dateChangement`, `idParking`, `idStatutP`) VALUES (current_timestamp(), LAST_INSERT_ID(),'3');";
            $conn->exec($insert_parking_statut);
            header("Location: add_park.php?success=Vous avez ajouté un parking");

        }else{
            header("Location: add_park.php?error=Une erreur inconnue est survenue lors de l'ajout du statut du parking");
        }
    }catch(PDOException $e) {
        header("Location: add_park.php?error=Une erreur inconnue est survenue lors de l'ajout du parking");
    }

}

