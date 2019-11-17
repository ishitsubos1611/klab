<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>変更・追加・削除希望の日選択</title>

  <!--<link rel="stylesheet" href="../css/0-3-A1.css">
      <link rel="stylesheet" href="../css/0-3-A3.css">-->
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/calender.css">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<?php
 $area = $_POST['area'];
 $style = $_POST['style'];
 $gid = $_POST['gid'];
 $uid = $_POST['uid'];
 $location = $_POST['location'];

?>

</head>
<body margin:auto; text-align:center;>

  <div class="main">
    <div class="container-fluid">
      <div class="text-center">
	<br><br>
	<a href="#"  class = "btn btn-warning disabled btn-xl btn-block">
	  <?php if(isset($_GET["uid"])) echo $gid = $_GET['uid'];else echo $uid = $_POST['uid']; ?>さんのガイド希望日を選択中
	</a>
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

 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = location' .' type=hidden value="' . $location . '">';

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
    'language'=>$row['Language'],
    'location'=>$row['location'],
    'requiredTime'=>$row['period'],
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['long'],
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
    $date = $m."月".$d.'日';
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
  echo '<a href="?m=' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . '&id=' .$gid. '" class="year"> &lt; </a>' . $year . '年' . $month . '月';
  echo '<a href="?m=' . date('Ym', mktime(0, 0, 0, $month + 1 , 1, $year)) . '&id=' .$gid. '" class="year"> &gt; </a>';
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

<!--</div>-->

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
  var etimeVal;

//  $.getJSON("calender.json", function(data){

//    var markerData = [];
/*    var gidVal = <?php echo $gid ?>;*/

    $(function(){

//       $.ajax({
//         type:"POST",
//         url:"db_getschedule.php",
//         dataType:"json",
//         data:{
//            gid : gidVal
//         }
//       }).done(function(data){
////      console.log(data);
//        markerData = data;
//       }).fail(function(xhr,err){
//         console.log(err);
//       });

//console.log(markerData);
//console.log(data);
console.log("<?php $json_userData = $_POST['json_userData']; echo $json_userData ?>")

    $("#calender td").on("click",function(){
      dayVal = $(this)[0].innerText;
 //     cellnum = '' +yearVal+ monthVal + dayVal;
      cellnum =  '' + monthVal + '月'  + dayVal + '日';
      $.post('modify_registration.php','cellnum');

      $('.info').remove();
      $('#clickedDate').html('<div class="info text-center h4">選択したガイド希望日：'+yearVal+'年'+monthVal+'月'+dayVal+'日</div><br>');
      //$('#cal').remove();
      //$('.select-btn guide-select').remove();
      $('#cal').html('<div class="row"><div class="col-sm-2"></div><div class="col-sm-3"><div class="text-center h4">ガイド開始時間</div></div>'
+'<div class="col-sm-5"><div class="form-group"><div class="select-btn guide-select text-center"><select class="form-control"><option value="08:00:00">8:00</option>	       <option value="09:00:00">9:00</option>	       <option value="10:00:00">10:00</option>	       <option value="11:00:00">11:00</option>	       <option value="12:00:00">12:00</option>	       <option value="13:00:00">13:00</option>	       <option value="14:00:00">14:00</option>	       <option value="15:00:00">15:00</option><option value="16:00:00">16:00</option><option value="17:00:00">17:00</option></select></div></div></div></div>');
      $('#next').html('<p></p>'+'<div class="row"><div class="col-sm-2"></div><div class="col-sm-8"><input id="submit_btn" class = "btn btn-info btn-lg btn-block" type="submit" value="ガイドさんの検索へ"></div></div><br><br>');

      for(var i in data){
        if (cellnum == previousNum){
          $('.info').remove();
          $('.select-title').remove();
          $('select-btn guide-select').remove();
          $('select').remove();
          $('#submit_btn').remove();
          //$('#cal').append();
          previousNum = "";
          break;
//        }else if(cellnum == data[i].date　|| data[i].date == "all"){
        }else{
          //stimeVal = data[i].start_time;
          //etimeVal = data[i].end_time;
            
          /*$('#cal').html(
          '<div class="info text-center h4">ガイドa開始時間</div><br>'
          +'<div class="select-btn guide-select"><select name=start_time><option value="08:00:00">8:00</option><option value="09:00:00">9:00</option><option value="10:00:00">10:00</option><option value="11:00:00">11:00</option><option value="12:00:00">12:00</option><option value="13:00:00">13:00</option><option value="14:00:00">14:00</option><option value="15:00:00">15:00</option><option value="16:00:00">16:00</option><option value="17:00:00">17:00</option></select></div>'
              
 //             +'<p class = "select-title">ガイド終了時間</p>'+'<div class="select-btn guide-select"><select name=end_time required><option value="9:00">9:00</option><option value="10:00">10:00</option><option value="11:00">11:00</option><option value="12:00">12:00</option></select></div>'
        );*/
          

//     $('#cal').append('<div id="guide" class="info"><p>　(人気)　'+data[i].guidelocation+'ガイド </p>'
//     +'<table id="states"><tr><td>Date</td><td>'+monthVal+'月'+dayVal+'日</td></tr><tr><td>GuidScheduleID</td><td>'+data[i].GuidScheduleID+'</td></tr><tr><td>Boarding time</td><td>'+stimeVal+'</td></tr>'
//     +'<tr><td>END</td><td>'+etimeVal+'</td><td>('+data[i].requiredTime+'min)</td></tr>'
//     +'<tr><td>Language</td><td>'+data[i].language+'</td></tr>'
//     +'<tr><td>Total fee</td><td>¥'+data[i].charge+'</td><td>('+data[i].max_num_participant+'名)</td></tr></table></div>'
//     +'<input type="hidden" name="scheduleGID" value="'+data[i].GuidScheduleID+'"/>');
          //+'<form  id="form'+idnumber+'" action="guideDelete.php" method="post"><input type="hidden" name="id" value="'+idnumber+'"/><input id="detail" type="submit" value="detail"></form></div>'
        }
      }

      previousNum = cellnum;
    });
  });
//END ISHITSUBO-2

//formにactionとvalueを代入する
  function checkText3() {

    var mode = $('[name="mode"] option:selected').val();

    if(!(dayVal)){
      alert('日付をクリックして、ガイド開始時間を選択してください!');
      //$('#day').focus();
      return false;
    } else if ((!stimeVal) && (!etimeVal)) { 
        if(mode == 0 || mode == 2){
           alert('予定が登録されていませんので登録（追加)を選択してください');
           return false;
        }
//    } else if ((stimeVal == '8:00' & etimeVal == '17:00')) { 
//        if(mode == 1){
//            alert('変更を選択てください!');
//            return false;
//        }
    }// else { 
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "user_modify_registration.php";
        //nameに合わせてvalueを代入する
        document.myform3.year.value = yearVal;
        document.myform3.month.value = monthVal;
        document.myform3.day.value = dayVal;
      //alert(dayVal);
    //}
   //alert( document.myform3.month.value );

  }

//    var markerData = [];
//    var gidVal = <?php echo $gid ?>;
//
//    $(function(){
//        $.ajax({
//          type:"POST",
//          url:"db_getschedule.php",
//          dataType:"json",
//          data:{
//             gid : gidVal 
//          }
//        }).done(function(data){
//          //console.log(data);
//         // alert(data[3].name);
//         //markerData = JSON.parse(data[0]);
//         markerData = data;
//        }).fail(function(xhr,err){
//          console.log(err);
//        });
//
//      });
	


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
