<?php
function sendData(){
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $db = "wykres";
    $connect = @new mysqli($host, $user, $passwd, $db);
    $select = "SELECT * FROM `pomiar` ORDER BY `day`";
    $result = $connect->query($select);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
}
function setData(){
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $db = "wykres";
    $connect = @new mysqli($host, $user, $passwd, $db);
    $temperature = $_POST["t"];
    $day = $_POST["d"];
    $update = "UPDATE `pomiar` SET temperature='$temperature' WHERE day='$day'";
    $connect->query($update);
}
if(isset($_POST["f"])&&$_POST["f"]=="1"){
    sendData();
}
if (isset($_POST["f"]) && $_POST["f"] == "2") {
    setData();
}
?>