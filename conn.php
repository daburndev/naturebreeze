<?php
session_start();
function connect()
{
	$con=mysql_connect("localhost","root","");
	if(!$con)
	{
		die('Could not connect:'.mysql_error());
	}
	else
	{
		if(mysql_select_db("naturebreeze",$con))
		{
			return $con;
		}
	}
}
?>