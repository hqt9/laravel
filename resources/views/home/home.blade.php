<!DOCTYPE html>
<html>
<head>
	<title>网站首页</title>
	<style type="text/css">
		body {background: #b9cfb9;}
		h1 {text-align: center;padding-top: 100px; font-size: 48px;}
		h1 span {color: red;}
		p {text-align: center;padding-top: 100px; font-size: 48px;}
	</style>
</head>
<body>
	<?php $name = (isset($_GET['name'])) ? $_GET['name'] : 'Guest'; ?>
	<h1>Hello: <span><?php echo $name; ?></span>. Welcome!</h1>
	<p>scan</p>
	<p>back</p>
	<p>home</p>
</body>

<script type="text/javascript">
	document.querySelector('p').onclick = function(){
		window.location.href = "{{ asset('/') }}";
	}
</script>
</html>
