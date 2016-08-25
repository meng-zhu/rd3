<?php
    header("Content-Type:text/html; charset=utf-8");

    /*
        GET
        https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=API名稱&參數=值
    */
    $act = $_GET['apiname'];
    $manual = new manual();
    $manual->$act();

    class manual {


        /**
         * 建立帳號
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=addUser&username=abo
         */
        public function addUser()
        {
            echo '<center><h1>建立帳號<br>addUser Method<h1><center><hr>';
            echo "<table  style='border:3px #FFAC55 dashed;padding:5px;' rules='all' cellpadding='5' align='center';>
                    <tr>
                        <td>參數名稱</td>
                        <td>說明</td>
                    </tr>
                    <tr>
                        <td>
                            username
                        </td>
                        <td>
                            為使用者帳號，只能輸入10碼的值
                        </td>
                  </table><hr>";
            echo '<h4>輸出結果：<br> {"result":"false or true","message":"訊息"}</h4>';
        }

        /**
         * 取得餘額
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=getBalance&username=abo
         */
        public function getBalance()
        {
            echo '<center><h1>取得餘額<br>getBalance Method<h1><center><hr>';
            echo "<table  style='border:3px #FFAC55 dashed;padding:5px;' rules='all' cellpadding='5' align='center';>
                    <tr>
                        <td>參數名稱</td>
                        <td>說明</td>
                    </tr>
                    <tr>
                        <td>
                            username
                        </td>
                        <td>
                            為使用者帳號，只能輸入10碼的值
                        </td>
                  </table><hr>";
            echo '<h4>輸出結果：<br> {"result":"false or true","message":"訊息"}</h4>';
        }

        /**
         * 轉帳
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=transfer&username=abo&transferId=1&type=OUT&money=1000
         */
        public function transfer()
        {
            echo '<center><h1>轉帳<br>transfer Method<h1><center><hr>';
            echo "<table  style='border:3px #FFAC55 dashed;padding:5px;' rules='all' cellpadding='5' align='center';>
                    <tr>
                        <td>參數名稱</td>
                        <td>說明</td>
                    </tr>
                    <tr>
                        <td>
                            username
                        </td>
                        <td>
                            為使用者帳號，只能輸入10碼的值
                        </td>
                    <tr>
                        <td>
                            transferId
                        </td>
                        <td>
                            為轉帳序號，請輸入數字
                        </td>
                    </tr>
                    <tr>
                        <td>
                            type
                        </td>
                        <td>
                            為操作項目，請輸入IN 或 OUT
                        </td>
                    </tr>
                    <tr>
                        <td>
                            money
                        </td>
                        <td>
                            為轉帳金額，請輸入數字，且不得為負數
                        </td>
                    </tr>
                  </table><hr>";
            echo '<h4>輸出結果：<br> {"result":"false or true","message":"訊息"}</h4>';
        }

        /**
         * 轉帳確認
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=checkTransfer&username=abo&transferId=1
         */
        public function checkTransfer()
        {
            echo '<center><h1>轉帳確認<br>checkTransfer Method<h1><center><hr>';
            echo "<table  style='border:3px #FFAC55 dashed;padding:5px;' rules='all' cellpadding='5' align='center';>
                    <tr>
                        <td>參數名稱</td>
                        <td>說明</td>
                    </tr>
                    <tr>
                        <td>
                            username
                        </td>
                        <td>
                            為使用者帳號，只能輸入10碼的值
                        </td>
                    <tr>
                        <td>
                            transferId
                        </td>
                        <td>
                            為轉帳序號，請輸入數字
                        </td>
                    </tr>
                  </table><hr>";
            echo '<h4>輸出結果：<br> {"result":"false or true","message":"訊息"}</h4>';
        }
    }

