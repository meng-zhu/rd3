<?php
    //題目10*10 40M

    /**
    *  建立原始陣列(1維)
    */
    for($x = 0; $x < 100; $x++){
        if($x < 40)
        {
            $temp[] = "M";
        }else{
            $temp[] = "?";
        }
    }
    //將陣列打亂
    shuffle($temp);
    for($i = 0; $i < 100 ; $i++)
    {
        $x = floor($i/10);
        $y = $i % 10;
        $place[$x][$y] = $temp[$i];
    }
    for($x = 0; $x < 10; $x++){
        for($y = 0; $y < 10; $y++)
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

    echo $final;



