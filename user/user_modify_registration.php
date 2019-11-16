<!DOCTYPE html>
 <head>
     <!--
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     -->
     <meta cherset="UTF-8">
    <title>シェアリングツアーガイドサービス</title>

    <style type='text/css'> 

#map {
 width: 100%;
 height: 450px;
}
</style>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/calender.css">




<?php

 //$area = $_POST['area'];
 //$style = $_POST['style'];
 //$month = $_POST['month'];
 //$day = $_POST['day'];
 //$mode = $_POST['mode'];
 $date = $_POST['date']; 
 $gid = $_POST['gid'];
 $uid = $_POST['uid']; 
 $year = $_POST['yearVal'];
 $location = $_POST['location'];
 $language = $_POST['language']; 
 //$start_time = $_POST['start_time'];
 $end_time = $_POST['end_time'];
 $stime = $_POST['start_time'];
 $period = $_POST['period'];
 $participants = $_POST['participants']; 

// $location = 'nijo';
/*
 if($mode == 0){
  $modify_mode = "変更";
 }elseif($mode == 1) {
  $modify_mode = "追加";
 }
*/
?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvUA-zwsf7ihPqKggFYt8wOsdNaEXz134" async="async" defer="defer"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>
  <body margin:auto; text-align:center;>

   <script>
        

    </script> 
 
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
	    <li class="nav-item active">
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
	    <a href="#"  class="btn btn-danger disabled btn-xl btn-block">
              ガイドさんの選択
	    </a>
	  <!--</div>  
	</div> -->
	
    <form name="myform3" method='post' onsubmit="return checkText3()">
<!--    <form name="myform3" method='post' onsubmit="return checkText3()">
    <input name = "location" type="hidden"/>
    <input name = "lat" type="hidden" />
    <input name = "lng" type="hidden" />
    <div class="main">
      <div class="startup">
-->
   <?php
 //echo '<input name = area' .' type=hidden value="' . $area . '">';
 //echo '<input name = style' .' type=hidden value="' . $style . '">';
 echo '<input name = year' .' type=hidden value="' . $year . '">';
 echo '<input name = date' .' type=hidden value="' . $date . '">';    
 //echo '<input name = month' .' type=hidden value="' . $month . '">';
 //echo '<input name = day' .' type=hidden value="' . $day . '">';
 //echo '<input name = mode' .' type=hidden value="' . $mode . '">';
 echo '<input name = gid' .' type=hidden value="' . $gid . '">';
 echo '<input name = uid' .' type=hidden value="' . $uid . '">';    
 echo '<input name = location' .' type=hidden value="' . $location . '">';
 echo '<input name = language' .' type=hidden value="' . $language . '">';    
 echo '<input name = stime' .' type=hidden value="' . $stime . '">';
 echo '<input name = end_time' .' type=hidden value="' . $end_time . '">';    
 echo '<input name = period' .' type=hidden value="' . $period . '">';
 echo '<input name = participants' .' type=hidden value="' . $participants . '">';    
 //echo  '<p>' . $year . '年' . $month . '月' . $day . '日' . 'のスケジュール修正中</p>';



?>

      <div class="message">
        <!--<p><?php echo $modify_mode; ?>希望のガイドさんを
        クリックしてください。</p>-->
           <!--<p>希望のガイドさんをチェックしてください。</p> -->
      </div>
    <!--
        <input type="checkbox" name="sample" value="1">ガイド1
        <input type="checkbox" name="sample" value="2">ガイド2
        <input type="checkbox" name="sample" value="3">ガイド3
    -->    
      <div id="guide"></div>

      <div id="output"></div>

<!--
      <div id="cal">
        <input type="checkbox" name="sample" value="1">ガイド1
        <input type="checkbox" name="sample" value="2">ガイド2
        <input type="checkbox" name="sample" value="3">ガイド3
      </div>

<!--      <div class="map-wrapper">
          <div id="map"></div>
      </div>
-->
<!--      <div class="destination-wrapper">
         <p id = "message"><?php echo $modify_mode; ?>のスポット</p>
        <div class = "destination" id = "output"></div>
        <script>
          document.getElementById("output").style.display = "none";
        </script>
      </div>

     <div class="message">
         <p><?php echo $location; ?>の<?php echo $modify_mode; ?></p>
     </div>
-->
    <script>
    console.log("<?php $start_time = $_POST['start_time']; echo $start_time ?>");
    //console.log("<?php $json_guideData = $_POST['json_guideData']; echo $json_guideData ?>");
    </script>
    
  <script>
    var guide = [];
        var guideData = [];
        var locationVal = "<?php $location = $_POST['location']; echo $location ?>";
        var stimeVal = "<?php $start_time = $_POST['start_time']; echo $start_time ?>";
	var periodVal = "<?php echo $period=$_POST['period'] ?>";
	var participants = "<?php echo $participants=$_POST['participants'] ?>";
        var language = "<?php echo $language ?>";
        var date = "<?php echo $date ?>";
        var year = "<?php echo $year ?>";
        var checkVal;
	//var submit = $('<input>');
        //$.post('select_date.php','cellnum');
        //var data = JSON.parse('<?php echo addslashes($json_guideData);  ?>');

        $(function(){
            $.ajax({
                type:"POST",
                url:"guide_recommend.php",
                dataType:"json",
                data:{
                    location : locationVal,
                    stime    : stimeVal 
                }
            }).done(function(data){
                console.log(data);
                //alert(data[0].lat);
                guideData = data;
                console.log(guideData); 
                console.log(stimeVal);
                console.log(locationVal);
	        console.log(periodVal);
	        console.log(participants);
                //console.log(guideData[0].charge);
                console.log(language);
                console.log(date);
                console.log(year);
                //console.log(dateVal);
	        selectGuide();
            }).fail(function(xhr,err){
                console.log(err);
            });
          });
      
        //if(guideData === []){
        //    $('#cal').append('<div id="guide" class="info"><p>申し訳ありませんが、現在ご希望の名所をガイドできるものがいません。</p></div>');
   // }
    function selectGuide(){
        //console.log(guideData.length);
	//console.log(<?php echo $uid; ?>);
	if(guideData.length == 0){
            $('#output').html('<p>申し訳ありませんが、現在ご希望の名所をガイドできるものがいません。</p>');
	}else{
	
        //console.log(guideData[0]['date']);

       
           $('.message').html('<p>希望のガイドさんをチェックしてください。</p>');    

           for (var i = 0; i <guideData.length; i++){
					       			     
		$('#guide').append('<p>ガイドID：'+guideData[i].GID+'　料金：'+guideData[i].charge+' 円　<input type="checkbox" name="guide" value="'+guideData[i].GID+','+guideData[i].charge+'"></p>');
					       
	   }
        //console.log(document.getElementById("checkbox").value);				     

      $('input[name="guide"]').on('change',function() {
	   //var vals=[];
  	   //var check=[];				   
	   //$('input[name=guide]:checked').each(function() {
	   var vals = $('input[name="guide"]:checked').map(function() {				     
               //var check=$(this).prop('checked');
	       //vals.push($(this).val());
	       return $(this).val().split(',');			     
	   }).get();
	       var check = $(this).prop('checked');
	       /*if(vals.length == 0) {
	         alert('チェックを付けてください!');
	         return false;
	       }*/			     
	       if(vals.length > 2) {
                 alert('チェックが２つ以上付いています!');
                 return $(this).prop('checked',false);
               }
               else if(check == true) {
		  $('#output').html('<p>ガイド'+vals[0]+'さんにチェックしました。</p>');
		  //$.post("user_confirm.php",charge=value);
		  //$('form').html('<input id="submit_charge" type="hidden" name="charge" value="">');
		  			     
		  console.log(check);
		  console.log(vals);			     
	       }else{
                  $('#output').html('');
		  console.log(check);
		  console.log(vals);			     
	       }
               console.log(vals);
               checkVal=vals;
	       //console.log(vals[1]);	     
           //});
       }); 
     }
   }				    
      //});
      //showGuide();					    
					     
    //});
  
//formにactionとvalueを代入する
  function checkText3() {
      console.log(checkVal);
      if(guideData.length == 0){
        document.myform3.action = "user_confirm.php";
        //document.myform3.elements[0].value = $form_name;
        //document.myform3.elements[1].value = $form_lat;
        //document.myform3.elements[2].value = $form_lng;
      }       
      else if(!(checkVal)) {
         alert('チェックを付けてください!');
         return false;
      }else{   
        //actionメソッドに遷移先のURLを代入する
        document.myform3.action = "user_confirm.php";
        //document.myform3.action = mode;
        //nameに合わせてvalueを代入する
        document.myform3.elements[0].value = $form_name;
        document.myform3.elements[1].value = $form_lat;
        document.myform3.elements[2].value = $form_lng;
        
        //alert( document.myform3.location.value );
        //console.log($start_time);
      }
  }    
   </script>

  

<!--     <div class="select-wrapper">
        <p class = "select-title">ガイド開始時間</p>
        <div class="select-btn guide-select">
            <select name=starttime required>
              <option value="8:00">8:00</option>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
            </select>
        </div> 
        <p class = "select-title">ガイド終了時間</p>
        <div class="select-btn guide-select">
            <select name=endtime required>
              <option value="9:00">9:00</option>
              <option value="10:00">10:00</option>
              <option value="11:00">11:00</option>
              <option value="12:00">12:00</option>
            </select>
        </div> 
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
-->
      </div>

    </div>

      <br> 

       
        <input class="btn btn-outline-info btn-lg btn-block" type="submit" value="確認"/>

	<br><br>
      </form>

  </body>
</html>
