<!doctype html>
<html lang="zh-CN">
	<head>
		<!-- 必须的 meta 标签 -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap 的 CSS 文件 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

		<title>文件中转站</title>
		<style>
		    #son{
		        height: 30px;
		    }
		</style>
	</head>
	<body>
		<div class="container">
		    <br>
		  	<!-- Content here -->
			<h1>文件中转站</h1>
			
			<!--上传文件表单-->
			<div class="input-group">
				<input type="file"  id="userfile3" name="userfile"  onfocus="rwidth()" class="form-control"  aria-describedby="inputGroupFileAddon04" aria-label="Upload" >
			</div>
			
			
			<br>
			<div class="progress"  id="parent" style="height: 30px">
			<div id="son" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<br>
			
			
			<button type="button" class="btn btn-primary" onclick="namevalue()">上传</button>
			<button type="button" class="btn btn-primary" onclick="fastdown()" style="margin-left: 10px">下载</button>
			<br><br>
			<div id="con"></div> 
		</div>
		

		<!-- JavaScript 文件是可选的。从以下两种建议中选择一个即可！ -->

		<!-- 选项 1：包含 Popper 的 Bootstrap 集成包 -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./js/index.js"></script>
		<!-- 选项 2：Popper 和 Bootstrap 的 JS 插件各自独立 -->
		<!--
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-sy7xrBVBIaMK3slILGYC/U63fKx1UrfD8TRvvm7ofBK58y8tUNR4GWLKo+k+Yx8K" crossorigin="anonymous"></script>
		-->
	</body>
</html>