<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STEP 1</title>

  <link rel="stylesheet" href="../css/bootstrap.css">
 <!-- <link rel="stylesheet" href="../css/0-3-A1.css"> -->
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
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
 $select_step = $_POST['step'];

 if($select_step == 1){
  $step = "./place_registration.php";
 }elseif($select_step == 2) {
  $step = "./select_date.php";
 }

?>

<form name="step1" action="./place_registration.php" method='post'>
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
	    <li class="nav-item">
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
            </li>
	    <li class="nav-item">
              <a class="nav-link" href="../user/user_select_area.php">ユーザ希望登録</a>
            </li>
	    <div class="dropdown-divider"></div>
	    <li class="nav-item">
              <a class="nav-link" href="../realtime/realtime_place_registration.php">現在地周辺登録</a>
            </li>
	  </ul>
	</div>
      </nav>
    
    <div class="container-fluid">
      <div class="text-center">
	<br><br><br>
        <div class="select-wrapper">

          <p>IDを入力して下さい</p>
          <!--<div class="select-btn">
            <input name = "gid" style=text value="1">
          </div>-->
	  <div class="form-group form-check">
            <input name = "gid" style=text value="1">
	  </div>
	  <br>

          <!--<p>エリアを選択してください</p>-->
	  <div class="row">
            <div class="col-sm-2"></div>
	    <div class="col-sm-5"><p>エリアを選択してください</p></div>
            <div class="col-sm-3">
	      <div class="form-group">
                <div class="select-btn">
                  <select name="area" class="form-control" >
                    <option value="kyoto" >近畿（京都）</option>
                    <option value="kanto" >関東</option>
                  </select>
		</div>
              </div>
	    </div>
          </div>
	  <br>
          <!--<p>ガイド希望のカテゴリを選択してください</p>-->
	  <div class="row">
            <div class="col-sm-2"></div>
	    <div class="col-sm-5"><p>ガイド希望のカテゴリを選択してください</p></div>
            <div class="col-sm-3">
	      <div class="form-group">
                <div class="select-btn guide-select">
                  <select name="category" class="form-control">
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
	      </div>
	    </div>
          </div>
	  <br>
          <!--<p>名所か道案内か選択してください</p>-->
	  <div class="row">
            <div class="col-sm-2"></div>
	    <div class="col-sm-5"><p>名所か道案内か選択してください</p></div>
            <div class="col-sm-3">
	      <div class="form-group">
                <div class="select-btn">
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
          <div class="col-sm-4">
            <!--<input class="btn btn-outline-info btn-lg btn-block" type="submit" value="Next">-->
	    <input class="btn btn-outline-info btn-lg btn-block" type="reset" value="Reset">
	  </div>
	<!--</div>
        <br>
	<div class="row">
          <div class="col-sm-2"></div>-->
          <div class="col-sm-4">  
	    <!--<input class="btn btn-outline-info btn-lg btn-block" type="reset" value="入力内容をリセットする">-->
	    <input class="btn btn-outline-info btn-lg btn-block" type="submit" value="Next">
          </div>
        </div>	  
	<br> 
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
	    <a href="../top.html" class="btn btn-outline-info btn-lg btn-block" >トップページに戻る</a>
	  </div>
	</div>
	 </div>
         </div>
        </div> 
      </div>
    </form>
  </body>
</html>
