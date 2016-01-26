<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<form name="form1" method="post" action="login.php">
  <table width="491" border="0">
    <tr>
      <td width="70">Username</td>
      <td width="411"><span id="sprytextfield1">
        <input type="text" name="username" id="text1">
      <span class="textfieldRequiredMsg">Please enter Username.</span></span></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><span id="sprytextfield2">
        <input type="password" name="password" id="text2">
      <span class="textfieldRequiredMsg">Please enter your password.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Sign In">
      &nbsp;&nbsp;or <a href="register.php" style="text-decoration:none"><strong>Register</strong></a></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
<?php

//get the posted values
include("sqlcon.php");
$user_name=htmlspecialchars($_POST['username'],ENT_QUOTES);
$pass=$_POST['password'];
//now validating the username and password
if($user_name)
{
$sql="SELECT username, password FROM users WHERE username='".$user_name."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$u= base64_encode($user_name);
//if username exists
if(mysql_num_rows($result)>0)
{
        //compare the password
        if($row['password']==$pass)
        {       
			$ck=1;
        }
        else
            $ck=0;
}
else
{
	$ck=0; //Invalid Login
}

if($ck)
{
	echo '<html><HEAD><META HTTP-EQUIV="refresh" CONTENT="0;URL=setcookie.php?act=1&u='.$u.'"></HEAD></html>';
}
else
{
	die('Login Failure !!');
}
}
?>