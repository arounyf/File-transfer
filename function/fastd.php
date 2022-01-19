<?php

require "../config/api.php";

//下载文件
if(!file_exists("../upload/$str")){ 
    echo('<script>alert("文件不存在");top.location="../index.php";</script>'); //即使创建，仍有可能失败 
}else{
	//读取最近下载的时间，做个限制，防止恶意盗刷流量
    $file_path = "../config/flag";
    $fp = fopen($file_path,"r");
    $str = fread($fp,filesize($file_path));
    fclose($fp);
    $startdate = $str;
    // echo $startdate;
    
    //计算时间差
    $nowdate = date("Y-m-d H:i:s",time());
    $minute=floor((strtotime($nowdate)-strtotime($startdate))%86400/60);
    // echo "<br>";
    // echo $minute;
    //如果时间小于5分钟则不下载
    if ($minute<5){
        echo('<script>alert("歇息会吧，请待会再来");top.location="../index.php";</script>'); 
    }else{
        //高速下载配置

        copy("../upload/$cosfile",$cosdown);
        
        $downloadurl = get_downurl($cosurl,$cos);
        Header("HTTP/1.1 303 See Other"); 
        header("Location: $downloadurl");
        
        // 发送消息到微信
        $message = "文件下载中  ".$cosfile;
    	$desp = $message;
        sct_send($desp);
        
        // 文件上传成功后写入历史记录
        $file_path = "../config/flag";
        $fp = fopen($file_path,"w");
        fwrite($fp,date("Y-m-d H:i",time()));
        fclose($fp);    
    }

}