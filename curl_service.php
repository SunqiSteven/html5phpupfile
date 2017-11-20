<?php
 function curl_service($url,$method,$body=null){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
        if (strtolower($method) == 'post') {
            curl_setopt($curl,CURLOPT_POST,true); // post传输数据
            curl_setopt($curl,CURLOPT_POSTFIELDS,$body);// post传输数据        
        }
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;
    }

