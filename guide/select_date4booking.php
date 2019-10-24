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

?>

</head>
<!--<body margin:auto; text-align:center;>-->
<body>

  <div class="main">
    <div class="container-fluid">
      <div class="text-center">
	<br><br>
	<a href="#"  class = "btn btn-danger disabled btn-xl btn-block">
	  <?php if(isset($_GET["id"])) echo $gid = $_GET['id'];else echo $gid = $_POST['gid']; ?>さんのガイド予約日の確認中
	</a>
	<div class="message">
        カレンダーの日を
        クリックして下さい。
	</div>
 <p class="h4">※<font color="ff69b4">ピンク</font>はガイド予約日として登録されている日です</p>
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
$sql = "SELECT * FROM U_Schedule WHERE GID = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($gid));

$guideData[] = array();
$start_time = 0;
$end_time = 0;


while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
list($row_month, $row_day)=explode("-", $row['date']);
        $guideData[]=array(
'UserScheduleID' =>$row['scheduleUID'],
        'GuidScheduleID'=>$row['scheduleGID'],
    'GuideID'=>$row['GID'],
    'year'=>$row['year'],
    'date'=>$row['date'],
    'month'=>$row_month,
    'day'=>$row_day,
    'start_time'=>$row['start_time'],
    'end_time'=>$row['end_time'],
    //'language'=>implode("、", $row['Language']),
    'language'=>$row['language'],
    'guidelocation'=>$row['location'],
    'requiredTime'=>$row['period'],
    'guidelat'=>$row['lat'],
    'guidelong'=>$row['lng'],
    'charge'=>$row['charge'],
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
 $json_guideData =  json_encode($guideData, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
//print_r($json_guideData);
?>

<?php
//ISHITUBO

  function weekdayColor_get($i) {
    if ($i == 0) return '#FF00FF'; else return '#77EEFF';
  }
  function color_get($j, $d, $day, $thismonth, $thisyear, $m, $y, $arr) {
//    $date = $y.$m.$d;
    $date = $m. "-" .$d;
//    $date = $m. "月" .$d . "日";

    foreach ($arr as &$value) {
      if ($value["date"] == $date && $value["year"] == $y) {
        return '#ff69b4';
      } 
    }
    if ($j == 0) {
      return '#C0C0C0';
    }
    return '#ffffff';
  }
//  $file = "calender.json";
//  $json = file_get_contents($file);
//  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $json = mb_convert_encoding($guideData, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $arr = array();
//  $arr = json_decode($json,true);
  $arr = $guideData;
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

</div>

 <div id="clickedDate"></div>
 <div id="cal"></div>
 
  <script>
 
//ISHITSUBO 2     

  var cellnum;
  var previousNum = "";
  var dayVal;
  var yearVal = "<?php echo $year ?>";
  var monthVal = "<?php echo $month ?>";
  var data = JSON.parse('<?php echo  addslashes($json_guideData); ?>');
  var stimeVal;
  var etimeVal;

//  $.getJSON("calender.json", function(data){

//    var markerData = [];
//    var gidVal = <?php echo $gid ?>;
//
    $(function(){
//
//        $.ajax({
//          type:"POST",
//          url:"db_getschedule.php",
//          dataType:"json",
//          data:{
//             gid : gidVal
//          }
//        }).done(function(data){
//         markerData = data;
//        }).fail(function(xhr,err){
//          console.log(err);
//        });

//console.log(data);

    $("#calender td").on("click",function(){
      dayVal = $(this)[0].innerText;
 //     cellnum = '' +yearVal+ monthVal + dayVal;
  //    cellnum =  monthVal + '月'  + dayVal + '日';
  cellnum =  monthVal + '-'  + dayVal;
//console.log(cellnum);

      $('.info').remove();
      $('#clickedDate').html('<div class="info text-center h4">登録または変更の日付：'+yearVal+'年'+monthVal+'月'+dayVal+'日</div>');

      for(var i in data){
        if (cellnum == previousNum){
          $('.info').remove();
          previousNum = "";
          break;
//        }else if(cellnum == data[i].date　|| data[i].date == "all"){
        }else if(cellnum == data[i].date){

          stimeVal = data[i].start_time;
          etimeVal = data[i].end_time;

          $('#cal').append('<div id="guide" class="info"><p>　(人気)　'+data[i].guidelocation+'ガイド </p>'
          +'<table id="states"><tr><td>Date</td><td>'+monthVal+'月'+dayVal+'日</td></tr><tr><td>UserScheduleID</td><td>'+data[i].UserScheduleID+'</td></tr><tr><td>GuidScheduleID</td><td>'+data[i].GuidScheduleID+'</td></tr><tr><td>Boarding time</td><td>'+stimeVal+'</td></tr>'
          +'<tr><td>END</td><td>'+etimeVal+'</td><td>('+data[i].requiredTime+'min)</td></tr>'
          +'<tr><td>Language</td><td>'+data[i].language+'</td></tr>'
          +'<tr><td>Total fee</td><td>¥'+data[i].charge+'</td><td>('+data[i].max_num_participant+'名)</td></tr></table></div>'
          +'<input type="hidden" name="scheduleGID" value="'+data[i].GuidScheduleID+'"/>');
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
      alert('日付をクリックしてください!');
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
        document.myform3.action = "modify_registration.php";
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

<!-- 
<input name = "year" type="hidden" >
<input name = "month" type="hidden" >
<input name = "day" type="hidden" >

 <div class="main">
        <div class="select-btn guide-select">
          <select name="mode" require>
            <option value="1" >登録(追加)</option>
            <option value="0" >変更</option>
            <option value="2" >削除</option>
          </select>
        </div>
        <p></p>
      </div>

        <p></p>

       <input id="submit_btn" class = "btn resistration" type="submit" value="Next">
        <p></p>
      </div>
 </div>

</form> -->

<div class="main">
  <br>
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <div class="confirmation-wrapper">
	<a href="../top.html" class = "btn btn-info btn-lg btn-block"  >トップページに戻る</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
