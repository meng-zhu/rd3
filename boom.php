<?php
    //題目10*10 40M

    /**
     *  產生地雷位置(40個)
     */
    for($i = 0; $i < 40; $i++)
    {
        $m = rand(0,99);
        for($j = 0; $j < count($boom); $j++)
        {
            if($boom[$j] == $m){
                $i--;
                continue 2;
            }
        }
        $boom[] = $m;
    }

    sort($boom);
    echo count($boom);
    echo "<br>";
    print_r($boom);


    //存陣列>轉字串

    /**
     *  建立原始陣列
     */
    for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
        {
            $place[$x][$y] = "?";
        }
    }

    /**
     * 把m塞到自己的位置
     */
    for($i = 0; $i < 40; $i++)
    {
        $temp = $boom[$i];
        // $final[$temp] = "M";
        $x = floor($temp/10);
        $y = $temp % 10;
        $place[$x][$y] = "M";
    }

    echo "<hr>";
    foreach($place as $key){
        foreach($key as $value)
        {
            echo $value." ";
        }
        echo "<br>";
    }

    for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
        {
            if($place[$x][$y] == "?")
            {
                $num = 0;
                //左上
                if($place[$x-1][$y-1] == "M")
                {
                    $num++;
                }
                //上
                if($place[$x-1][$y] == "M")
                {
                    $num++;
                }
                //右上
                if($place[$x-1][$y+1] == "M")
                {
                    $num++;
                }
                //左
                if($place[$x][$y-1] == "M")
                {
                    $num++;
                }
                //右
                if($place[$x][$y+1] == "M")
                {
                    $num++;
                }
                //左下
                if($place[$x+1][$y-1] == "M")
                {
                    $num++;
                }
                //下
                if($place[$x+1][$y] == "M")
                {
                    $num++;
                }
                //右下
                if($place[$x+1][$y+1] == "M")
                {
                    $num++;
                }
                $place[$x][$y] = $num;
            }
        }
    }

    echo "<hr>";
    foreach($place as $key){
        foreach($key as $value)
        {
            echo $value." ";
        }
        echo "<br>";
    }

   /**
    * 轉字串
    */
    for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
        {
            $final = $final.$place[$x][$y];
            if($y == 9)
            {
                if($x != 9){
                    $final = $final."N";
                }
            }
        }
    }

    echo "<hr>";
    echo $final;



