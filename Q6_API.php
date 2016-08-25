<?php
    header("Content-Type:text/html; charset=utf-8");

    /*
        GET
        https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=API名稱&參數=值
    */
    $act = $_GET['action'];
    $api = new api();
    $api->$act();

    class api {

        public $db;

        /**
         * 建立資料庫連線
         */
        public function __construct()
        {
            $dbConnect = 'mysql:host=localhost;dbname=testAPI;port=3306';
            $dbUser = 'root';
            $dbPw = '';

            // 連接資料庫伺服器
            $this->db = new PDO($dbConnect, $dbUser, $dbPw);
            $this->db->exec("set names utf8");
        }

        /**
         * 關閉資料庫連線
         */
        public function __destruct()
        {
            $this->db = null;
        }

        /**
         * 建立帳號
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=addUser&username=abo
         */
        public function addUser()
        {
            $username = $_GET['username'];

            if($username == ""){
                $showInfo = array(
                    "result" => "false",
                    "message" =>"參數少給了唷~~"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }
            $sql = 'SELECT * FROM `user` WHERE `account` =:username';
            $result = $this->db->prepare($sql);
            $result->bindParam('username', $username);
            $result->execute();
            $row = $result->fetchAll();
            if (!count($row)) {
                $sql = 'INSERT INTO `user`(`account`) VALUES (:username)';
                $result = $this->db->prepare($sql);
                $result->bindParam('username', $username);
                $result->execute();
                $showInfo = array(
                    "result" => "true",
                    "message" =>"成功註冊"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }

            $showInfo = array(
                "result" => "false",
                "message" =>"此帳號已有人註冊過"
            );
            echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
            exit;
        }

        /**
         * 取得餘額
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=getBalance&username=abo
         */
        public function getBalance()
        {
            $username = $_GET['username'];

            if ($username == "") {
                $showInfo = array(
                    "result" => "false",
                    "message" =>"參數少給了唷~~"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }

            $sql = 'SELECT * FROM `user` WHERE `account` =:username';
            $result = $this->db->prepare($sql);
            $result->bindParam('username', $username);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetchAll();
            if (!count($row)) {
                $showInfo = array(
                    "result" => "false",
                    "message" =>"無此帳號"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }
            $showInfo = array(
                "result" => "true",
                "message" =>'餘額:'.$row[0]['balance']
            );
            echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);

        }

        /**
         * 轉帳
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=transfer&username=abo&transferId=1&type=OUT&money=1000
         */
        public function transfer()
        {
            $username = $_GET['username'];
            $transferId = $_GET['transferId'];
            $type = $_GET['type'];
            $type = strtoupper($type);
            $money = $_GET['money'];

            if ($username == "" || $transferId == "" || $money == "" ||  $type == "")
            {
                $showInfo = array(
                    "result" => "false",
                    "message" =>"參數少給了唷~~"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }
            if ($type == "IN" || $type == "OUT"){

                //確認帳號有沒有打錯
                $sql = 'SELECT * FROM `user` WHERE `account` =:username';
                $result = $this->db->prepare($sql);
                $result->bindParam('username', $username);
                $result->execute();
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $row = $result->fetchAll();

                if (!count($row)) {
                    $showInfo = array(
                        "result" => "false",
                        "message" =>"無此帳號"
                    );
                    echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                    exit;
                }

                //確認金額是否輸入正確
                if (!preg_match("/^([0-9]+)$/", $money) || $money < 0)
                {
                    $showInfo = array(
                        "result" => "false",
                        "message" =>"金額僅能輸入0-9且不得為負數"
                    );
                    echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                    exit;
                }

                if($type == "OUT"){
                    $balance = $row[0]['balance'];

                    $check = $balance - $money;
                    if($check < 0){
                        $showInfo = array(
                            "result" => "false",
                            "message" =>"餘額不足，無法出款"
                        );
                        echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                }

                $sql = 'SELECT * FROM `detail` WHERE `transferId` = :transferId AND `account` = :username';
                $result = $this->db->prepare($sql);
                $result->bindParam('transferId', $transferId);
                $result->bindParam('username', $username);
                $result->execute();
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $row = $result->fetchAll();

                if (!count($row)) {
                    $sql = 'INSERT INTO `detail`(`transferId`, `type`, `money`, `account`) VALUES (:transferId,:type,:money,:username)';
                    $result = $this->db->prepare($sql);
                    $result->bindParam('transferId', $transferId);
                    $result->bindParam('username', $username);
                    $result->bindParam('type', $type);
                    $result->bindParam('money', $money);
                    $result->execute();

                    //取得影響筆數
                    if (!$result->rowCount()) {
                        $showInfo = array(
                            "result" => "false",
                            "message" =>"轉帳失敗"
                        );
                        echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                        exit;
                    }

                    if ($type == "OUT")
                    {
                        $money = '-'.$money;
                    }
                    $sql = 'UPDATE `user` SET `balance`=`balance` + :money WHERE `account` = :username';
                    $result = $this->db->prepare($sql);
                    $result->bindParam('username', $username);
                    $result->bindParam('money', $money);
                    $result->execute();

                    $showInfo = array(
                        "result" => "true",
                        "message" =>"轉帳成功"
                    );
                    echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                    exit;
                }
                $showInfo = array(
                    "result" => "false",
                    "message" =>"此序號已被使用過"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;

            }
            $showInfo = array(
                "result" => "false",
                "message" =>"type只能輸入IN 或 OUT"
            );
            echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
            exit;
        }

        /**
         * 轉帳確認
         * https://missing-meng-zhu.c9users.io/rd3/Q6_API.php?action=checkTransfer&username=abo&transferId=1
         */
        public function checkTransfer()
        {
            $username = $_GET['username'];
            $transferId = $_GET['transferId'];

            if ($username == "" || $transferId == "")
            {
                $showInfo = array(
                    "result" => "false",
                    "message" =>"參數少給了唷~~"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }
            $sql = 'SELECT * FROM `detail` WHERE `transferId` = :transferId AND `account` = :username';
            $result = $this->db->prepare($sql);
            $result->bindParam('transferId', $transferId);
            $result->bindParam('username', $username);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetchAll();

            if (!count($row)) {
                $showInfo = array(
                    "result" => "false",
                    "message" =>"無此轉帳紀錄"
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }
            foreach ($row as $key)
            {
                $showInfo = array(
                    "result" => "true",
                    "message" =>'轉帳紀錄-轉帳序號： '.$key['transferId'].'，操作項目: '.$key['type'].'，金額: '.$key['money']
                );
                echo json_encode($showInfo, JSON_UNESCAPED_UNICODE);
                exit;
            }

        }
    }

