<?php
error_reporting(0);

if(!isset($_POST['text']) || empty($_POST['text'])){
    echo "No text received";
    exit;
}

$text = $_POST['text'];
$lang = $_POST['lang'];

$data = [
    "q" => $text,
    "source" => "auto",
    "target" => $lang,
    "format" => "text"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://translate.argosopentech.com/translate");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/x-www-form-urlencoded"
]);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if($err){
    echo "Translation server error";
    exit;
}

$result = json_decode($response, true);

if(isset($result['translatedText'])){
    echo $result['translatedText'];
}else{
    echo "Translation failed";
}
?>
