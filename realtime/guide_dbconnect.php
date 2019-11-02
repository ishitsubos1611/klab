<?php
//$id = $_POST['id'];
//$area = json_decode($_POST['area']);
$gid = $_POST['gid'];
//$area = 'kyoto';
//$category = $_POST['category'];
//$category = 'all';


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

// データ取得sql
//$sql = "SELECT * FROM G_Schedule WHERE GID = ? ";
//$sql = "SELECT * FROM G_Schedule WHERE date = ? ";
$sql = "SELECT * FROM G_Schedule";
$stmt = ($dbh->prepare($sql));
//$stmt->execute(array($nowdate));
$stmt->execute();

// データ取得
//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'GID' =>$row['GID'],
  'area' =>$row['area'],
  'year' =>$row['year'],
  'date' =>$row['date'], //
  'location' =>$row['location'],
  'lat'=>$row['lat'],
  'lng'=>$row['long']
 );
}


//jsonとして出力
console.log($memberList);
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);

