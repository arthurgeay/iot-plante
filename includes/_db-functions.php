<?php


function dbConnect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=iot-plante;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    return $db;
}


function emailExist($email) {
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE email_user = :email_user');
    $req->bindValue(':email_user', $email);
    $req->execute();

    return $req->fetch(PDO::FETCH_ASSOC);
}

function addUser($email, $password) {
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO user(email_user, password_user) VALUES(:email, :password)');
    $req->bindValue(':email', $email);
    $req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

    $req->execute();
}

function getDataFlower() {
    $db = dbConnect();
    $req = $db->query('SELECT * FROM measures AS m INNER JOIN flower AS f ON f.id_flower = m.flower_id ORDER BY m.date_measures DESC ');

    return $req->fetch(PDO::FETCH_ASSOC);
}


