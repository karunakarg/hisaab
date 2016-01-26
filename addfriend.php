<?
include('menu.php');
include('sqlcon.php');
?>
<br>
&nbsp;
</br>
<form id="form1" name="form1" method="post" action="addfriend.php">
  <table width="400" border="0" cellspacing="0">
    <tr>
      <td width="133">Friend's Name *</td>
      <td width="263"><input type="text" name="frnd" id="textfield" /></td>
    </tr>
    <tr>
      <td>Location </td>
      <td><input type="text" name="loc" id="textfield2" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Add" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?
$name=$_POST['frnd'];
$loc=$_POST['loc'];

if($name)
{
	$user=$_COOKIE['user'];
	$user=base64_decode($user);
	$q="INSERT INTO `friends` (`id`, `name`, `loc`, `friendof`) VALUES (NULL, '$name', '$loc', '$user')";
	mysql_query($q) or die('MySQL Error(1)!!');
	echo "Friend Added Successfully !!";
}

?>
