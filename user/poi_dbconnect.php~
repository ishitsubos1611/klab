<?php
//$id = $_POST['id'];
//$area = json_decode($_POST['area']);
$area = $_POST['area'];
//$area = 'kyoto';
$category = $_POST['category'];
//$category = 'all';

console.log('area');
console.log($area);
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
$sql = "SELECT * FROM POI WHERE area = ? ";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($area));


}else{

// データ取得sql
$sql = "SELECT * FROM POI WHERE area = ? AND category = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($area, $category));

}

// データ取得
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

