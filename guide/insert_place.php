<!DOCTYPE html>
<html lang="ja">
<head>    

<meta charset="utf-8">
  <META http-equiv="Refresh" content="1;URL=select_area_regist.php"> 
    <title>ガイドスポット登録中</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>

history.pushState(null, null, null);
$(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
  }
});

</script>

</head>

<body>
<P>スポット登録完了</P>

</body>
</html>

<?php 

$GID = $_POST['gid'];
$language = $_POST['language'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$max_num_participant = $_POST['maxsub'];
$charge = $_POST['fee'];
$payment_date = $_POST['payment_date'];
$period = $_POST['period'];
$num_month = $_POST['num_month'];
$comment = $_POST['comment'];  

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

// INSERT place

     $sql = "INSERT INTO G_Schedule (GID, Language, location, lat, `long`, max_num_participant, charge, payment_date, period, comment) VALUES (:GID, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period, :comment)";

//     $sql = "INSERT INTO G_Schedule (GID, year, date, start_time, end_time, Language, location, lat, `long`, max_num_participant, charge, payment_date, period) VALUES (:GID, :year, :date, :start_time, :end_time, :language, :location, :lat, :long, :max_num_participant, :charge, :payment_date, :period)";

    $stmt = $dbh->prepare($sql);
    //print_r($dbh->errorInfo());

     $stmt->bindParam(':GID', $GID, PDO::PARAM_INT);
     $stmt->bindParam(':language', $language, PDO::PARAM_STR);
     $stmt->bindParam(':location', $location, PDO::PARAM_STR);
     $stmt->bindParam(':lat', $lat, PDO::PARAM_INT);
     $stmt->bindParam(':long', $long, PDO::PARAM_INT);
     $stmt->bindParam(':max_num_participant', $max_num_participant, PDO::PARAM_INT);
     $stmt->bindParam(':charge', $charge, PDO::PARAM_INT);
     $stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
     $stmt->bindParam(':period', $period, PDO::PARAM_INT);
     $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
     //$stmt->bindParam(':maxsub', $maxsub, PDO::PARAM_INT);

     $stmt->execute();



?>
