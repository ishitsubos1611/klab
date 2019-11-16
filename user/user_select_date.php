<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>変更・追加・削除希望の日選択</title>

  
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/calender.css">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $gid = $_POST['gid'];
 $uid = $_POST['uid'];
 $location = $_POST['location'];
 $period = $_POST['time'];
 $participants = $_POST['maxsubject']; 
?>

</head>
<body margin:auto; text-align:center;>

  <div class="main">
    <nav class="navbar navbar-dark bg-dark fixed-top">			
      <a class="navbar-brand" href="../top.html">シェアリングツアーガイド</a>				
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
      </button>		
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
	    <!--<li class="nav-item active">
	      <a class="nav-link" href="#"><span class="sr-only">(カレント)</span></a>
	    </li>-->
	    <!--<li class="nav-item">
	      <a class="nav-link" href="#">ガイドログイン</a>
	    </li>
	    <li class="nav-item active">
	      <a class="nav-link" href="#">ガイド登録</a>
	    </li>
	    <li class="nav-item">
              <a class="nav-link" href="select_area.php">ガイド日程登録</a>
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="select_area4booking.php">ガイド予約確認</a>
            </li>
	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="#">ユーザログイン</a>
            </li>  -->
	    <li class="nav-item">
              <a class="nav-link" href="../user/user_select_area.php">ユーザ希望登録</a>
            </li>
	    <!--<div class="dropdown-divider"></div>-->
	    <li class="nav-item">
              <a class="nav-link" href="../realtime/realtime_place_registration.php">今すぐ登録</a>
            </li>
	  </ul>
	</div>
      </nav>

    <div class="container-fluid">
      <div class="text-center">
	<br><br><br>
        <!--<div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">  -->
	    <!--<div class="startup">-->
	    <a href="#"  class = "btn btn-danger disabled btn-xl btn-block">
              <?php if(isset($_GET["uid"])) echo $gid = $_GET['uid'];else echo $uid = $_POST['uid']; ?>さんのガイド希望日を選択中
	    </a>
      <!--</div>-->
       <!--   </div>
	</div>   -->
	
	<div class="message">
        カレンダーの日を
        クリックして下さい。
	</div>
	<p class="h4">※<span class="text-success">緑</span>は既に登録されている日です</p>
<!-- 
 <br> ※赤はガイド予定（予約）が入っている日です
--> 
      </div>
    </div>
  </div>
  
   <form name="myform3" method='post' onsubmit="return checkText3()">

<?php 
 $period = $_POST['time'];
 $participants = $_POST['maxsubject'];
 $language = implode("、",$_POST['language']);
  
 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = period' .' type=hidden value="' . $period . '">';
 echo '<input name = participants' .' type=hidden value="' . $participants . '">';
 echo '<input name = language' .' type=hidden value="' . $language . '">';
 echo '<input name = uid' .' type=hidden value="' . $uid . '">'; 

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
$sql = "SELECT * FROM U_Schedule WHERE UID = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($uid));

$guideData[] = array();
$start_time = 0;
$end_time = 0;


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
list($row_month, $row_day)=explode("-", $row['date']);
        $userData[]=array(
        'ScheduleUID'=>$row['scheduleUID'],
    'UID'=>$row['UID'],
    'GID'=>$row['GID'],
    'scheduleGID'=>$row['scheduleGID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    //'month'=>$row_month,
    //'day'=>$row_day,
    'start_time'=>$row['start_time'],
    'end_time'=>$row['end_time'],
    //'language'=>implode("、", $row['Language']),
    'language'=>$row['language'],
    'location'=>$row['location'],
    'period'=>$row['period'],
    'lat'=>$row['lat'],
    'long'=>$row['long'],
    'charge'=>$row['charge'],
    'payment_date'=>$row['payment_date'],
    'max_num_participant'=>$row['max_num_participant']
        );
  //$start_time = $row['start_time'];
  //$end_time = $row['end_time'];
  
} 

//jsonとして出力
 //console.log($guideData);
 //header('Content-type: application/json');
 //echo json_encode($guideData,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
 //echo json_encode($guideData,JSON_UNESCAPED_UNICODE);
 //$json_guideData =  json_encode($guideData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
 $json_userData =  json_encode($userData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
//print_r($json_guideData);
?>

<?php
//ISHITUBO

  function weekdayColor_get($i) {
    if ($i == 0) return '#FF00FF'; else return '#77EEFF';
  }
  function color_get($j, $d, $day, $thismonth, $thisyear, $m, $y, $arr) {
//    $date = $y.$m.$d;
    $date = $m."月".$d."日";
    //console.log($date);
    foreach ($arr as &$value) {
        //if ($value["date"] == $date || $value["date"] == "all") {
        if ($value["date"] == $date && $value["year"] == $y) {
          return '#99FF66';
        }
    }
    if ($j == 0) {
      return '#C0C0C0';
    }
    //else {
 //  foreach ($arr as &$value) {
 //    //if ($value["date"] == $date || $value["date"] == "all") {
 //    if ($value["date"] == $date && $value["year"] == $y) {
 //      return '#99FF66';
 //    }
 //  }
    //}
    return '#ffffff';
  }
//  $file = "calender.json";
//  $json = file_get_contents($file);
//  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $json = mb_convert_encoding($userData, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = array();
//  $arr = json_decode($json,true);
  $arr = $userData;
//print_r($arr);

  $m = $_GET['m'];
  if ($m) {
    $year = date('Y', strtotime($m . '01'));
    $month = date('n', strtotime($m . '01'));
  } else {
    $year = date('Y');
    $month = date('n');
  }
  $day = date('j');
  $thismonth = date('n');
  $thisyear = date('Y');
  $weekday = array('日', '月', '火', '水', '木', '金', '土');

  echo '<p><table id="calender">';
  echo '<caption>';
  echo '<a href="?m=' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . '&id=' .$uid. '" class="year"> &lt; </a>' . $year . '年' . $month . '月';
  echo '<a href="?m=' . date('Ym', mktime(0, 0, 0, $month + 1 , 1, $year)) . '&id=' .$uid. '" class="year"> &gt; </a>';
//  echo '<a href="?m=' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . '" class="year"> &lt;　</a> ' . $year . '年' . $month . '月';
//  echo ' <a href="?m=' . date('Ym', mktime(0, 0, 0, $month + 1 , 1, $year)) . '" class="year">　&gt;</a>';
  echo '</caption><tbody><tr>';

  $i = 0;
  while ($i <= 6) {
    $c = weekdayColor_get($i);
    echo '<th style="background-color : '.$c.';">' . $weekday[$i] . '</th>';
    $i++;
  }
  echo '</tr><tr>';
  $i = 0;
  while ($i != date('w', mktime(0, 0, 0, $month, 1, $year))) {
    echo '<td style="background-color : #ffffff;">　</td>';
    $i++;
  }
  for ($days = 1; checkdate($month, $days, $year); $days++) {
    if ($i > 6) {
      echo '</tr><tr>';
      $i = 0;
    }
//    $c = color_get($i, $days, $day, $thismonth, $thisyear, $month, $year, $arr, $json_count);
    $c = color_get($i, $days, $day, $thismonth, $thisyear, $month, $year, $arr);
    echo '<td style="background-color : ' . $c . ';">'.$days.'</td>';
    $i++;
  }
  while ($i < 7) {
    echo '<td style="background-color : #ffffff;">　</td>';
    $i++;
  }
  echo '</tr></tbody></table><p>';

//END ISHITSUBO
  ?>

</div>

 <div id="clickedDate"></div>
 <div id="cal"></div>
    <div id="next"></div>
 
  <script>
 
//ISHITSUBO 2     

  var cellnum;
  var previousNum = "";
  var dayVal;
  var yearVal = "<?php echo $year ?>";
  var monthVal = "<?php echo $month ?>";
  var data = JSON.parse('<?php echo  addslashes($json_userData); ?>');
  var stimeVal;
  var etimeVal,etime_h,etime_m;

//  $.getJSON("calender.json", function(data){

   /* var markerData = [];
    var uidVal = "<?php echo $uid ?>";

    $(function(){

       $.ajax({
         type:"POST",
         url:"getUschedule.php",
         dataType:"json",
         data:{
            uid : uidVal
         }
       }).done(function(data){
         console.log(data);
         markerData = data;
       }).fail(function(xhr,err){
         console.log(err);
       });
*/
//console.log(markerData);
//console.log(data);
//console.log("<?php $json_userData = $_POST['json_userData']; echo $json_userData ?>")
//console.log('<?php echo $language ?>');

    $("#calender td").on("click",function(){
      dayVal = $(this)[0].innerText;
 //     cellnum = '' +yearVal+ monthVal + dayVal;
      cellnum =  '' + monthVal + '月'  + dayVal + '日';
      console.log(cellnum);
      
      $('#cal').show();
      $('#next').show();
      
      $('#clickedDate').html('<div class="info text-center h4">選択したガイド希望日：'+yearVal+'年'+monthVal+'月'+dayVal+'日</div>');

      etimeVal = [];
      if (cellnum == previousNum){
          $('#cal').hide();
          $('#next').hide();
          previousNum = "";
          //break;
//        }else if(cellnum == data[i].date　|| data[i].date == "all"){
        }else{
          //stimeVal = data[i].start_time;
          //etimeVal = data[i].end_time;
          //console.log(data[i].date);  
          $('#cal').html(
          '<br><div class="row"><div class="col-sm-6"><div class="select-title text-center">ガイド開始時間</div></div>'
          +'<div class="col-sm-6"><div class="form-group"><div class="select-btn guide-select"><select name="start_time" class="form-control"><option value="08:00:00">8:00</option><option value="09:00:00">9:00</option><option value="10:00:00">10:00</option><option value="11:00:00">11:00</option><option value="12:00:00">12:00</option><option value="13:00:00">13:00</option><option value="14:00:00">14:00</option><option value="15:00:00">15:00</option><option value="16:00:00">16:00</option><option value="17:00:00">17:00</option></select></div></div></div></div>');
$('#next').html('<br>'+'<input name="yearVal" type="hidden" value="'+yearVal+'">'+'<input name="date" type="hidden" value="'+cellnum+'">'
+'<input id="submit_btn" class="btn btn-outline-info btn-lg btn-block" type="submit" value="ガイドさんの検索へ">');
        }
     
      for(var i in data){
        
          if(cellnum == data[i].date){
           console.log("成功!");
           console.log(data[i]);
           etimeVal = data[i].end_time.split(":");
           etime_h = parseInt(etimeVal[0],10);
           etime_m = parseInt(etimeVal[1],10);

           //$('#cal').prepend('<div id="guide" class="info text-center h4"><p>　(人気)　'+data[i].location+'ガイド </p>'+'<table id="states"><tr><td>Date</td><td>'+data[i].date+'</td></tr><tr><td>UID</td><td>'+data[i].UID+'</td></tr><tr><td>Boarding time</td><td>'+data[i].start_time+'</td></tr>'+'<tr><td>END</td><td>'+data[i].end_time+'</td><td>('+data[i].period+'min)</td></tr>'+'<tr><td>Language</td><td>'+data[i].language+'</td></tr>'+'<tr><td>Total fee</td><td>¥'+data[i].charge+'</td><td>('+data[i].max_num_participant+'名)</td></tr></table></div>');
           //break;

           $('#cal').prepend('<div id="guide" class="info text-center h4"><p>　(人気)　'+data[i].location+'ガイド </p>'+'<table id="states"><tr><td>GID</td><td>'+data[i].GID+'</td></tr><tr><td>Date</td><td>'+data[i].date+'</td></tr><tr><td>UID</td><td>'+data[i].UID+'</td></tr><tr><td>Boarding time</td><td>'+data[i].start_time+'</td></tr>'+'<tr><td>END</td><td>'+data[i].end_time+'</td><td>('+data[i].period+'min)</td></tr>'+'<tr><td>Language</td><td>'+data[i].language+'</td></tr>'+'<tr><td>Total fee</td><td>¥'+data[i].charge+'</td><td>('+data[i].max_num_participant+'名)</td></tr></table></div>');
           //break;

         }
       }
     
    
      previousNum = cellnum;
    //});
  });
//END ISHITSUBO-2

//formにactionとvalueを代入する
  function checkText3() {

    var mode = $('[name="mode"] option:selected').val();

    var stime = $('[name="start_time"] option:selected').val();
   // var selected_num = stime.selectedIndex;
    var stimeVal = stime.split(":");
    var stime_h = parseInt(stimeVal[0],10);
    var stime_m = parseInt(stimeVal[1],10);

    if(etimeVal.length != 0){
      var etime_h = parseInt(etimeVal[0],10);
      var etime_m = parseInt(etimeVal[1],10);
    }
    if(!(dayVal)){
      alert('日付をクリックして、ガイド開始時間を選択してください!');
      $('#day').focus();
      return false;
    }
  /*  else if ((!stimeVal) && (!etimeVal)) { 
        if(mode == 0 || mode == 2){
           alert('予定が登録されていませんので登録（追加)を選択してください');
           return false;
        }
    }*/
    //alert(etime_h);
    //alert(etime_m);
    //alert(typeof etime_h != 'undefined');
    //alert(typeof etime_m != 'undefined');
    //alert(etime_h <= stime_h);
    //alert(etime_m <= stime_m);
    //alert(etimeVal.length);					  
    //alert((typeof etime_h != 'undefined')&&(typeof etime_m != 'undefined'));
    if ((typeof etime_h != 'undefined')&&(typeof etime_m != 'undefined')) {
       if (((stime_h <= etime_h)&&(stime_m <= etime_m))|(stime_h < etime_h)) {
        alert('ガイド開始時間をEND(終了時間)よりも後になるように選択してください!');
        return false;
       } else {
        //alert(stime_h);
        //alert(stime_m);			       
	//alert(etime_h);
	//alert(etime_m);				       
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "user_modify_registration.php";
        //nameに合わせてvalueを代入する
        document.myform3.year.value = yearVal;
        document.myform3.month.value = monthVal;
        document.myform3.day.value = dayVal;
      //alert(dayVal);
   //alert( document.myform3.month.value );

       }
    } else {
      //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "user_modify_registration.php";
    }
  }								   
</script>


<input name = "year" type="hidden" >
<input name = "month" type="hidden" >
<input name = "day" type="hidden" >

 <!--<div class="main">
        <div class="select-btn guide-select">
          <select name="mode" require>
            <option value="1" >登録(追加)</option>
            <option value="0" >変更</option>
            <option value="2" >削除</option>
          </select>
        </div>
        <p></p>
      </div>
-->
        <p></p>
<!--
       <input id="submit_btn" class = "btn resistration" type="submit" value="ガイドさんの検索へ">
        <p></p>
-->
      </div>
 </div>

</form>
 </body>
</html>
