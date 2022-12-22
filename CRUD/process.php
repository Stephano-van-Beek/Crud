<?php

session_start();

$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$klas = '';
$min_laat = '';
$reden = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $klas = $_POST['klas'];
    $min_laat = $_POST['min_laat'];
    $reden = $_POST['reden'];

    $mysqli->query("INSERT INTO data (name, klas, min_laat, reden) VALUES('$name', '$klas','$min_laat','$reden')") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

 if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
 }

 if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result->fetch_array())==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $klas = $row['klas'];
        $min_laat = $row['min_laat'];
        $reden = $row['reden'];
    }
 }
 if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $klas = $_POST['klas'];
    $min_laat = $_POST['min_laat'];
    $reden = $_POST['reden'];

    $result = $mysqli->query("UPDATE data SET name='$name', klas='$klas', min_laat='$min_laat', reden='$reden' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
 }

