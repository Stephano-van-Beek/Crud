<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once 'process.php';?>

    <?php
    if (isset($_SESSION['message'])):?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset ($_SESSION['message']);
    ?>   
    </div>
    <?php endif ?>
    <div class="container">
    <?php
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    //pre_r($result);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Klas</th>
                    <th>Minuten te laat</th>
                    <th>Reden</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['klas']?></td>
            <td><?php echo $row['min_laat']?></td>
            <td><?php echo $row['reden']?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>"
                class="btn btn-info">Edit</a>
                <a href="index.php?delete=<?php echo $row['id']; ?>"
                class="btn btn-danger">Delete</a>
            </td>
        </tr> 
        <?php } ?>
        </table>
    </div>
    <?php
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }
    ?>
    </div>
    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
        <label><strong>Name</strong></label>
        <input type="text" name="name" class="form-control" valeu="<?php echo $name; ?>" placeholder=Enter your name">
        </div>
        <div class="form-group">
        <label><strong>Klas</strong></label>
        <input type="text" name="klas" valeu="<?php echo $klas; ?>" class="form-control" placeholder=Enter your klas">
        </div>
        <div class="form-group">
        <div class="form-group">
        <label><strong>Minuten te laat</strong></label>
        <input type="text" name="min_laat" valeu="<?php echo $min_laat; ?>" class="form-control" placeholder=Enter your min_laat">
        </div>
        <div class="form-group">
        <div class="form-group">
        <label><strong>Reden</strong></label>
        <input type="text" name="reden" valeu="<?php echo $reden; ?>" class="form-control" placeholder=Enter your reden>
        </div>
        <div class="form-group">
        <?php
        if ($update == true):
        ?>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
        </div>
    </form>
    </div>
    </div>
</body>
</html>








