<?php
function initConnectionSimple ()
{
    try
    {
        $dns = 'mysql:host=mysql-oyashiro.alwaysdata.net;dbname=oyashiro_inscription';
        $pdo = new PDO($dns, 'oyashiro', 'thepassword');
        $pdo->exec('SET CHARACTER SET utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch (PDOException $e)
    {
        throw $e;
    }
};
/**
 * @param $pdo
 * @param $sql
 * @return bool|Exception|PDOException
 */
function execQuery ($pdo, $sql)
{
    if (!$pdo || !$sql)
    {
        return false;
    }
    else
    {
        $stmt = $pdo->prepare($sql);
        $id = 1;
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw $e;
        }
    }
};
function getAccount ($id, $pwd) {
    try {
        $pdo  = initConnectionSimple();
        $sql  = 'SELECT IDENTIFIANT AS identifiant, EMAIL as email, PASSWORD as password
                 FROM USER0 '
            .   'WHERE IDENTIFIANT = \''.$id.'\' AND PASSWORD = \''.$pwd.'\';';
        return execQuery($pdo, $sql);
    } catch (PDOException $e) {
        throw $e;
    }
}
function getAccountById ($id) {
    try {
        $pdo  = initConnectionSimple();
        $sql  = 'SELECT IDENTIFIANT AS identifiant, EMAIL as email, PASSWORD as password
                 FROM USER0 '
            .   'WHERE IDENTIFIANT = \''.$id.'\';';
        return execQuery($pdo, $sql);
    } catch (PDOException $e) {
        throw $e;
    }
}
function getAccountByMail ($mail) {
    try {
        $pdo  = initConnectionSimple();
        $sql  = 'SELECT IDENTIFIANT AS identifiant, EMAIL as email, PASSWORD as password
                 FROM USER0 WHERE EMAIL = \'' . $mail . '\';';
        return execQuery($pdo, $sql);
    } catch (PDOException $e) {
        throw $e;
    }
}
function insertAccount ($id, $email, $pwd) {
    try {
        $pdo  = initConnectionSimple();
        $sql  = "INSERT INTO USER0 (IDENTIFIANT, EMAIL, PASSWORD)
                VALUES ('$id', '$email', '$pwd');";
        return execQuery($pdo, $sql);
    } catch (PDOException $e) {
        throw $e;
    }
}