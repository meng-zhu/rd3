<?php
    header("Content-Type:text/html; charset=utf-8");
    $time1 = microtime(true);

    $map = $_GET['map'];
    // echo "題目(10*10踩地雷)<br>";
    // echo $map;
    // echo "<hr>";

    $showInfo = "符合。";

    /*確認字串長度是否為109*/
    $len = strlen($map);
    if($len != 109)
    {
        $showInfo = "不符合，因為字符數量不正確，您輸入了".$len."個字符。";
        echo $showInfo;
        exit;
    }

    /*確認炸彈數量是否為40*/
    $numBoom = substr_count($map, 'M');
    if($numBoom != 40)
    {
        $showInfo = "不符合，因為炸彈數量不正確，您設置了".$numBoom."個炸彈。";
        echo $showInfo;
        exit;
    }

    /*確認換行數量是否為9*/
    $numN = substr_count($map, 'N');
    if($numN != 9)
    {
        $showInfo = "不符合，因為換行數量不正確，您共換了".$numN."行。";
        echo $showInfo;
        exit;
    }

    /*確認換行的位置是否正確*/

    /*用N來切割字串(1維)*/
    $temp = split ('N', $map);

    for($i = 0; $i < count($temp); $i++)
    {
        $num = strlen($temp[$i]);
        if($num != 10)
        {
            $showInfo = "不符合，因為N擺放的位置不正確";
            echo $showInfo;
            exit;
        }
    }



    /*1維 > 字串 > 2維*/
    for($i = 0;$i < count($temp); $i++)
    {
        $tempStr = $tempStr.$temp[$i];
    }
    //每個英文字母都切開
    $tempArray1 = preg_split('//', $tempStr, -1, PREG_SPLIT_NO_EMPTY);
    for($i = 0; $i < count($tempArray1) ; $i++)
    {
        $x = floor($i/10);
        $y = $i % 10;
        $place[$x][$y] = $tempArray1[$i];
    }

     for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
        {
            if($place[$x][$y] !== "M")
            {
                /*取得值*/
                $check = $place[$x][$y];

                $num = 0;

                //左上
                if($place[$x-1][$y-1] === "M")
                {
                    $num++;
                }
                //上
                if($place[$x-1][$y] === "M")
                {
                    $num++;
                }
                //右上
                if($place[$x-1][$y+1] === "M")
                {
                    $num++;
                }
                //左
                if($place[$x][$y-1] === "M")
                {
                    $num++;
                }
                //右
                if($place[$x][$y+1] === "M")
                {
                    $num++;
                }
                //左下
                if($place[$x+1][$y-1] === "M")
                {
                    $num++;
                }
                //下
                if($place[$x+1][$y] === "M")
                {
                    $num++;
                }
                //右下
                if($place[$x+1][$y+1] === "M")
                {
                    $num++;
                }

                if( $check != $num)
                {
                    $place[$x][$y] = "x";
                    $showInfo = "不符合，因為值輸入錯誤，x為錯誤部分";
                    // $showInfo = "不符合，因為值輸入錯誤，紅色為錯誤的部分";
                }
            }
        }
    }
    /**
     * 轉字串
     */
    for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
        {
            $final = $final.$place[$x][$y];
            if($y === 9)
            {
                if($x != 9){
                    $final = $final."N";
                }
            }
        }
    }

    echo $showInfo;

    if($showInfo != "符合。")
    {
        echo $final;

        // echo "<hr>為觀看方便：<br>";
        // foreach($place as $key){
        //     foreach($key as $value)
        //     {
        //         echo $value." ";
        //     }
        //     echo "<br>";
        // }
    }

    $time2 = microtime(true);
    // echo "<hr>執行時間<br>";
    // echo $time2-$time1;