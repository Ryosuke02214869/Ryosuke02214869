<?php
header('X-FRAME-OPTIONS: DENY');
header('Strict-Transport-Security: max-age=31536000;');
session_start();
require_once('mysql_connect_osyabo.php');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="description" content="オシャボの管理はできていますか？このサイトでは各オシャボの所持の有無を記録しておけるサービスを無料で提供しています。ぜひご利用ください。">
  <meta name="author" content="ますみ/masumi">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <meta name="google-site-verification" content="wPw_HjKvjngSifKGLpFehyysN_rC021zjwXPjnBJmvc" />
  <link href="css/reset.css" rel="stylesheet" type="text/css">
  <link href="css/index.css" rel="stylesheet" type="text/css">
  <link href="css/common.css" rel="stylesheet" type="text/css">
  <!-- <link href="css/mypage.css" rel="stylesheet" type="text/css"> -->
  <title>オシャボリストメーカー ソードシールド対応</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.png">
  <link rel="apple-touch-icon" href="img/ios_home_icon.jpg">
  <script>
  (function(d) {
    var config = {
      kitId: 'mrf2kdv',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
</head>
<body style="z-index: 1;">
  <div id="wrapper">
    <header>
      <div id="headerIn">
          <img src="img/header_text.png" id="text_header">
      </div>
      <div id="button_header_box">
      <a href="newlogin.php" class="button_header"><span>新規登録</span></a>
      <a href="login.php" class="button_header"><span>ログイン</span></a>
      </div>
    </header>

    <div id="contents_top" style="z-index: 4;" align="center">

      <center>
        <section id="area_1">
          <img src="img/osyabo_list_maker2.png" id="top_img">
        </section>
        <section id="area_2">
          <div class="kadomaru_white">
            <h2 class="font">「最近オシャレボールを集め始めた！」</h1>
          </div>
          <div class="kadomaru_white">
            <h2 class="font">「手持ちのオシャレボールが増えてきた！」</h1>
          </div>
          <div class="kadomaru_white">
            <h2 class="font">でも管理が大変・・・。</h1>
          </div>

          <div class="kadomaru_white">
            <h2 class="font">そんな時、役に立つのが</h1>
            <h2 class="font">この『オシャボリストメーカー』</h1>
            <h2 class="font">ぜひご利用ください！</h1>

            <h2 class="font" id="hashtag">#オシャボリストメーカー</h2>

            <div>
              <?php
              if($_SESSION["ID"] && $_SESSION["NAME"]){
                echo '<h1 class="flash_message" style="margin-top:15px;">現在ログイン中です</h1>';
                echo '<a href="mypage.php" class="button"><span>マイページへ</span></a>';
              }else{
                echo '<a href="newlogin.php" class="button"><span>新規登録</span></a>';
                echo '<a href="login.php" class="button"><span>ログイン</span></a>';
              }
              ?>
            </div>
          </div>
        </section>

      <section id="area_3">
          <div class="area_3_box">
        <div class="notice">
        <h2 class="font">お知らせ</h2>
        <ul class="mntList">
          <li><span class="suti03">アップデート</span>【2021/12/12】ランキング機能を実装しました！上位を目指そう！</li>
          <li><span class="suti06">お知らせ</span>【2021/06/25】ログインできないことがある不具合を修正いたしました</li>
          <li><span class="suti03">アップデート</span>【2021/06/14】保存更新時にかかる時間が3秒から1秒に！マイページでのID表示が名前表示に！コンプリート率が確認できるようになりました！</li>
          <li><span class="suti03">メンテナンス</span>【2021/05/30】アップデートのためメンテナンスを予定しております</li>
          <li><span class="suti06">お知らせ</span>【2020/03/20】サービス開始</li>
        </ul>
        </div>
        </div>
      </section>

      <section id="area_4">
        <div class="howtobox">
          <img src="img/point_img.png" class="point_img">
          <img src="img/howto1.png" class="howto"><h2 class="font kadomaru_white">持っているポケモンにチェック！</h2>
        </div>
        <hr class="border">
        <div class="howtobox">
          <img src="img/point_img.png" class="point_img">
          <img src="img/howto2.png" class="howto"><h2 class="font kadomaru_white">名前検索も可能！</h2>
        </div>
        <hr class="border">

        <br>
        <h3 style="color:black;">※現在画像化機能がありませんので<br>TwitterなどSNSへの投稿には向いておりません。<br>(スクショでは枚数が多くなると思います)</h3>
        <br>
      </section>

        <div id="ranking">
          <h1>ランキング(任意でランキング不参加にできるような設定も考え中)</h1>
          <?php
          $pdo = connectDB();
          $sql="SELECT user_name,complete_rate FROM User_List WHERE not_ranking_flg = false ORDER BY complete_rate DESC LIMIT 5";
          $stmt = $pdo->query($sql);
          // $pdo = null;    //DB切断
          if($stmt){
            echo '<table>';
            echo '<tr><th>順位</th><th>おなまえ</th><th>コンプリート率</th></tr>';

            foreach($stmt as $index => $user){
              $index+=1;
              echo '<tr><td>'.$index.'</td><td>'.$user['user_name'].'</td><td>'.$user['complete_rate'].'%</td></tr>';
              // echo '<h2 class="font">'.'1位　テストユーザ'.'</h2>';
            }
            echo '</table>';
          }else{
            echo '<h2 class="font">データが取得できませんでした</h2>';
          }
          ?>
        </div>

        <br>

        <section>
          <div id="inquiry">
            <h2>お問い合わせ</h2>
            <div id="inquiry_button_box">
              <!-- <div>
                <a href="inquiry_request.php" class="inquiry_button" target="_blank"><h3>ご要望</h3></a>
              </div> -->
              <div>
                <a href="inquiry_bug.php" class="inquiry_button"><h3>バグ・不具合を報告する</h3></a>
              </div>
            </div>
          </div>
        </section>

      </center>
    </div>
    <footer>
      <div class="ad">
        <a href="https://px.a8.net/svt/ejp?a8mat=3HE7K5+5H2I0I+4OOI+60H7L" rel="nofollow">
          <img border="0" width="120" height="60" alt="" src="https://www22.a8.net/svt/bgt?aid=210614981331&wid=001&eno=01&mid=s00000021861001010000&mc=1"></a>
          <img border="0" width="1" height="1" src="https://www16.a8.net/0.gif?a8mat=3HE7K5+5H2I0I+4OOI+60H7L" alt="">
          <a href="https://px.a8.net/svt/ejp?a8mat=3B5GNV+7R8BHU+3AQG+ZR2VL" rel="nofollow">
            <img border="0" width="320" height="50" alt="" src="https://www26.a8.net/svt/bgt?aid=200129179469&wid=001&eno=01&mid=s00000015388006005000&mc=1"></a>
            <img border="0" width="1" height="1" src="https://www14.a8.net/0.gif?a8mat=3B5GNV+7R8BHU+3AQG+ZR2VL" alt="">
            <a href="https://px.a8.net/svt/ejp?a8mat=3B5GNT+B6H1PU+4EKC+5ZEMP" rel="nofollow">
              <img border="0" width="320" height="50" alt="" src="https://www25.a8.net/svt/bgt?aid=200129177676&wid=001&eno=01&mid=s00000020550001005000&mc=1"></a>
              <img border="0" width="1" height="1" src="https://www10.a8.net/0.gif?a8mat=3B5GNT+B6H1PU+4EKC+5ZEMP" alt="">
            </div>

            <section>
              <a href="terms_of_use.php" style="text-decoration:none;"><p class="font">利用規約(2021/06/14更新) NEW!</p></a>
              <!-- <p class="font">&copy;Copyright 2020 ますみ/masumi. Rights of this site reserved.</p> -->
              <p class="font">&copy;Copyright 2020 masumikato. Rights of this site reserved.</p>
            </section>
          </footer>
          <div id="contentsBg" style="display: block;"></div>
        </div>
      </body>
      </html>
