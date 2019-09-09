<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
$id = 0;
$update = false;
$name = '';
$location = '';
//conexao com a base
//verificando se o botao de nome save está sendo pressionado
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    //verificando se as variaveis estao sendo usadas


    $mysqli->query("INSERT INTO data (name,location) values('$name','$location')") or die(mysqli_error);
    $_SESSION['message'] = "Cadastrado com sucesso!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Cadastrado deletado!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];

        $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id='$id'") or die($mysqli->error());

        $_SESSION['message'] = "Registro Alterado com Sucesso";
        $_SESSION['msg_type'] = "warning";

        header('location : index.php');
    }
}
