<!DOCTYPE html>
<html>
<head>
	<title>网站首页</title>
	<style type="text/css">
		body {background: #b9cfb9;}
		h1 {text-align: center;padding-top: 100px; font-size: 48px;}
		p {text-align: center;padding-top: 100px; font-size: 48px;}
	</style>
</head>
<body>
<h1>Hello: HQT. Welcome!</h1>
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
