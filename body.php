<?
if(isset($_COOKIE['user']))
{
	include('update.php');
}
else
{
    die('Unauthorized Access not allowed');
}
?>