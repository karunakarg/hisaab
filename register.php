<?
include('sqlcon.php');
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$vpass=$_POST['vpass'];

if($uname)
{
$fail=0;
if($pass!=$vpass)
{
	echo "<font color='red'>Passwords do not match !!</font>";
    $fail=1;
}

$result = mysql_query('SELECT `username` FROM `users` WHERE `username`="'. $uname .'"');  
     
   //if number of rows fields is bigger them 0 that means it's NOT available '  
   if(mysql_num_rows($result)>0)
   {  
       //and we send 0 to the ajax request
	   echo "<font color='red'></br>Username already exists !!</font>";
       $fail=1;  
   }

$fail=!$fail;
if($fail)
{	
$q="INSERT INTO `users` (`username`, `password`) VALUES ('$uname', '$pass')";
mysql_query($q) or die('Registration Error !!');

echo '<script type="text/javascript"> alert("You have been Successfully Registered !!"); </script>';
echo '<html><HEAD><META HTTP-EQUIV="refresh" CONTENT="0;URL=login.php"></HEAD></html>';
}
}
?>
<script src="jquery.js"></script> 
<style type="text/css">
<!--
.style1 {
	font-size: medium;
	font-weight: bold;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
function validateForm()
{
var x=document.forms["form1"]["email"].value
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}
function validatePass()
{
var x=document.forms["form1"]["pass"].value
var y=document.forms["form1"]["pass2"].value
if (x!=y)
  {
  alert("Passwords Do Not Match !");
  return false;
  }
}

</script> 
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="register.php">
  <p><font color="#CC0000">All Fields are required !!</font></p>
  <table width="423" border="0">
    <tr>
      <td width="121">Username </td>
      <td width="292"><span id="sprytextfield3">
        <label>
          <input type='text' id='username' name='uname'>
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Password </td>
      <td><span id="sprypassword3">
        <input type="password" name="pass" id="pass" />
      <span class="passwordRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Verify Password </td>
      <td><span id="sprypassword2">
        <input type="password" name="vpass" id="pass2" onblur="validatePass()"/>
      <span class="passwordRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="add" id="add" value="Register !!" />
      </label></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2");
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3");
//-->
</script>