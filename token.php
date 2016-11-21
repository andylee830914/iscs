<?php
        $domainname = "http://moodle.ncku.edu.tw";
        $where['username'] = $_POST['username'];
        $where['password'] = $_POST['password'];
        $where['service']  = 'ncku_moodle_app';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domainname.'/login/token.php');
        curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($where));
        $result=curl_exec($ch);
        curl_close($ch);
        print_r($result);
?>