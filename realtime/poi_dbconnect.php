<?php
//$id = $_POST['id'];
//$area = json_decode($_POST['area']);
$area = $_POST['area'];
$nowLat = $_POST['nowLat'];
$nowLng = $_POST['nowLng'];
//$area = 'kyoto';
$category = $_POST['category'];
//$category = 'all';

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

if($category == 'all'){

// データ取得sql
//$sql = "SELECT * FROM POI WHERE area = ? ";
//$stmt = ($dbh->prepare($sql));
//$stmt->execute(array($area));
$sql = "SELECT *, (6371 * acos(cos(radians($nowLat)) * cos(radians(lat)) * cos(radians(POI.long) - radians($nowLng)) + sin(radians($nowLat)) * sin(radians(lat)))) as distance FROM POI ORDER BY distance limit 20";
$stmt = ($dbh->prepare($sql));
$stmt->execute();

}else{

// データ取得sql
$sql = "SELECT * FROM POI WHERE area = ? AND category = ? limit 20";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($area, $category));

}

// データ取得
//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
$distanceList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

//	$distanceList[$row['id']] = (6371 * acos(cos(radians($nowLat)) * cos(radians($row['lat'])) * cos(radians($row['long']) - radians($nowLng)) + sin(radians($nowLat)) * sin(radians($row['lat']))));
//	foreach(){
//	}
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

