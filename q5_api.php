<?php
    header("content-type: text/html; charset=utf-8");
    // 1. 初始設定
    $ch = curl_init();

    // 2. 設定 要抓取資料的網址
    $url = "http://bm-dev.vir888.net/app/presenter.php/getBalance?username=phili";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);

    // 3. 執行，取回 response 結果
    $output = curl_exec($ch);

    // 4. 關閉與釋放資源
    curl_close($ch);
    echo $output;
