<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>AZ-ONE株式会社｜お問合せ</title>
<meta name="keywords" content="エージーワン,AZ-ONE,マンション投資,マンション・アパート販売,首都圏,資産運用,不動産投資,節税">
<meta name="description" content="お問合せはこちらから。AZ-ONE（エージーワン）は住む人の心と生活を豊かにする、資産価値の高いマンション・アパートの販売事業を行っています。資産運用・資産形成をサポート致します。">
<meta property="og:title" content="AZ-ONE株式会社｜お問合せ">
<meta property="og:type" content="article">
<meta property="og:url" content="http://az-one.biz/contact/">
<meta property="og:image" content="http://az-one.biz/img/common/og_image.png">
<meta property="og:site_name" content="AZ-ONE株式会社｜住む人の心と生活を豊かにする資産価値の高いマンション・アパートの販売、資産運用・資産形成のサポート">
<meta property="og:description" content="お問合せはこちらから。住む人の心と生活を豊かにする、資産価値の高いマンション・アパートの販売事業を行っています。資産運用・資産形成をサポート致します。">
<meta name="twitter:card" content="summarylargeimage">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="canonical" href="https://az-one.biz/contact/" />
<link rel="shortcut icon" href="/img/common/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="/img/common/apple-touch-icon.png" />
<link href="https://fonts.googleapis.com/earlyaccess/notosansjp.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/earlyaccess/sawarabimincho.css" rel="stylesheet" />
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/common.css" rel="stylesheet" type="text/css">
<link href="../css/contact.css" rel="stylesheet" type="text/css">
<link href="../css/swiper.css" rel="stylesheet" type="text/css">
<link href="../css/fancybox.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.12.4.js" type="text/javascript"></script>
<script src="../js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="../js/tableHeadFixer.js" type="text/javascript"></script>
<script src="../js/swiper.min.js" type="text/javascript"></script>
<script src="../js/jquery.fancybox.js" type="text/javascript"></script>
<script src="../js/common.js" type="text/javascript"></script>
<script src="../js/ajaxzip3.js" charset="UTF-8"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125268458-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125268458-1');
</script>
<script async src="https://beacon.digima.com/v2/bootstrap/d0b-WENaR1ZFUFNXS3x2SnI0RktVQ2hlbkhZT1pXbHlHUA"></script><!--az-one.biz 用のトラッキングタグ_2020-03-24 -->
</head>
<body id="home">
<a name="pagetop" id="pagetop"></a>
<?php
include('../include/header.html');
?>
<div id="contents">
  <div id="breadnav">
    <ul>
      <li><a href="../">AZ-ONE（エージーワン） HOME</a></li>
      <li>お問合せ</li>
    </ul>
  </div>
  <article id="guideline">
  
  
 <!-- /* お問合せフォームひな型から */ -->
  
<div id="formWrap">
  <h3>お問い合わせ</h3>
  <form method="post" action="mail.php">
    <table class="formTable">
      <tr>
        <th>ご用件</th>
        <td><select name="ご用件">
          <option value="">選択してください</option>
          <option value="資料請求">資料請求</option>
          <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
        </select></td>
      </tr>
      <tr>
        <th>お名前</th>
        <td><input size="25" type="text" name="お名前" />
          ※必須</td>
      </tr>
      <tr>
        <th>電話番号（半角）</th>
        <td><input size="30" type="text" name="電話番号" /></td>
      </tr>
      <tr>
        <th>Mail（半角）</th>
        <td><input size="30" type="text" name="Email" />
          ※必須</td>
      </tr>
      <tr>
        <th>性別</th>
        <td><input type="radio" name="性別" value="男" />
          男　
          <input type="radio" name="性別" value="女" />
          女 </td>
      </tr>
      <!-- <tr>
        <th>サイトを知ったきっかけ</th>
        <td><input name="サイトを知ったきっかけ[]" type="checkbox" value="検索エンジン" /> 検索エンジン　
          <input name="サイトを知ったきっかけ[]" type="checkbox" value="友人・知人" /> 友人・知人</td>
      </tr> -->
       <tr>
         <th>ご住所<br class="sp"><span class="s">（資料請求される方は必ずご記入ください。）</span></th>
         <td><!-- ▼郵便番号入力フィールド(7桁) -->
         郵便番号（半角7桁）<br>
<input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"><br>
           <div class="mt5">ご住所<br>
<!-- ▼住所入力フィールド(都道府県+以降の住所) -->
             <input type="text" name="addr11" size="60" style="width: 100%;"></div></td>
      </tr>
       <tr>
        <th>お問い合わせ内容<br /></th>
        <td><textarea name="お問い合わせ内容" cols="60" rows="5" style="width: 100%;"></textarea></td>
      </tr>
    </table>
    <p class="textcenter mt10">
      <input type="submit" value="　 確認 　" />
      
      <input type="reset" value="リセット" />
    </p>
  </form>
 
  <p class="s mt10">※IPアドレスを記録しております。いたずらや嫌がらせ等はご遠慮ください</p>
</div>


 <!-- /* /お問合せフォームひな型から */ -->
  
 </article>
</div>
<!-- /contents -->

<?php
include('../include/footer.html');
?>

<div class="btn_pagetop"><a href="#pagetop" class="anchor">PAGE<br>TOP</a></div>
</body>
</html>