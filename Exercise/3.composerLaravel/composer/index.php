<?php
// 引入自动加载的文件
// include './vendor/autoload.php';
require './vendor/autoload.php';


// 初级版**************************************************
// use Endroid\QrCode\QrCode;

// $qrCode = new QrCode('老龚爱你们哦');

// header('Content-Type: ' . $qrCode->getContentType());
// echo $qrCode->writeString();





// 高级版 加了中间的图片logo 和下面的文字**********************************
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

// Create a basic QR code
$qrCode = new QrCode('老龚爱你们');
$qrCode->setSize(300);

// Set advanced options
$qrCode->setWriterByName('png');
$qrCode->setMargin(10);
$qrCode->setEncoding('UTF-8');
$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
$qrCode->setLabel('龚烁宇的二维码', 16, __DIR__ . './vendor/endroid/qr-code/assets/fonts/noto_sans.otf', LabelAlignment::CENTER());
$qrCode->setLogoPath(__DIR__ . './vendor/endroid/qr-code/assets/images/gsy.png');
$qrCode->setLogoWidth(100);
$qrCode->setRoundBlockSize(true);
$qrCode->setValidateResult(false);
// $qrCode->setWriterOptions(['exclude_xml_declaration' => true]);

// Directly output the QR code
header('Content-Type: ' . $qrCode->getContentType());
echo $qrCode->writeString();
// Save it to a file
$qrCode->writeFile(__DIR__ . '/qrcode.png');

// Create a response object
$response = new QrCodeResponse($qrCode);


// 使用curl类文件，进行请求发送
//实例化
// $curl = new \xiaohigh\Curl;

// //发送get请求
// $res = $curl->get('http://www.itxdl.cn');
// //发送post请求
// // $res = $curl->post('http://www.xiaohigh.com', []);

// echo $res;



// 验证码包
// use Gregwar\Captcha\CaptchaBuilder;

// $builder = new CaptchaBuilder;
// $builder->build();
// header('Content-type: image/jpeg');
// $builder->output();
// $_SESSION['phrase'] = $builder->getPhrase();
// // var_dump($_SESSION['phrase']);



// 简单的分词功能
//实例化对象
$obj = new \xiaohigh\Pscws4\Pscws4;

//调用实现分词功能
$res = $obj->run('gsy', 10);

//打印结果
var_dump($res);
?>

