<?php

require "../config/main.php";
$fname = $_FILES["userfile"]["name"];
$tsize = round($_FILES["userfile"]["size"] / 1048576,2);
$temp = explode(".",$fname);
$extension = end($temp);     // 获取文件扩展名
$allow = in_array($extension, $allowedExts);


//获取历史文件名
$file_path = "../config/db";
$fp = fopen($file_path,"r");
$str = fread($fp,filesize($file_path));
fclose($fp);
$hfname = $str;
$fnamepath = "../upload/".$str;


//多重验证正确性
if (!$allow){
	if($tsize < $fsize){
		upfile($fname,$tsize,$hfname,$fnamepath);
	}else{
		echo '<li class="list-group-item">'."文件过大 目前只支持".$fsize.'MB以内的文件</li>';
	}
}else{
	echo '<li class="list-group-item">'."暂不支持".$extension.'文件</li>';
}


//文件上传函数
function upfile($fname,$tsize,$hfname,$fnamepath){
	require "../config/api.php";
 	if ($_FILES['userfile']['error'] > 0) { 
    	echo "错误：: " . $_FILES["userfile"]["error"] . "<br>";
	}else{
		echo '<ul class="list-group">';
		echo '<li class="list-group-item">'."上传文件名: " . $fname . "<br>"."</li>";
		echo '<li class="list-group-item">'."文件类型: " . $_FILES["userfile"]["type"] . "<br>"."</li>";
		echo '<li class="list-group-item">'."文件大小: " . $tsize . " MB<br>"."</li>";
		echo "</li>";
		if ($hfname == $fname){
			echo '<li class="list-group-item">'. " 出现相同文件名，提交失败。 "."</li>";
		}else{
			move_uploaded_file($_FILES["userfile"]["tmp_name"], "../upload/" . $fname);
			echo '<li class="list-group-item">'. "文件提交成功"."</li>";
			
		    // 发送消息到微信
            $message = "文件上传成功  ".$fname;
            sct_send($message);
            
            // 文件上传成功后写入历史记录
            $file_path = "../config/db";
            $fp = fopen($file_path,"w");
            fwrite($fp,$fname);
            fclose($fp);
            
            // 删除缓存文件
            if(!file_exists($fnamepath)){
                echo '<li class="list-group-item">'. "历史文件不存在"."</li>";
            }else{
                unlink($fnamepath);
            }
		}
		
	}
}

