<?php

// ----------基本設定開始---------- //

// 送信先メールアドレス
$adminMail = "recruit@azest-gr.co.jp";


// 送信先メールアドレスを配列化(編集しないでください)
$adminArray = array();
$adminArray = explode(',', $adminMail);


// 送信者名
$adminName = "AZEST-GROUP　採用担当";


// 送信後に戻るURL
$returnUrl = "https://www.azest-gr.co.jp/";


// 送信完了メッセージ
$completionMessage = <<<EOD
送信が完了しました。
ありがとうございます。
EOD
;

// リターンメールのメールタイトル
$returnMailTitle = "プロフィール・画像送信を受け付けました。";

// リターンメールのヘッダーメッセージ
$returnMailHeader = <<<EOD
プロフィール・画像の送信、ありがとうございました。

尚、ご不明点等がございましたら、「{$adminArray[0]}」まで
お問い合わせくださいますようお願いいたします。

AZEST-GROUP　採用担当

EOD
;


// リターンメールのフッターメッセージ
$returnMailFooter = <<<EOD

送信ありがとうございます。

EOD
;

// ----------基本設定終了---------- //


// ----------添付ファイル設定開始---------- //

// 拡張子制限（0=しない・1=する）
$ext_denied = 1;
// 許可する拡張子リスト
$ext_allow1 = "jpg";
$ext_allow2 = "jpeg";
$ext_allow3 = "gif";
$ext_allow4 = "png";
// 配列に格納しておく
$EXT_ALLOWS = array($ext_allow1, $ext_allow2, $ext_allow3, $ext_allow4);

// アップロード容量制限（0=しない・1=する）
$maxmemory = 1;
// 最大容量（KB）
$max = 51200;

// ----------添付ファイル設定終了---------- //


// ----------ここから下は変更不要---------- //

require_once(__DIR__ . "/../lib/functions.php");
require_once(__DIR__ . "/autoload.php");

session_start();
