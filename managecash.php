<?php
//Testing Mobile money incoming
    if(isset($_POST['deposit'])){ 
        $amount=$_POST['amount'];
        $phone=$_POST['phoneNumber'];

        $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code=substr(str_shuffle($set), 0, 12);
        $url= 'https://www.easypay.co.ug/api/'; 
        $payload = array( 
            'username' => '****************', 
            'password' => '****************', 
            'action' => 'mmdeposit', 
            'amount' => $amount, 
            'phone'=>$phone, 
            'currency'=>'UGX', 
            'reference'=>'BET_CO_'.$code,
            'reason'=>'Testing MM DEPOSIT' 
        ); 
        //open connection 
        $ch = curl_init(); 
        //set the url, number of POST vars, POST data 
        curl_setopt($ch,CURLOPT_URL, $url); 
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($payload)); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 400); //timeout in seconds 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //execute post 
        $result = curl_exec($ch); 
        //close connection 
        curl_close($ch); 
        $arr=json_decode($result);
        $ref=$arr->details->reference;
        $amount=$arr->details->amount;
        $number=$arr->details->phone;
        $phone= 0 . substr($number, 3);
        header('location: deposit.php?ref='.$ref.'&phne='.$phone.'&amount='.$amount);
    }
?> 
