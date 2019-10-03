<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="utf-8">
    <META http-equiv="Refresh" content="1;URL=../top.html"> 
    <title>更新・追加確認</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>

<body>
<P>登録完了</P>

</body>
</html>

<?php

echo $scheduleGID = $_POST['scheduleGID'];
$GID = $_POST['gid'];
$date = $_POST['date'];
$year = $_POST['thisyear'];
$month = $_POST['month'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$language = $_POST['language'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$max_num_participant = $_POST['maxsub'];
$charge = $_POST['fee'];
$payment_date = $_POST['payment_date'];
$period = $_POST['period'];
$thisdate = $_POST['thisdate'];
$num_month = $_POST['num_month'];
list($thismonth, $thisday)= explode("-", $thisdate);

//  $last_day = date("t", mktime(0, 0, 0, $month, $year));
$host = 'localhost';
$dbname = 'tour_db';
$dbuser = 'yamamoto';
$dbpass = 'rikuya0217';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, [PDO::ATTR_EMULATE_PREPARES => false]);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 echo '接続失敗';
 exit;
}

//if($date=="all"){
//if(!empty($thisdate)){
// UPDATE
     $sql = "UPDATE G_Schedule set start_time = :start_time, end_time = :end_time, Language = :language, max_num_participant = :max_num_participant, charge = :charge, period = :period WHERE scheduleGID = :scheduleGID";
//    $sql = "UPDATE G_Schedule set start_time = :start_time WHERE scheduleGID = :scheduleGID";

    $stmt = $dbh->prepare($sql);
//    print_r($dbh->errorInfo());

    $stmt -> bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $stmt -> bindValue(':end_time', $end_time, PDO::PARAM_STR);
    $stmt -> bindValue(':language', $language, PDO::PARAM_STR);
    $stmt -> bindValue(':max_num_participant', $max_num_participant, PDO::PARAM_STR);
    $stmt -> bindValue(':charge', $charge, PDO::PARAM_STR);
    $stmt -> bindValue(':period', $period, PDO::PARAM_STR);
    $stmt -> bindValue(':scheduleGID', $scheduleGID, PDO::PARAM_INT);
//     $params = array(':start_time' => $start_time, ':end_time' => $end_time, ':language' => $language, ':max_num_participant' => $max_num_participant, ':charge' =>  $charge, ':period' => $period, ':schduleGID' => $scheduleGID);
//     $params = array(':start_time' => $start_time, ':schduleGID' => $scheduleGID);

     //$stmt->execute($params);
     $stmt->execute();

?>
