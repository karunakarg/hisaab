<?
$u=$_GET['u'];
$action=$_GET['act'];
if($action==1)
{
$expire=time()+60*60*24*30*365;
setcookie("user", $u, $expire);
}
else
{
$expire=time()-3600;
setcookie("user", "", $expire);
}

echo '<html><HEAD><META HTTP-EQUIV="refresh" CONTENT="0;URL=index.php"></HEAD></html>';
?>