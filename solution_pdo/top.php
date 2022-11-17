<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea final UT3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Agenda de contactos</h1>
    </header>
    <?php
        $host = "db";
        $user = "root";
        $password = "test";
        $db = "ut3";
        $dsn = "mysql:host=$host;dbname=$db";
        try {
            $link = new PDO($dsn, $user, $password);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            //die("Error en la conexión: " . $ex->getMessage());
            $error = "Error en la conexión: " . $ex->getMessage();
        }
    ?>