<?php
function insert_database($name,$value){
$DATABASE_URL="postgres://xtpebuciqqidsk:ab9ad7c2e18ad9855a6fc83c56617ad16d4e13afc1922a429d73473ce7beea86@ec2-54-83-61-142.compute-1.amazonaws.com:5432/dd6jn5opt3njof";
$url=parse_url(getenv(DATABASE_URL));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

$stmt = $pdo -> prepare("INSERT INTO テーブル名 (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':value', $value, PDO::PARAM_INT);
$stmt->execute();
}
?>
