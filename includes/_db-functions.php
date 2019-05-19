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

function flowerExist($info) {
    $db = dbConnect();

    if(is_int($info)) {
        $req = $db->prepare('SELECT * FROM flower WHERE id_flower = :id');
        $req->bindValue('id', $info);
    } else {
        $req = $db->prepare('SELECT * FROM flower WHERE name_flower = :name');
        $req->bindValue('name', $info);
    }

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

function deleteMeasures() {
    $db = dbConnect();
    $req = $db->exec('DELETE FROM measures');

    return $req;
}

function getFlowers() {
    $db = dbConnect();
    $req = $db->query('SELECT id_flower, name_flower FROM flower');

    $data = [];

    while($result = $req->fetch(PDO::FETCH_ASSOC))
    {
        $data[] = $result;
    }

    return $data;
}

function addFlower($name, $humidity, $temperature, $brightness, $dateStart, $dateEnd, $category, $description, $picture) {
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO flower(name_flower, category_flower, description_flower, picture_flower, humidity_flower, temperature_flower, brightness_flower, date_start_flower, date_end_flower) VALUES(:name, :category, :description, :picture, :humidity, :temperature, :brightness, :date_start, :date_end)');
    $req->bindValue(':name', htmlentities($name));
    $req->bindValue(':category', htmlentities($category));
    $req->bindValue(':description', htmlentities($description));
    $req->bindValue(':picture', htmlentities($picture));
    $req->bindValue(':humidity', htmlentities($humidity));
    $req->bindValue(':temperature', htmlentities($temperature));
    $req->bindValue(':brightness', htmlentities($brightness));
    $req->bindValue(':date_start', htmlentities($dateStart));
    $req->bindValue(':date_end', htmlentities($dateEnd));

    $req->execute();
}


