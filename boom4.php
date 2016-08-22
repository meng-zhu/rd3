<?php
    $time1 = microtime(true);
    //題目10*10 40M

    /**
    *  建立原始陣列(1維)
    */
    for($x = 0; $x < 3000; $x++){
        if($x < 1200)
        {
            $temp[] = "M";
        }else{
            $temp[] = "?";
        }
    }
    //將陣列打亂
    shuffle($temp);
    for($i = 0; $i < 3000 ; $i++)
    {
        $x = floor($i/60);
        $y = $i % 60;
        $place[$x][$y] = $temp[$i];
    }

    // foreach($place as $key)
    // {
    //     foreach($key as $value){
    //         echo $value;
    //     }echo "<br>";
    // }


    for($x = 0; $x < 50; $x++){
        for($y = 0; $y < 60; $y++)
        {
            if($place[$x][$y] === "?")
            {
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

                $place[$x][$y] = $num;
            }
        }
    }

    // echo "<hr>";
    // foreach($place as $key){
    //     foreach($key as $value)
    //     {
    //         echo $value." ";
    //     }
    //     echo "<br>";
    // }

  /**
    * 轉字串
    */
    for($x = 0; $x < 50; $x++){
        for($y = 0; $y < 60; $y++)
        {
            $final = $final.$place[$x][$y];
            if($y === 59)
            {
                if($x != 49){
                    $final = $final."N";
                }
            }
        }
    }

    // echo "<hr>";
    echo $final;
    $time2 = microtime(true);
    // echo "<hr>";
    // echo $time2-$time1;


