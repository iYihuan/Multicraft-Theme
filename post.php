<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<form name="form1" action="/index.php?r=site/login" method="post">
<input name="LoginForm[name]" id="LoginForm_name" type="hidden" value="<?php echo $_GET['u']; ?>">             
<input name="LoginForm[password]" id="LoginForm_password" type="hidden" value="<?php echo $_GET['p']; ?>">                     
<input id="ytLoginForm_rememberMe" type="hidden" value="0" name="LoginForm[rememberMe]">       
<input id="ytLoginForm_ignoreIp" type="hidden" value="0" name="LoginForm[ignoreIp]">
<input type="hidden" name="yt0" value="正在登陆请稍后。。。。">     
</form>
正在登陆请稍后。。。。
<script type="text/javascript">
document.forms["form1"].submit();
</script>