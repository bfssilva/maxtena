<?php
session_start();
include("../includes/db.conn.php");

//First lets get the username and password from the user 
$username=$_POST["username"]; 
$password=md5($_POST["password"]);

//Second let's check if that username and password are correct and found in our database
$sql=mysql_query("SELECT username, pass, id FROM bsi_admin WHERE username='" . mysql_escape_string($username) . "' AND pass='" . mysql_escape_string($password) . "'");
if (mysql_num_rows($sql)==0 || mysql_num_rows($sql)>1)
{ 
	header("location:index.php?error=88"); 
}
//if there are found in our database, and there is only one occurence of that username and password
//thus making them valid, so inside, you can include the webpage you want to open
if(mysql_num_rows($sql)==1)
{
	$row = mysql_fetch_assoc($sql);
	$_SESSION['password'] = $row['pass'];
	$_SESSION['id'] = $row['id'];
	header("location:admin_home.php"); //open up the secure page
}
?>
 
