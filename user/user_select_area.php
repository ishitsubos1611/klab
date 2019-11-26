<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STEP 1</title>


  <!--<link rel="stylesheet" href="../css/0-3-A1.css">-->
  <link rel="stylesheet" href="../css/bootstrap.css">

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
<form name="step1" action="user_place_registration.php" method='post'>
<?php
  session_start();  
  $select_step = $_POST['step'];
  $uid = $_SESSION["USERID"];

 if($select_step == 1){
  $step = "./user_place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

 echo '<input name=uid' .' type=hidden value="' . $uid . '">';
?>
<!--
<script>
  console.log("<?php echo $uid; ?>");
</script>  
-->
  <div class="main">
    <div class="container-fluid">
      <div class="text-center">
	<br><br>
	<div class="btn-wrapper">

        <!--  <p>ユーザーIDを入力して下さい</p>
          <div class="form-group form-check">
            <input name = "uid" style=text value=" . ">
          </div> -->

<!--	<input name="uid" type=hidden value="<?php echo $uid; ?>">    -->
	
          <p>エリアを選択してください</p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
		<div class="select-btn guide-select">
		  <select name="area" class="form-control">
		    <option value="kyoto" >近畿（京都）</option>
		    <option value="kanto" >関東</option>
		  </select>
		</div>
	      </div>
	    </div>
          </div>
          
          <p>ガイド希望のカテゴリを選択してください</p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
		<div class="select-btn guide-select">
		  <select name="category" class="form-control">
		    <option value="Shrine and Temple" >神社仏閣</option>
		    <option value="Historic site" >史跡</option>
		    <option value="Castle" >城</option>
		    <option value="Historic monuments" >記念碑</option>
		    <option value="museum" >博物館</option>
		    <option value="Art museum" >美術館</option>
		    <option value="Park" >公園</option>
		    <option value="Zoo and Botanical garden" >動植物園</option>
		    <option value="Mountain" >山</option>
		    <option value="Famous place" >その他</option>
		    <option value="all" >all</option>
		  </select>
		</div>
	      </div>
	    </div>
	  </div>

          <p>名所か道案内か選択してください</p>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="form-group">
		<div class="select-btn guide-select">
		  <select name="style" class="form-control">
		    <option value="1" >名所ガイド</option>
		    <option value="2" >道案内ガイド</option>
		  </select>
		</div>
	      </div>
	    </div>
          </div>
          <p></p>

	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
	      <input class = "btn btn-info btn-lg btn-block" type="submit" value="Next">
	    </div>
	  </div>
	  
          <br>
	  <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
	      <input class = "btn btn-info btn-lg btn-block" type="reset" value="入力内容をリセットする">
	    </div>
	  </div>
 </form> 
          <br>
          <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
	      <a href="../user_top.php" class = "btn btn-info btn-lg btn-block" >トップページに戻る</a>
	    </div>
	  </div>
	  <br>
</div>

<!--
?>
<form name="step1" action="user_place_registration.php" method='post'>
 <div class="main">
      <div class="btn-wrapper">

        <p>ユーザーIDを入力して下さい</p>
        <div class="select-btn guide-select">
          <input name = "uid" style=text value="1">
        </div>

        <p>エリアを選択してください</p>
        <div class="select-btn guide-select">
          <select name="area" >
            <option value="kyoto" >近畿（京都）</option>
            <option value="kanto" >関東</option>
          </select>
        </div>
          
        <p>ガイド希望のカテゴリを選択してください</p>
       <div class="select-btn guide-select">
         <select name="category" >
            <option value="all" >all</option>
            <option value="Shrine and Temple" >神社仏閣</option>
            <option value="Historic site" >史跡</option>
            <option value="Castle" >城</option>
            <option value="Historic monuments" >記念碑</option>
            <option value="museum" >博物館</option>
            <option value="Art museum" >美術館</option>
            <option value="Park" >公園</option>
            <option value="Zoo and Botanical garden" >動植物園</option>
            <option value="Mountain" >山</option>
            <option value="Famous place" >その他</option>
         </select>
       </div>

        <p>名所か道案内か選択してください</p>
        <div class="select-btn guide-select">
          <select name="style" >
            <option value="1" >名所ガイド</option>
            <option value="2" >道案内ガイド</option>
          </select>
        </div>
        <p></p>

       <input class = "btn resistration" type="submit" value="Next">
        <p></p>
       <input class = "btn resistration" type="reset" value="入力内容をリセットする">
      </div>
 </div>
 </form> 

    <a href="../top.html" class = "btn resistration" >トップページに戻る</a> -->


 </body>
</html>
