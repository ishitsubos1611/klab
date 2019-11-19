<?php
//$area = $_POST['area'];
//$style = $_POST['style'];
$location = $_POST['location']; //ユーザーが希望するガイド場所
$stime = $_POST['stime']; //ユーザーが希望するガイドのスタート時間
//$period = $_POST['period'];

//$location = '二条城';
//$stime = '10:00'; //ユーザーが希望するガイドのスタート時間
//$period = 30;

// データベース接続

$host = 'localhost';
$dbname = 'tour_db';
$dbuser = 'yamamoto';
$dbpass = 'rikuya0217';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 var_dump($e->getMessage());
 echo '接続失敗';
 exit;
}
// データ取得 (ガイド希望時間(stime)がstart_time~end_timeである場合とlocationが一致するデータのみ取得)
$sql = "SELECT * FROM G_Schedule WHERE date is NULL AND location=?";
//$sql = "SELECT * FROM G_Schedule WHERE (? between start_time and end_time) AND location=?";
$stmt = ($dbh->prepare($sql));
//$stmt->bindParam(':stime', $stime, PDO::PARAM_STR);
//$stmt->bindParam(':location', $location, PDO::PARAM_STR);
$stmt->execute(array($location));
//$stmt->execute(array($stime,$location));

//あらかじめ配列を生成しておき、while文で回します。
$list = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $list[]=array(
  //'scheduleGID' =>$row['scheduleGID'],
  'GID' =>$row['GID'],
  'year' =>$row['year'],
  'date'=>$row['date'],
  'start_time' =>$row['start_time'],
  'end_time' =>$row['end_time'],
  'language' =>$row['Language'],
  'charge' =>$row['charge'],
  'location' =>$row['location'],
  'lat' =>$row['lat'],
  'long' =>$row['long'],
  'max_num_participant' =>$row['max_num_participant'],
  //'charge' =>$row['charge'],
  'period' =>$row['period'],
  'comment' =>$row['comment']
 );
}

//jsonとして出力
//console.log($memberList);
header('Content-type: application/json');
echo json_encode($list,JSON_UNESCAPED_UNICODE);