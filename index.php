<?php

function get_client_ip() {
    if (array_key_exists("HTTP_X_FORWARDED_FOR", $_SERVER)) {
        return  $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (array_key_exists("REMOTE_ADDR", $_SERVER)) {
        return $_SERVER["REMOTE_ADDR"];
    } else if (array_key_exists("HTTP_CLIENT_IP", $_SERVER)) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
  
    return '';
}

$pdo = new PDO("sqlite:database.db");
$stmt = $pdo->prepare("INSERT INTO user_data (user_agent, ip_address, forwarded, date, referrer, language, device_type, browser_version, operating_system) VALUES (:user_agent, :ip_address, :forwarded, :date, :referrer, :language, :device_type, :browser_version, :operating_system)");

$user_agent = $_SERVER["HTTP_USER_AGENT"];
$ip_address = $_SERVER["REMOTE_ADDR"];
$client_ip_address = isset($_SERVER["HTTP_CLIENT_IP"]) ? $_SERVER["HTTP_CLIENT_IP"] : "";
$forwarded = get_client_ip();
$date = date("Y-m-d H:i:s");

$referrer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null;
$language = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? $_SERVER["HTTP_ACCEPT_LANGUAGE"] : null;
$device_type = isset($_SERVER["HTTP_DEVICE_TYPE"]) ? $_SERVER["HTTP_DEVICE_TYPE"] : null;
$browser_version = isset($_SERVER["HTTP_BROWSER_VERSION"]) ? $_SERVER["HTTP_BROWSER_VERSION"] : null;
$operating_system = isset($_SERVER["HTTP_OPERATING_SYSTEM"]) ? $_SERVER["HTTP_OPERATING_SYSTEM"] : null;

$stmt->bindValue(":user_agent", $user_agent);
$stmt->bindValue(":ip_address", $ip_address);
$stmt->bindValue(":forwarded", $forwarded);
$stmt->bindValue(":date", $date);
$stmt->bindValue(":referrer", $referrer);
$stmt->bindValue(":language", $language);
$stmt->bindValue(":device_type", $device_type);
$stmt->bindValue(":browser_version", $browser_version);
$stmt->bindValue(":operating_system", $operating_system);

$stmt->execute();

$image = file_get_contents(getenv("FAKE_IMAGE") ?? "https://www.zooplus.be/magazine/wp-content/uploads/2019/06/comprendre-le-langage-des-chats.jpg");

header("Content-type: image/jpeg;");
header("Content-Length: " . strlen($image));
echo $image;
exit;

?>