<!DOCTYPE html>
  <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>シェアリングツアーガイドサービス</title>

<script>

history.pushState(null, null, null);
$(window).on("popstate", function (event) {
  if (!event.originalEvent.state) {
    history.pushState(null, null, null);
    return;
  }
});

</script>

    <style type='text/css'>

#map {
 width: 100%;
 height: 450px;
}
</style>

    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!--<link rel="stylesheet" href="../css/0-3-A3.css">
-->
    <script src="https://maps.googleapis.com/maps/api/js?language=jakey=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script>

      var map;
      var marker = [];
      var markerData = [];
      var guideData = [];
      var areaVal = "<?php echo $area = $_POST['area']; ?>";
      var gidVal = "<?php echo $gid = $_POST['gid']; ?>";
      var categoryVal = "<?php $area = $_POST['category']; echo $area ?>";

      $(function(){
        $.ajax({
          type:"POST",
          url:"poi_dbconnect.php",
          dataType:"json",
          data:{
             area : areaVal, 
             category : categoryVal 
          }
        }).done(function(data){
          console.log(data);
          //alert(data[0].lat);
          markerData = data;
        }).fail(function(xhr,err){
          console.log(err);
        });
      });

      $(function(){
        $.ajax({
          type:"POST",
          url:"guide_dbconnect.php",
          dataType:"json",
          data:{
             gid : gidVal
          }
        }).done(function(data){
          console.log(data);
          //alert(data[0].lat);
          guideData = data;
        }).fail(function(xhr,err){
          console.log(err);
        });
      });


      var MKData = JSON.parse('{"lat":35.010239,"lng":135.759646}');
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
          zoom: 16 // 地図のズームを指定
	  
        });


        for (var i = 0; i < markerData.length; i++) {

          //アイコンの種類指定
          icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/icons/blue-dot.png',new google.maps.Size(70,84),new google.maps.Point(0,0));

          for (j = 0; j <guideData.length; j++){
            if( markerData[i]['JPname'] == guideData[j]['location']){
               icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/icons/pink-dot.png',new google.maps.Size(70,84),new google.maps.Point(0,0));
            }
          }
 
          // 緯度経度のデータ作成^M
          markerLatLng = new google.maps.LatLng({
           lat: markerData[i]['lat'], 
           lng: markerData[i]['lng']
          }); 

          // マーカーの追加
          marker[i] = new google.maps.Marker({ 

            position: markerLatLng, // マーカーを立てる位置を指定
            icon: icon, //色を指定
            map: map // マーカーを立てる地図を指定

          });

          // 吹き出しに出す文
          myInfoWindow = new google.maps.InfoWindow({
            content: markerData[i]['JPname'],
            disableAutoPan: true //自動移動を解除
          });
           // 吹き出しを開く
          myInfoWindow.open(map, marker[i]);

          markerEvent(i);//メソッド呼び出し
	       //console.log(markerData[0]['lat']);
	       //console.log(MKData['lat'], MKData['lng']);
       }
      }

//      function add_marker() {
//        for (var i = 0; i < mapData.length; i++) {
//          var item = mapData[i];

//          // マーカーの設置
//          var marker = new google.maps.Marker({
//            position: item['latlng'],
//            map: map
//          });
//        }
//      }

      function markerEvent(i) {
        google.maps.event.addListener(marker[i], 'click', (function(JPname,lat,lng){
          return function(){
            $form_name = JPname;
            $form_lat = lat;
            $form_lng = lng;
            target = document.getElementById("output");
            target.innerHTML = JPname;
            target.style.display = "block";
           // target.innerHTML = "【　" + JPname + "  】";
           // target = document.getElementById("message");
           // target.innerHTML = "ガイド可能な場所";
          };
        })(markerData[i].JPname, markerData[i].lat, markerData[i].lng));
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
        document.myform3.action = "confirm.php";
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
    }

    </script>
  </head>
  <body>


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
 $gid = $_POST['gid'];

 $thisday = date('j');
 $thismonth = date('n');
 $thisyear = date('Y');
 $thisdate = date('n-j');

 echo '<input name = area' .' type=hidden value="' . $area . '">';
 echo '<input name = day' .' type=hidden value="' . $day . '">';
 echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = thisdate' .' type=hidden value="' . $thisdate . '">';
 echo '<input name = thisyear' .' type=hidden value="' . $thisyear . '">';
 echo '<input name = thismonth' .' type=hidden value="' . $thismonth . '">';
 echo '<input name = thisday' .' type=hidden value="' . $thisday . '">';

// $year = date('Y', strtotime($m . '01'));
//    $month = date('n', strtotime($m . '01'));
//    $year = date('Y');
//    $month = date('n');
//  echo 'this' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . '** ' . $thisyear . '年' . $thismonth . '月';
//  echo ' <br>' . $thisdate . "<br>";

?>
    <div class="main">
<!--      <div class="startup">
 -->
<!--        <p><?php echo $thisyear ?> 年<?php echo $thismonth ?>月から2ヶ月間の名所登録中</p> -->
<!--        <p>スポット登録中</p>
	    </div>
 -->
      <div class="container-fluid">
        <div class="text-center">
	  <br><br>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
	      <div><a href="#"  class = "btn btn-danger disabled btn-xl btn-block" >スポット登録中</a></div>
            </div>
          </div>
	  <br>
	  <!--<div class="message">
-->
            <p class="h4">ガイド可能な場所のピンを
              クリックして下さい。</p>
	  <!--</div>-->
	  <p class="h4"> <font color="ff69b4">ピンク</font>色のピンは既に登録されているスポットです </p>
	  <div class="map-wrapper">
            <div id="map"></div>
	  </div>
	  <br><br>
	  
	  <div class="destination-wrapper">
            <p class="select-title">ガイド可能な場所</p>
<!--      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <div><a href="#"  class = "btn btn-info btn-lg btn-block" >ガイド可能な場所</a></div>
        </div>
	　　　</div>    -->
            <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
		<div class="bg-warning" id="output"></div> 
		<script>
		  document.getElementById("output").style.display = "none";
		</script>
	      </div>
	    </div>
	    　　　　　　
	    <br><br>
	    <p class="select-title">ガイド場所に関するコメント(128文字まで)</p>
	    <table align="center" border="0" cellspacing="0" cellpadding="1">
	      <tr>
		<td>
		  <form method="POST" action="place_registration.php?rep=1" target="com">
		    <!--<span style="font-size:18px;font-weight:100;color:#ff0000">■ </span><b>一言コメントをどうぞ！</b>（100字まで）<r>-->
		    <!--<input type="text" id="comment" name="comment" size="80" maxlength="128" style="width:535;border:1px solid #00ccff">-->
		    <textarea id="comment" name="comment" rows="5" cols="50" maxlength="128" wrap="soft"></textarea> 
		    <!--<input type="submit" id="submit" value=" 送信 " style="width:54"> -->
		</td></form>
	      </tr>
	      <tr>
		<td>
		  <div id="commentv" style="font-size:13px;line-height:15px;color:#666699;width:580px;height:160px;border:1px solid #00ccff;padding:8px;overflow-y:scroll;display:none;"></div>
		  <iframe name="com" src="place_registration.php" id="com" style="width:301px;height:201px;frameborder:0px;border:0px;padding:0px;overflow:hidden;display:none;"></iframe>
		</td>
	      </tr>
	    </table>
	
	    <br><br>
	    <!--<div class="select-wrapper">
-->
	    <p class = "select-title">ガイド時間</p>
	    <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
		<div class="form-group">
		  <div class="select-btn guide-select">
		    <select name="time" required class="form-control">
                      <option value="10">10分</option>
                      <option value="20">20分</option>
                      <option value="30">30分</option>
                      <option value="40">40分</option>
                      <option value="50">50分</option>
                      <option value="60">60分</option>
                      <option value="70">70分</option>
                      <option value="80">80分</option>
                      <option value="90">90分</option>
		    </select>
		  </div>
		</div>
              </div>
	    </div>
	    <p class ="select-title">料金</p>
	    <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
		<div class="form-group">
		  <div class="select-btn guide-select">
		    <select name="fee" required class="form-control">
                      <option value="100">100円</option>
                      <option value="200">200円</option>
                      <option value="250">250円</option>
                      <option value="290">290円</option>
                      <option value="350">350円</option>
                      <option value="490">490円</option>
                      <option value="590">590円</option>
                      <option value="690">690円</option>
                      <option value="790">790円</option>
                      <option value="1000">1,000円~</option>
		    </select>
		  </div>
		</div>
              </div>
	    </div>
	    <p class="select-title">最大人数</p>
	    <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
		<div class="form-group">
		  <div class="select-btn guide-select">
		    <select name="maxsubject" required class="form-control">
		      <option value="5">5人</option>
		      <option value="10">10人</option>
		      <option value="12">12人</option>
		      <option value="15">15人</option>
		      <option value="20">20人</option>
               </select>
             </div>
	   </div>
	 </div>
       </div>       
       <p class="select-title">対応可能言語</p>
       <div class="row">
         <div class="col-sm-2"></div>
         <div class="col-sm-8">
           
          <!-- <div class="select-btn guide-select">-->
             <input type="checkbox" name="language[]"  value="JP" checked="checked">日本語</option>
             <input type="checkbox" name="language[]"  value="EN">英語</option>
             <input type="checkbox" name="language[]"  value="CH">中国語</option>
             <input type="checkbox" name="language[]"  value="FR">フランス語</option>
             <input type="checkbox" name="language[]"  value="DE">ドイツ語</option>
           <!--</div>-->

       </div>
       </div>

<br>
       <div class="row">
         <div class="col-sm-2"></div>
         <div class="col-sm-8">
	   <div class="next-btn-parent"> 
             <input class="btn btn-info btn-lg btn-block" type="submit" value="Next"/>
	   </div>
	 </div>
       </div>
       <br>
      
</div>
</div>
</div>
</div>
<br><br>
</form>


</body>
</html>
