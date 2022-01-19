function rwidth(){
  document.getElementById('son').style.width = 0; 
  document.getElementById('son').innerHTML = ""; 
}

//检查信息是否填写完整
 function namevalue() {
 	var file = document.getElementById('userfile3'); 
	if (file.value) {
		sub();
	}else{
		alert("请选择你要上传的文件");
	}
 }
 
 //Ajax
 function sub() { 
      var obj = new XMLHttpRequest(); 
      obj.onreadystatechange = function() { 
        if (obj.status == 200 && obj.readyState == 4) { 
          document.getElementById('con').innerHTML = obj.responseText; 
        } 
      } 
      // 通过Ajax对象的upload属性的onprogress事件感知当前文件上传状态 
      obj.upload.onprogress = function(evt) { 
      // 上传附件大小的百分比 
      var per = Math.floor((evt.loaded / evt.total) * 100) + "%"; 
      // 当上传文件时显示进度条 
      document.getElementById('parent').style.display = 'block'; 

      // 通过上传百分比设置进度条样式的宽度 
      document.getElementById('son').style.width = per; 
      // 在进度条上显示上传的进度值 
      document.getElementById('son').innerHTML = per; 

      } 
      // 通过FormData收集零散的文件上传信息 
      var fm = document.getElementById('userfile3').files[0]; 


      var fd = new FormData(); 
      fd.append('userfile', fm); 

      obj.open("post", "./function/upload.php"); 
      obj.send(fd); 

    } 
    
    
    

function fastdown(){
  window.open("function/fastd.php", "_self");
}