<?php
    // $ch = curl_init();

    $website = 'EsBall';
    $username = 'abo4175';
    $uppername = 'dnnatest1';

    $method = 'PlayGame';
    $keyB = 'YJ97c0d2';
    // $remitno = '8290';

    $val = $website.$username.$keyB."20160824";
    $b = md5($val);
    $key = '123'.$b.'1';
    // echo $b;
    // $url = "http://bm.vir999.com/app/WebService/JSON/display.php/$method?website=$website&username=$username&uppername=$uppername&remitno=$remitno&action=IN&remit=1000000&key=$key";
    $url = "http://bm.vir999.com/app/WebService/JSON/display.php/$method?website=$website&username=$username&gametype=5115&key=$key";

    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回原生的（Raw）输出
    // curl_setopt($ch, CURLOPT_HEADER, 0);//启用时会将头文件的信息作为数据流输出,default 0
    // curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10000);

    // 3. 執行，取回 response 結果
    // $output = curl_exec($ch);

    // // 4. 關閉與釋放資源
    // curl_close($ch);
    // // echo $output;

    // echo $output;
    echo $url;

    /*
    建立帳號:
    http://bm.vir999.com/app/WebService/JSON/display.php/CreateMember?website=EsBall&username=abo4175&uppername=dnnatest1&key=004a2fe3a208c7c7121289ed4775a8ece61234567
    登入:
    http://bm.vir999.com/app/WebService/JSON/display.php/Login2?website=EsBall&username=abo4175&uppername=dnnatest1&key=04ed107a634cb2d0f58a2a5850a89e2ea1234567
    轉帳(存入額度):
    http://bm.vir999.com/app/WebService/JSON/display.php/Transfer?website=EsBall&username=abo4175&uppername=dnnatest1&remitno=30000&action=IN&remit=3000000&key=00000252e4cceee062db3a22f3069626b229912
    查詢轉帳是否成功:
    http://bm.vir999.com/app/WebService/JSON/display.php/CheckTransfer?website=EsBall&transid=4175&key=00003d3eb99408817979035fa2bd2bc042e412
    查詢餘額:
    http://bm.vir999.com/app/WebService/JSON/display.php/CheckUsrBalance?website=EsBall&username=abo4175&uppername=dnnatest1&key=0000000ce85629edb0d8caf26d46e419c71fae612345
    遊戲:
    http://bm.vir999.com/app/WebService/JSON/display.php/PlayGame?website=EsBall&username=abo4175&gametype=5065&key=000c385dd5689a33fc532ba0944361054561
    下注紀錄:
    http://bm.vir999.com/app/WebService/JSON/display.php/BetRecord?website=EsBall&username=abo4175&uppername=dnnatest1&rounddate=2016-08-24&gamekind=5&key=12345672bb77ae4d82c83d7ac94cc383a99786012345
    */