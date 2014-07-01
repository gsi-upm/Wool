<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wool</title>
	<?php echo Asset::css('bootstrap.css', 'fonts.css'); ?>
	<link rel="icon" href="/wool/public/favicon.ico" type="image/x-icon">
	<style>
		#text{
			margin-left: auto;
			height: 45px;
			top: 15px;
			font-size: 2em; 
		    font-weight: bolder;
		    /*font-family: "helvetica-neue-lt-std-75-bold";*/
		}
		.box {
		  width: 800px;
		  text-align: center;
		  /*margin: 40px;*/
		  font-size: 1.2em;
		  border-style: solid;
		  border-radius: 8px 8px 8px 8px; 
		  border-width: 8px 8px 8px 8px;
		  border-color: #66A67C;
		  box-shadow: 10px 10px 10px #000; 
		  background-color: #FFFFFF;
		  margin: 20px;
		  margin-left: 25%;
		}
		.image {
			margin: 40px;
			margin-left: auto;
		}
		.pull-right {
			margin: 30px;
		}
		body { margin: 0px 0px 40px 0px; }
	</style>
</head>
<body>
	<div class="box">
		<div id='text'>- Wool - <br>Error 404: Not found</div>
		<br>
		<?php echo Asset::img('wool-logo-404.svg', array('class'=>'image'));?>
		<br>
		<footer>
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
		</footer>
	</div>
</body>
</html>
