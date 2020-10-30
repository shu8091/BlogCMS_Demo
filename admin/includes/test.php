<?php
$amount = 10000;
$year = 1;
$rate = 0.12;


do {
    
    $interest = $amount * $rate;
    $amount += $interest;
    $year++;

} while ($amount < 20000);

echo "第" . $year . "年" . $amount . "元<br>";
?>

<?php
$level = 1;

while($level <= 10){
    $level++;
}

print $level . "<br>";
?>

<?php
$level = 1;

do{ $level++; }while( $level <= 10 );

print $level . "<br>";
?>

<?php
$total = 0;
for( $i=9; $i<=12; $i++){
    $total += $i;
}
print $total . "<br>";
?>

<?php
$sale = 0.85;
$total = 0;
$buy = 1200;

if($buy >= 1000){
    $total = $buy * $sale;
    print "消費金額為: " . $total . "<br>";
} else {
    $total = $buy;
    print "消費金額為: " . $total . "<br>";
}

?>

<?php
$height = 123;

if($height > 120){
    print "全票";
}elseif($height > 110){
    print "半票";
}else{
    print "免費";
}

echo "<br>";

$h = 120;
switch($h){
    case $h <= 110: 
        print "免費";
        break;

    case $h <= 120:
        print "半票";
        break;
    
    case $h > 120:
        print "全票";
        break;
}
echo "<br>";
?>

<?php
for ($i=4; $i <= 100 ; $i++) { 
    if($i % 4 == 0){
        print $i . "<br>";
    }
}


$arr = [1,2,3,4,5,6,7,8,9,10];

for( $i=0; $i<count($arr); $i++){
    echo "$i => $arr[$i]<br>";
}

$total = 0;
foreach($arr as $ele){
    echo $ele . "<br>";
    $total += $ele;
}
echo $total . "<br>";

$grades=[95,85,76,56];
$sum = 0;
$avg = 0;
foreach($grades as $ele){
    $sum += $ele;
    $avg = $sum/4;
}

echo "總分: " . $sum . "平均: " . $avg . "<br>";



$grades2=["alien" => 80,"bob" => 78,"cindy" => 98,"marie" => 32];

$sum2 = 0;
$avg2 = 0;
while(list($key,$val) = each($grades2)){
    echo "$key = $val" . "<br>";
    $sum2 += $val;
    $avg2 = $sum2 / 4;
}

echo "總分: " . $sum2 . "平均: " . $avg2 . "<br>";
?>