<?php
header('Content-Type: image/png');
$width = 800;
$height = 300;
if (isset($_GET["w"])) {
    $width = $_GET["w"];
}
if (isset($_GET["h"])) {
    $height = $_GET["h"];
}
$im = imagecreatetruecolor($width, $height);

// colors
$bg = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 100, 255);
$darkGray = imagecolorallocate($im, 128, 128, 128);
$lightGray = imagecolorallocate($im, 169, 169, 169);

//px values
$startW = $width * 0.085;
$startH = $height * 0.15;
$chartWidth = $width * 0.85;
$chartHeight = $height * 0.58;
$rectWidth = $chartWidth / 29;
$rectHeight = $chartHeight / 6;

//set bg
imagefilledrectangle($im, 0, 0, $width, $height, $bg);

//draw functions
function straightLines()
{
    global $startW, $startH, $chartWidth, $rectHeight, $rectWidth, $chartHeight, $black, $red, $im;
    //main lines
    imageline($im, $startW, $startH - 5, $startW, $startH + $chartHeight + 5, $black);
    imageline($im, $startW - 5, $startH + $chartHeight, $startW + $chartWidth, $startH + $chartHeight, $black);
    imageline($im, $startW + 6, $startH + $rectHeight, $startW + $chartWidth, $startH + $rectHeight, $red);
    //small lines
    //vertically
    for ($i = 0; $i < 6; $i++) {
        imageline($im, $startW - 3, $startH + ($i * $rectHeight), $startW + 3, $startH + ($i * $rectHeight), $black);
    }
    //horizontally
    for ($i = 0; $i < 29; $i++) {
        imageline($im, $startW + ($i * $rectWidth), $startH + $chartHeight - 3, $startW + ($i * $rectWidth), $startH + $chartHeight + 3, $black);
    }
}
function dottedLines()
{
    global $startW, $startH, $chartWidth, $rectHeight, $rectWidth, $chartHeight, $darkGray, $lightGray, $bg, $im;
    //vertically
    for ($i = 0; $i < 6; $i++) {
        $arr = [$darkGray, $darkGray, $darkGray, $darkGray, $bg, $bg, $bg, $bg];
        imagesetstyle($im, $arr);
        imageline($im, $startW + 3, $startH + ($i * $rectHeight), $startW + $chartWidth, $startH + ($i * $rectHeight), IMG_COLOR_STYLED);
    }
    //horizontally
    for ($i = 0; $i < 29; $i++) {
        $arr = [];
        if ($i == 6 || $i == 16 || $i == 26) {
            $arr = [$lightGray, $lightGray, $lightGray, $lightGray,$lightGray, $bg, $bg, $bg,$bg, $bg];
        } else {
            $arr = [$darkGray, $darkGray, $darkGray, $darkGray, $darkGray, $bg, $bg, $bg, $bg, $bg];
        }
        imagesetstyle($im, $arr);
        imageline($im, $startW + ($i * $rectWidth), $startH - 5, $startW + ($i * $rectWidth), $startH + $chartHeight, IMG_COLOR_STYLED);
    }
}
function numbers()
{
    global $startW, $startH, $chartWidth, $rectHeight, $rectWidth, $chartHeight, $black, $red, $im;
    //1 to 28
    for ($i = 1; $i < 29; $i++) {
        if ($i >= 1 && $i < 10)
            imagestring($im, 3, $startW + ($i * $rectWidth) - 3, $startH + $chartHeight + 4, $i, $black);
        else if ($i >= 10)
            imagestring($im, 3, $startW + ($i * $rectWidth) - 5, $startH + $chartHeight + 4, $i, $black);
    }
    //37.2 to 36.2
    imagestring($im, 3, $startW - 20, $startH - 10, '.2', $black);
    imagestring($im, 3, $startW - 34, $startH - 10 + $rectHeight, '37.0', $black);
    imagestring($im, 3, $startW - 20, $startH - 10 + (2  * $rectHeight), '.8', $black);
    imagestring($im, 3, $startW - 20, $startH - 10 + (3  * $rectHeight), '.6', $black);
    imagestring($im, 3, $startW - 20, $startH - 10 + (4  * $rectHeight), '.4', $black);
    imagestring($im, 3, $startW - 34, $startH - 10 + (5  * $rectHeight), '36.2', $black);
}
function text()
{
    global $height, $width, $black, $im;
    $textHeightVertically = $height / 2 + 25;
    $textWidthHorizontally = $width / 2 - 35;
    $textHeightHorizontally = $height * 0.8  + 15;
    imagestringup($im, 4, 0, $textHeightVertically, 'temperatura', $black);
    imagestring($im, 4, $textWidthHorizontally, $textHeightHorizontally, mb_convert_encoding('dzień miesiąca', 'ISO-8859-2', 'UTF-8'), $black);
}
function drawChart()
{
    global $startW, $startH, $rectHeight, $rectWidth, $chartHeight, $blue, $red, $darkGray, $im;
    $host = "localhost";
    $user = "root";
    $passwd = "";
    $db = "wykres";
    $connect = @new mysqli($host, $user, $passwd, $db);
    $select = "SELECT * FROM `pomiar` ORDER BY `day`";
    $result = $connect->query($select);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    for ($i=0;$i<count($data);$i++) {
        if ($data[$i]["temperature"] == 0) {
            $day = $data[$i]["day"];
            $temperature = $data[$i]["temperature"];
            $diff = 37.2 - $temperature;
            $pointH = $startH + $chartHeight;
            $pointW = $startW + ($day * $rectWidth);
            imagefilledarc($im, $pointW, $pointH, 8, 8, 0, 360, $red, IMG_ARC_PIE);
        } else if ($data[$i]["temperature"] == 1) {
            $day = $data[$i]["day"];
            $temperature = $data[$i]["temperature"];
            $diff = 37.2 - $temperature;
            $pointH = $startH + $chartHeight;
            $pointW = $startW + ($day * $rectWidth);
            imagefilledarc($im, $pointW, $pointH, 8, 8, 0, 360, $darkGray, IMG_ARC_PIE);
        } else {
            $day = $data[$i]["day"];
            $temperature = $data[$i]["temperature"];
            $diff = 37.2 - $temperature;
            $pointH = $startH + ($diff / 0.2) * $rectHeight;
            $pointW = $startW + ($day*$rectWidth);
            imagefilledarc($im, $pointW, $pointH, 8, 8, 0, 360, $blue, IMG_ARC_PIE);
            if(isset($data[$i+1])&&$data[$i + 1]["temperature"]!=0&& $data[$i + 1]["temperature"] != 1){
                $diff = 37.2 - $data[$i + 1]["temperature"];
                $pointHNext = $startH + ($diff / 0.2) * $rectHeight;
                $pointWNext = $startW + ($data[$i + 1]["day"] * $rectWidth);
                imageline($im,$pointW,$pointH,$pointWNext,$pointHNext,$blue);
            }
        }
    }
}

//create
text();
dottedLines();
straightLines();
numbers();
drawChart();
ImagePNG($im);
imagedestroy($im);