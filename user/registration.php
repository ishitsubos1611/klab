<!DOCTYPE html>
  <head>
<!--	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
  <meta charset="UTF-8">
    <title>シェアリングツアーガイドサービス</title>

<style type='text/css'>

#map {
 width: 100%;
 height: 450px;
}
</style>

    <link rel="stylesheet" href="../css/0-3-A3.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  </head>
  <body>

<?php 
 $area = $_POST['area'];
 $style = $_POST['style'];
// データベース接続
$area = 'kyoto';

$host = 'localhost';
$dbname = 'tour_db';
$dbuser = 'yamamoto';
$dbpass = 'rikuya0217';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, array(PDO::ATTR_EMULATE_PREPARES => false));
// console.log('通信成功');

} catch (PDOException $e) {
 var_dump($e->getMessage());
 console.log($e->getMessage());
 echo '接続失敗';
 exit;
}
// データ取得
$sql = "SELECT * FROM POI WHERE area = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($area));

//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'id' =>$row['id'],
  'area' =>$row['area'],
  'location' =>$row['location'],
  'JPname'=>$row['JPname'],
  'lat'=>$row['lat'],
  'long'=>$row['long'],
  'URL' =>$row['URL']
 );

}

//jsonとして出力
//console.log($php_json);
//header('Content-type: application/json');
//echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
// $php_json =  json_encode($memberList,JSON_UNESCAPED_UNICODE);
//$php_json = rtrim($php_json, ",");
//echo $php_json;
//print_r($memberList);
//console.log($php_json);
?>
   <script>

      var map;
      var jsVal = "<?php echo $memberList ?>";
      var areaVal = "<?php echo $area ?>";
      var marker = [];
      var markerData = [];
      var markerData1 = [
       {
         lat: 35.004089,
         lng: 135.758452,
         name: 'shijyo-karasuma',
         url:''
        },{
         lat: 35.014511,
         lng: 135.74825,
         name: 'nijo-jo',
         url:'http://nijo-jocastle.city.kyoto.lg.jp/'
        },{
         lat: 35.014521,
         lng: 135.74835,
         name: 'nijo-jo2',
         url:'http://nijo-jocastle.city.kyoto.lg.jp/'
        },{
         lat: 35.000704,
         lng: 135.781939,
         name: 'kodaiji',
         url:'http://www.kodaiji.com/'
        },{
         lat: 34.7019399,
         lng: 135.51002519999997,
         name: 'roten',
         url: 'https://ja.wikipedia.org/wiki/露天神社'//大阪市のお初天神近くにあるためお初天神の説明をリンク
        },{
         lat: 34.9335411,
         lng: 135.79998819999997,
         name: 'rokujizo',
         url: 'https://www2.city.kyoto.lg.jp/kotsu/tikadia/hyperdia/menu0123.htm'//六地蔵駅周辺のため駅の情報をリンク
       }

      ];

$(function(){
  $.ajax({
  type:"POST",
  url:"poi_dbconnect.php",
  dataType:"json",
  data:{
    area : areaVal 
   }
//  contentType: "application/json; charset=utf-8",
  }).done(function(data){
    console.log(data);
alert(data[0].lat);
 //markerData = JSON.parse(data[0]);
 markerData = data;
  }).fail(function(xhr,err){
    console.log(err);
  });
});
      var MKData = JSON.parse('{"lat":35.004089,"lng":135.758452}');
      var timerID = 0;

      StartTimer = function() {
        timerID = setInterval(ajaxMap, 500);
      };

      StopTimer = function() {
        clearInterval(timerID);
      };

      function initMap(){
        // #mapに地図を埋め込む
        //var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']});
        var mapLatLng = new google.maps.LatLng(MKData['lat'], MKData['lng']);
        //var mapLatLng = new google.maps.LatLng(35.700000,139.772000);
        map = new google.maps.Map(document.getElementById('map'), {
          center: mapLatLng,
          zoom: 14 // 地図のズームを指定
        });

        for (var i = 0; i < markerData.length; i++) {
          markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
          marker[i] = new google.maps.Marker({ // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map // マーカーを立てる地図を指定
        });
         markerEvent(i);//メソッド呼び出し
	       //console.log(markerData[0]['lat']);
	       //console.log(MKData['lat'], MKData['lng']);
       }
      }

      function add_marker() {
        for (var i = 0; i < mapData.length; i++) {
          var item = mapData[i];

          // マーカーの設置
          var marker = new google.maps.Marker({
            position: item['latlng'],
            map: map
          });
        }
      }

      function markerEvent(i) {
        google.maps.event.addListener(marker[i], 'click', (function(name,lat,lng){
          return function(){
            $form_name = name;
            $form_lat = lat;
            $form_lng = lng;
            target = document.getElementById("output");
            target.innerHTML = name;
            target.style.display = "block";
           // target.innerHTML = "【　" + name + "  】";
           // target = document.getElementById("message");
           // target.innerHTML = "ガイド可能な場所";
          };
        })(markerData[i].name, markerData[i].lat, markerData[i].lng));
      }
      function ajaxMap(){
        initMap();
        if( $('#map').find('div').length ){
          // マーカー毎の処理
          StopTimer();
        }
      }
      $(function() {
        StartTimer();
      });

//formにactionとvalueを代入する
  function checkText3() {
 
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "dbconnect.php";
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
    }

    </script>

   <form name="myform3" method='post' onsubmit="return checkText3()">
    <input name = "location" type="hidden" />
    <input name = "lat" type="hidden" />
    <input name = "lng" type="hidden" />
<?php

 $area = $_POST['area'];
 $style = $_POST['style'];
 $month = $_POST['month'];
 $day = $_POST['day'];
 $mode = $_POST['mode'];

 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = month' .' type=hidden value="' . $month . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
//echo '<p>text' .  $month . '<br>' . $area;

?>
    <div class="main">
      <div class="startup">
        <p>名所登録中</p>
      </div>
      <div class="message">
        <p>ガイド可能な場所のピンを
        クリックして下さい。</p>
      </div>
      <div class="map-wrapper">
          <div id="map"></div>
      </div>
      <div class="destination-wrapper">
         <p id = "message">ガイド可能な場所</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
        </script>
      </div>

     <div class="select-wrapper">
          <p class = "select-title">ガイド時間</p>
          <div class="select-btn guide-select">
            <select name=time required>
              <option value="10">10分</option>
              <option value="20">20分</option>
              <option value="30">30分</option>
              <option value="40">40分</option>
              <option value="50">50分</option>
              <option value="60">60分</option>
            </select>
        </div>
        <p class ="select-title">料金</p>
        <div class="select-btn guide-select">
          <select name="fee" required>
            <option value="100">100円</option>
            <option value="200">200円</option>
            <option value="300">300円</option>
            <option value="400">400円</option>
            <option value="500">500円</option>
            <option value="600">600円</option>
            <option value="700">700円</option>
            <option value="800">800円</option>
            <option value="900">900円</option>
            <option value="more">1,000円~</option>
          </select>
        </div>
        <p class="select-title">最大人数</p>
        <div class="select-btn guide-select">
          <select name="maxsubject" required>
            <option value="10">10人</option>
            <option value="12">12人</option>
            <option value="15">15人</option>
            <option value="18">18人</option>
            <option value="20">20人</option>
          </select>
        </div>

      </div>

    </div>

      <p> 

      <div class="next-btn-parent"> 
        <input class="next-btn" type="submit" value="Next"/>
      </div>
      </form>

  </body>
</html>
