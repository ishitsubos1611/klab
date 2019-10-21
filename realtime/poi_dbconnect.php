<?php
//$id = $_POST['id'];
//$area = json_decode($_POST['area']);
$area = $_POST['area'];
$category = $_POST['category'];
//$area = 'kyoto';
//$style = $_POST['style'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$lat = 35.069162899999995;
$long = 135.7556467;
//console.log('area');
//console.log($area);
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
//if($category == 'all'){
// データ取得
//$sql = "SELECT * FROM POI WHERE area = ? limit 20";
$sql = "SELECT * ,(3959 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians( long ) - radians(?) ) + sin(radians(?)) * sin(radians(lat)) ) ) as distance FROM POI HAVING  distance < 2.0"; 
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($lat,$long,$lat));
//}
echo $sql;
//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'id' =>$row['id'],
  'area' =>$row['area'],
  'name' =>$row['location'],
  'JPname'=>$row['JPname'],
  'lat'=>$row['lat'],
  'lng'=>$row['long'],
  'url' =>$row['URL']
 );
}
//jsonとして出力
console.log($memberList);
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);