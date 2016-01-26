<?
include('sqlcon.php');
include('menu.php');
$user=$_COOKIE['user'];
$user=base64_decode($user);

$id=$_POST['id'];
if(isset($id))
{
	$q="DELETE FROM `account` WHERE `account`.`id` = $id";
	mysql_query($q) or die('MySQL Error(3)!!');
	echo '<script type="text/javascript"> alert("Record Deleted Successfully!!"); </script>';
}
?>
<br>
  &nbsp;
</br>
<table width="484" border="1" cellspacing="0">
  <tr>
    <td width="478"><strong>Note :</strong> +ve amount means your friend(s) needs to pay you and -ve means you need to pay your friend(s) .</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="viewreport.php">
  <table width="476" border="0" cellspacing="0">
    <tr>
      <td width="129">View Report for :</td>
      <td width="343">
      <select name="frn" id="select">
      <?
      $q="SELECT * FROM `friends` WHERE `friendof`='$user'";
	  $result=mysql_query($q) or die('MySQL Error(1)!!');
	  while($row=mysql_fetch_array($result))
	  {
		  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';  
	  }

	  ?>
      </select> &nbsp;
      <input type="submit" name="button" id="button" value="Go" /></td>
    </tr>
  </table>
</form>
<?
$id=$_POST['frn'];
if($id)
{
	$pos=0;
	$neg=0;
?>
<fieldset>
  <label><strong>Report for
<?
$q="SELECT `name` FROM `friends` WHERE `id`=$id";
$result=mysql_query($q) or die('MySQL Error(1)!!');
$row=mysql_fetch_array($result);
echo $row['name'];
?>
  </strong></label>
<table width="483" border="1" cellspacing="0">
  <tr background="top.png">
    <th width="47">S. No.</th>
    <th width="80">Date</th>
    <th width="148">Details</th>
    <th width="25">+/-</th>
    <th width="69">Amount</th>
    <th width="88">Delete</th>
  </tr>
  <?
  $q="SELECT * FROM `account` WHERE `fid`=$id AND `friendof`='$user'";
  $result=mysql_query($q) or die('MySQL Error(2)!!');
  $i=0;
  while($row=mysql_fetch_array($result))
  {
	  $i++;
  ?>
  <tr>
    <td><center><?=$i?></center></td>
    <td><center><?=$row['date']?></center></td>
    <td><center><?=$row['desc']?></center></td>
    <td><center>
	<?
	if($row['type']=='-')
	{
		$neg=$neg+$row['amount'];
		$type="<font color=red>-</font>";
	}
	else if($row['type']=='+')
	{
		$pos=$pos+$row['amount'];
		$type="<font color=green>+</font>";
	}
	echo $type;
	?></center></td>
    <td><center><?=$row['amount']?></center></td>
    <td><form id="form2" name="form2" method="post" action="viewreport.php">
      <input type="submit" name="button2" id="button2" value="Delete" />
      <input name="id" type="hidden" id="hiddenField" value="<?=$row['id']?>" />
    </form></td>
  </tr>
  <?
  }
  ?>
  <tr bgcolor="#FFFF99">
  <th colspan="4"><center>
  Total Amount</center>
  </th>
  <th><center>
  <?
  $total=$pos-$neg;
  echo $total;
  ?></center>
  </th>
  <th>&nbsp;</th>
  </tr>
</table></fieldset>
<?
}
?>