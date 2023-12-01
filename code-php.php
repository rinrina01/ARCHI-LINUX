<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function connectToDbAndGetPdo(): PDO {
    $dbname = 'MEMORY';
    $host = 'localhost';

    $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8";
    $user = 'root';
    $pass = 'root';
    
    $driver_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $driver_options);
        return $pdo;
    } catch (PDOException $e) {
        echo 'La connexion à la base de données a échoué.';
    }
}?>

<!DOCTYPE html>
<html>

<body>
    <p> <?php
        $pdo = connectToDbAndGetPdo();
        $pdoStatement = $pdo->prepare("SELECT * FROM Users");
        $pdoStatement->execute();
        $infosLogin = $pdoStatement->fetch();
        echo "<h3> $infosLogin->username, $infosLogin->email </h3>";?>
    <p>
</body>
</html>
