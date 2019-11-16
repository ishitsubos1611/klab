<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>登録確認</title>
    <!--  <link rel="stylesheet" href="../css/2-3-A.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!--<script type="text/javascript" src="jquery-3.4.1.js"></script>
    <script type="text/javascript" src="bootstrap.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></\
script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"\
 crossorigin="anonymous"></script>  -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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

<?php
//    ini_set('display_errors',1);//画面にエラーを表示
//    error_reporting(E_ALL);//全ての種類のエラーを表示
//    session_start(); 
//    if(isset($_POST['datapost'])){
//     $_SESSION['name'] = $_POST['name']; 
//    }
?>

<p>
 <form name="myform3" method='post' onsubmit="return checkText3()">

<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $gid = $_POST['gid'];
 $year = $_POST['year'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$long = $_POST['lng'];
$period = $_POST['time'];
$fee = $_POST['fee'];
$maxsub = $_POST['maxsubject'];
//$language = $_POST['language'];
$language = implode("、", $_POST['language']);
$thisdate = $_POST['thisdate'];
$thismonth = $_POST['thismonth'];
$thisyear = $_POST['thisyear'];
$comment = $_POST['comment'];

$payment_date = '8';

 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = lat' .' type=hidden value="' . $lat . '">';
 echo '<input name = long' .' type=hidden value="' . $long . '">';
 echo '<input name = language' .' type=hidden value="' . $language. '">';
 echo '<input name = fee' .' type=hidden value="' . $fee. '">';
 echo '<input name = maxsub' .' type=hidden value="' . $maxsub. '">';
 echo '<input name = period' .' type=hidden value="' . $period. '">';
 echo '<input name = comment' .' type=hidden value ="' . $comment. '">';  
 echo '<input name = payment_day' .' type=hidden value="' . $payment_date. '"><br>';


 if(empty($location)){
  $location = "スポットが選択されていません";
  $final_step = "トップに戻る";
  $stepNum = 0;
 }else{
  $final_step = "登録";
  $stepNum = 1;
 }

// データベース接続
//$host = 'localhost';
$host = '127.0.0.1';
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

//データ取得
$sql = "SELECT * FROM G_Schedule WHERE GID = ?  AND location = ? ";
//$dblocation = "'". $location . "'";
//$dblocation = '京都鉄道博物館';
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid,$location));


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

  if(($location == $row['location']) && (empty($row['date']))){

   $location = "既に" . $location . "は登録されています";
   $final_step = "削除";
   $stepNum = 2;
  
   $scheduleGID = $row['scheduleGID'];  
   echo '<input name = scheduleGID' .' type=hidden value="' . $scheduleGID. '">'; 
  }
} 


?>

<script>

 function checkText3() {

    var dbVal = <?php echo $stepNum ?>; 

    if(dbVal == 2){
      document.myform3.action = "db_delete.php";
    } else if (dbVal == 1) { 
      document.myform3.action = "insert_place.php";
    } else if( dbVal == 0) { 
      document.myform3.action = "./guide_top.html";
  }
}

</script>
<div class="main">
  <nav class="navbar navbar-dark bg-dark fixed-top">			
	<a class="navbar-brand" href="#">シェアリングツアーガイド</a>				
	<!--レスポンシブの際のハンバーガーメニューのボタン-->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>		
	<!--ナビバー内のメニュー-->
	<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
	    <!--<li class="nav-item active">
	      <a class="nav-link" href="#"><span class="sr-only">(カレント)</span></a>
	    </li>-->
<!--	    <li class="nav-item">
	      <a class="nav-link" href="guide/guide_login.php">ガイドログイン</a>
	    </li>  -->
	    <li class="nav-item active">
	      <a class="nav-link disabled" href="guide/select_area_regist.php">ガイド登録</a>
	    </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area.php">ガイド日程登録</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="guide/select_area4booking.php">ガイド予約確認</a>
            </li>
<!--	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="#">ユーザログイン</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="user/user_select_area.php">ユーザ希望登録</a>
            </li>
	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="realtime/realtime_place_registration.php">今すぐ登録</a>
            </li>   -->
	  </ul>
	</div>
      </nav>

  
  <div class="container-fluid">
    <div class="text-center">
      <br><br>
      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
	  <!--<div class="bg-danger text-white h2">-->
            <!--<p class="text-info bg-danger h2">確認</p><br>-->
	    <!--</div>-->
	  <a href="#" class="btn btn-danger disabled btn-lg btn-block">確認</a>
	</div>
      </div>
      <p></p>
      <div class="confirmation-wrapper">
        <p class = "text-danger h3" id = "location-output"><?php echo $location; ?></p>
 <!--       <p class="time-zone check-list">
         <?php echo $check_month; ?>：
         8:00-18:00
	 -->
        <br>
        <p class = "text-danger h3">コメント：<?php echo $comment; ?></p>
        <br>
        <p class="text-danger h3">ガイド時間：<?php echo $period; ?>分</p>
	<br>
        <p class="text-danger h3">Language : <?php echo implode("、", $_POST['language']);?>　</p>
	<br>
        <!--<p class="charge red check-list h3">Charge ¥<?php echo $fee; ?> (1~<?php echo $maxsub?>名)</p>-->
	<p class="text-danger h3">Charge ¥<?php echo $fee; ?> (1~<?php echo $maxsub?>名)</p>
      </div>
   <!--   <div class="btn-wrapper">
         <a href="../top.html" class = "resistration" onclick="dbinsert();" ><?php echo $final_step; ?></a>
      </div>
<p>
         <INPUT class="resistration" type="submit" name = "datapost" value='<?php echo $final_step; ?>'>
	 -->
   <br>
   <div class="row">
     <div class="col-sm-2"></div>
     <div class="col-sm-8">
       <INPUT class="btn btn-outline-info btn-lg btn-block" type="submit" value='<?php echo $final_step; ?>'>
     </div>
   </div>
 </form>
    <br>
      <div class="btn-wrapper">
       <form>
	 <p><!--         <INPUT class="resistration" type="button" onClick='history.back();' value="戻る"> -->
	   <div class="row">
	     <div class="col-sm-2"></div>
             <div class="col-sm-8">
	       <a href="select_area_regist.php" class="h5" >戻る</a>
	     </div>
	   </div>
      </div>

       </form>
      </div>
  </div>
</div>
</div>
</div>
  </body>
</html>

