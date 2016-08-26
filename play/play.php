<?php
    //題目10*10 40M

    /**
    *  建立原始陣列(1維)
    */
    for($x = 0; $x < 100; $x++){
        if($x < 3)
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
?>
<html>
    <head>
        <style type="text/css">
            .myButton {
            	-moz-box-shadow:inset 1px -9px 27px -6px #d5e6a8;
            	-webkit-box-shadow:inset 1px -9px 27px -6px #d5e6a8;
            	box-shadow:inset 1px -9px 27px -6px #d5e6a8;
            	background-color:transparent;
            	-moz-border-radius:14px;
            	-webkit-border-radius:14px;
            	border-radius:14px;
            	border:1px solid #b2b8ad;
            	display:inline-block;
            	cursor:pointer;
            	color:#757d6f;
            	font-family:Impact;
            	font-size:27px;
            	font-weight:bold;
            	padding:10px 76px;
            	text-decoration:none;
            	text-shadow:-4px 1px 4px #ced9bf;
            }
            .myButton:hover {
            	background-color:transparent;
            }
            .myButton:active {
            	position:relative;
            	top:1px;
            }

        </style>

        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jquery.blockUI.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                //將原本右鍵選單關閉
                document.oncontextmenu = function() {return false;};
            });

            function show(xy){
                //判斷使用左/右鍵
                $("#td_"+xy).mousedown(function(event){
                switch (event.which) {
                    //左鍵-開啟
                    case 1:
                        var value = $("#place_"+xy).text();
                        if(value != "F")
                        {
                            var value = $("#place_"+xy).text();
                            document.getElementById('place_'+xy).style.visibility='visible';
                            check0(xy);

                            if(value == "M")
                            {
                                alert("哈哈哈，我是炸彈唷~");
                                //把為F的地方塞進正確答案


                                var all = document.getElementsByTagName("span");
                                for(var i = 0; i < all.length; i++){
                                    all[i].style.visibility='visible';
                                }
                                $("#boom").block({ message: null });

                            }
                        }
                        break;
                    //右鍵-插旗
                    case 3:
                        if($("#place_"+xy).css("visibility")=="hidden")
                        {
                            var value = $("#place_"+xy).text();
                            $("#place_"+xy).text("F");
                            document.getElementById('place_'+xy).style.visibility='visible';


                        } else {
                            var value = $("#place_"+xy).text();
                            if(value == "F")
                            {
                                document.getElementById('place_'+xy).style.visibility='hidden';
                                var trueValue = $("#trueValue_"+xy).val();
                                $("#place_"+xy).text(trueValue);
                            }
                        }
                        break;
                    //中鍵-來亂的
                    default:
                        alert('無效操作唷~');
                    }
                });
            }
            function check0(xy)
            {
                var value = $("#place_"+xy).text();
                if(value == "0")
                {
                    open(xy);
                }
            }
            function open(xy){
                var temp = xy.split("");
                var x = Number(temp[0]);
                var y = Number(temp[1]);
                //上
                var u = x - 1;
                //左
                var l = y - 1;
                //下
                var d = x + 1;
                //右
                var r = y + 1;


                if( u >= 0 )
                {
                    //上
                    var open = u + "" + y;
                    document.getElementById('place_'+open).style.visibility='visible';
                    check0(open);
                    if( l >= 0 )
                    {
                        //左上
                        open = u + "" + l;
                        document.getElementById('place_'+open).style.visibility='visible';
                        check0(open);
                    }
                    if( r < 10 )
                    {
                        //右上
                        open = u + "" + r;
                        document.getElementById('place_'+open).style.visibility='visible';
                        check0(open);
                    }
                }
                if ( d < 10 )
                {
                    //下
                    var open = d + "" + y;
                    document.getElementById('place_'+open).style.visibility='visible';
                    // check0(open);
                    if( l >= 0 )
                    {
                        //左下
                        open = d + "" + l;
                        document.getElementById('place_'+open).style.visibility='visible';
                        // check0(open);
                    }
                    if ( r < 10)
                    {
                        //右下
                        open = d + "" + r;
                        document.getElementById('place_'+open).style.visibility='visible';
                        // check0(open);

                    }
                }
                if ( l >= 0 )
                {
                    //左
                    var open = x + "" + l;
                    document.getElementById('place_'+open).style.visibility='visible';
                    // check0(open);
                }
                if ( r < 10 )
                {
                    //右
                    var open = x + "" + r;
                    document.getElementById('place_'+open).style.visibility='visible';
                    // check0(open);
                }
            }
        </script>

        <meta charset="utf-8">
        <title>
            踩地雷遊戲
        </title>
    </head>
    <body>
        <table id="boom" style='border:2px #FFAC55 dashed;padding:5px;' rules='all' cellpadding='30' align='center';>
        <?php for ($x = 0 ; $x < count($place) ; $x++) {    ?>
            <tr>
        <?php for ($y = 0 ; $y < count($place[0]) ; $y++) {    ?>
                <td vertical-align:middle onmousedown= show('<?php echo $x.$y;?>'); id='td_<?php echo $x.$y;?>'>
                    <input type="hidden" id='trueValue_<?php echo $x.$y;?>' value='<?php echo $place[$x][$y];?>'/>
                    <span style=visibility:hidden id='place_<?php echo $x.$y;?>'><?php echo $place[$x][$y];?></span>
                </td>
        <?php }    ?>
            </tr>
        <?php }    ?>
      </table>
    <center><p class="myButton" onclick=window.location.reload()>另啟新局</p></center>
    </body>
</html>
