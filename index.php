<?
if(isset($_COOKIE['user']))
{
	include('body.php');
}
else
{
    include('login.php');
}
?>