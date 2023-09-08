<?php
  require_once(__DIR__ . '/Monaka/config/config.php');
  $form = new Monaka\Form();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>入社式用プロフィール・画像送信用フォーム</title>
  <link rel="stylesheet" href="Monaka/css/reset.css">
  <link rel="stylesheet" href="Monaka/css/common.css">
  <link rel="stylesheet" href="Monaka/css/mailform.css">
  <link rel="shortcut icon" href="/img/common/favicon.ico">
</head>

<body>

<div class="container">

  <h1><span style="display: inline-block;">AZEST-GROUP 入社式用</span><span style="display: inline-block;">プロフィール</span></h1>

  <div class="mailform">
    <?php $form->create(); ?>
      <dl>
        <dt>お名前</dt>
        <dd>
          <?php $form->inputName("お名前"); ?>
        </dd>
      </dl>
      <dl>
      <dt>大学・学部名</dt>
      <dd>
        <?php $form->inputText("大学・学部名", "必須"); ?>
      </dd>
    </dl>
    <dl>
      <dt>学生時代に取り組んだ事</dt>
      <dd>
        <?php $form->inputText("学生時代に取り組んだ事", "必須"); ?>
      </dd>
    </dl>
    <dl>
      <dt>性格</dt>
      <dd>
        <?php $form->inputText("性格", "必須"); ?>
      </dd>
    </dl>
    <dl>
      <dt>趣味</dt>
      <dd>
        <?php $form->inputText("趣味", "必須"); ?>
      </dd>
    </dl>
    <dl>
      <dt>熱中してる事・マイブーム</dt>
      <dd>
        <?php $form->inputText("熱中してる事・マイブーム", "必須"); ?>
      </dd>
    </dl>
     <dl>
        <dt>メールアドレス</dt>
        <dd>
          <?php $form->inputMail("メールアドレス"); ?>
        </dd>
      </dl>
      <dl>
        <dt>メールアドレス確認</dt>
        <dd>
          <?php $form->inputMailCheck("メールアドレス確認"); ?>
        </dd>
      </dl>
      <dl>
        <dt style="border-bottom: solid 1px #ccc;">画像ファイル添付</dt>
        <dd style="border-bottom: solid 1px #ccc;">
          <div style="margin-bottom: 10px;">容量50MB以下のjpeg、gif、pngファイルが送付できます。</div>
			<div>1.証明用写真</div>
          <?php $form->inputFile("1.証明用写真", "必須"); ?>
			<div style="margin-top: 10px;">2.プライベート写真</div>
          <?php $form->inputFile("2.プライベート写真", "必須"); ?>
        </dd>
      </dl>
    <?php $form->end('確認する'); ?>
  </div>

</div>

</body>
</html>
