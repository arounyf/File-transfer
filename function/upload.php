<?php

require "../config/main.php";

$fname = $_FILES["userfile"]["name"];
$tsize = round($_FILES["userfile"]["size"] / 1048576,2);
$temp = explode(".",$fname);
$extension = end($temp);     // 获取文件扩展名


$allow = in_array($extension, $allowedExts);

//多重验证正确性
if (!$allow){
	if($tsize < $fsize){
		upfile($stu_name,$fname,$tsize);
	}else{
		echo '<li class="list-group-item">'."文件过大 目前只支持".$fsize.'MB以内的文件</li>';
	}
}else{
	echo '<li class="list-group-item">'."暂不支持".$extension.'文件</li>';
}


//文件上传函数
function upfile($stu_name,$fname,$tsize){

	require "../config/api.php";
 	if ($_FILES['userfile']['error'] > 0) { 
    	echo "错误：: " . $_FILES["userfile"]["error"] . "<br>";
	}else{
		echo '<ul class="list-group">';
		echo '<li class="list-group-item">'."上传文件名: " . $fname . "<br>"."</li>";
		echo '<li class="list-group-item">'."文件类型: " . $_FILES["userfile"]["type"] . "<br>"."</li>";
		echo '<li class="list-group-item">'."文件大小: " . $tsize . " MB<br>"."</li>";
		echo "</li>";
		if (file_exists("../upload/" . $fname))
		{
			echo '<li class="list-group-item">'. " 出现相同文件名，提交失败。 "."</li>";
		}else{
			move_uploaded_file($_FILES["userfile"]["tmp_name"], "../upload/" . $fname);
			echo '<li class="list-group-item">'. "文件提交成功"."</li>";
			
            // 发送消息到微信
            $message = "文件上传成功  ".$fname;
		    $desp = $message;
            sct_send($desp);
            
             // 读取上次上传的文件名然后删除掉，使得系统中只存在最后一个上传的文件
            $file_path = "../config/db";
            $fp = fopen($file_path,"r");
            $str = fread($fp,filesize($file_path));
            fclose($fp);
            $fnamepath="../upload/".$str;
            $fnamepath2="/www/cosfs/liang23/".$str;
                        
            if(!file_exists($fnamepath)){
            }else{
                unlink( $fnamepath);
            }
            if(!file_exists($fnamepath2)){
            }else{
                unlink( $fnamepath2);
            }
                
             // 文件上传成功后写入历史记录
            $file_path = "../config/db";
            $fp = fopen($file_path,"w");
            fwrite($fp,$fname);
            fclose($fp);
		
		}
	
	}
}

