<!DOCTYPE html>
<html lang="es">
<head>
<title>NexoCMS | Design Preview</title>
<link rel="stylesheet" type="text/css" href="/application/templates/grunged/css/style.css" />
</head>
<body>
<div id="header">
	<div class="logo">
		<a href="#"><img src="/application/templates/grunged/images/logo.png" /></a>
	</div>
	<div class="navigation">
		<ul>
			<li style="border-left: none;"><a class="active" href="#">Home</a></li>
			<li><a href="#">Register</a></li>
			<li><a href="#">How to connect</a></li>
			<li><a href="#">Vote</a></li>
			<li><a href="#">Donate</a></li>
			<li><a href="#">Store</a></li>
			<li><a href="#">Forums</a></li>
			<li><a href="#">Armory</a></li>
			<li><a href="#">Database</a></li>
		</ul>
	</div>
</div>
<div id="body">
	<div class="left">
		<div class="box">
			<div class="header">Membership</div>
			<div class="pre-content"></div>
			<div class="content">
					<form action="" method="post">
						<span>Username:</span><br />
						<input type="text" name="username" class="username"/><br />
						<span>Password:</span><br />
						<input type="password" name="password" class="password"/>
						<div style="clear:both;">&nbsp;</div>
						<div style="float: left; width: 120px;">
							<input type="submit" value="Login" class="button-input"/>
						</div>
						<div style="float:left;width:120px;text-align:left;">
							<a href="#">Create Account</a><br />
							<a href="#">Forgot Password?</a>
						</div>
					</form>
					<div style="clear:both;">&nbsp;</div>
			</div>
			<div class="bottom"></div>
		</div>
		<div class="box">
			<div class="header">Navigation</div>
			<div class="content-navigation">
			<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Create Account</a></li>
						<li><a href="#">How to Connect</a></li>
						<li><a href="#">Forums</a></li>
						<li><a href="#">Vote</a></li>
						<li><a href="#">Donate</a></li>
			</ul>
			</div>
		</div>
	</div>
	<div class="center">
    	<div id="slider">
        	<div id="slider-images">
        	<img src="/application/templates/grunged/images/slider/1.jpg" width="598" height="188" />
            <img src="/application/templates/grunged/images/slider/2.jpg" width="598" height="188" />
            </div>
            	<div id="slider-dots"></div>
        </div>
	{content}
	</div>
	<div class="clear"></div>
</div>
	<footer>
		<div style="margin:0 auto;background:#1a1a1a;width:900px;margin-top:10px;box-shadow: inset 0px 1px 0px rgba(60, 60, 60, 0.5), 0px -1px 3px rgba(0, 0, 0, 0.5);">
			<div style="margin:0 auto;color:#4b443a;text-shadow:1px 1px 2px rgba(0, 0, 0, 0.5);height:80px;">
				<div style="float: left;">
					<div style="width: 200px; float: left; padding-top: 30px; padding-left: 150px;">Copyright &copy; <b>NexoCMS</b> 2012</div>
				</div>
				<div style="float: right; padding: 30px; margin: 0;">
					<a href="#">Home</a> | <a href="#">Account</a> | <a href="#">Terms of Service</a> | <a href="#">Forums</a> | <a href="#">Contact Us</a>
				</div>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="/application/templates/grunged/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/application/templates/grunged/js/jquery.cycle.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#slider-images").cycle({
				fx : 'fade',
				speed : 500,
				pager : '#slider-dots'
			});
		});
</script>
</body>
</html>