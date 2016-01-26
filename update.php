<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%M-%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
<?
include('sqlcon.php');
include('menu.php');
$user=$_COOKIE['user'];
$user=base64_decode($user);
?>
<br>
&nbsp;
</br>
<table width="431" border="1" cellspacing="0">
  <tr>
    <td width="429"><strong>Note :</strong> +ve amount means your friend(s) needs to pay you and -ve means you need to pay your friend(s) .</td>
  </tr>
</table>
<br>
<form id="form1" name="form1" method="post" action="">
  <table width="424" border="0" cellspacing="0">
    <tr>
      <td width="146"><strong>Amount</strong> (Rs) :</td>
      <td width="274"><select name="type" id="select">
        <option value="+">+</option>
        <option value="-">-</option>
      </select>&nbsp;
      <input type="text" name="amount" id="textfield" /></td>
    </tr>
    <tr>
      <td><strong>Date</strong> (dd-mm-yy) :</td>
      <td><input name="date" type="text" id="inputField" size="12" /></td>
    </tr>
    <tr>
      <td><strong>Description :</strong></td>
      <td><input type="text" name="desc" id="textfield2" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Select Friend(s) :</strong></td>
      <td>
      <table width="273" border="0" cellspacing="0">
      <?
      $q="SELECT * FROM `friends` WHERE `friendof`='$user'";
	  $result=mysql_query($q) or die('MySQL Error(1)!!');
	  while($row=mysql_fetch_array($result))
	  {
	  ?>
      <tr>
          <td width="123"><input name="friend[]" type="checkbox" id="checkbox" value="<?=$row['id']?>" />
            <?=$row['name']?> </td>
            <?
            $row=mysql_fetch_array($result);
			if($row)
			{
			?>
          <td width="146"><input name="friend[]" type="checkbox" id="checkbox" value="<?=$row['id']?>" />
            <?=$row['name']?> </td>
            <?
			}
			?>
      </tr>
      <?
	  }
	  ?>
        
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="save" id="button" value="Save" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?
$type=$_POST['type'];
$amount=$_POST['amount'];
$date=$_POST['date'];
$desc=$_POST['desc'];
$friends=array();
$friends=$_POST['friend'];

if($type&&$friends&&$amount&&$date&&$desc)
{
	foreach($friends as $friend)
	{
		$q="INSERT INTO `account` (`id`, `fid`, `amount`, `date`, `desc`, `type`, `friendof`) VALUES (NULL, '$friend', '$amount', '$date', '$desc', '$type', '$user')";
		mysql_query($q) or die('MySQL Error(2)!!');
	}
	echo "<font color='green'>Accounts updated successfully !!</font>";
}


?>