<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Web Host Galaxy - Client Area</title>
<base href="https://webhostgalaxy.com/client/" />
<link rel="stylesheet" type="text/css" href="templates/WHG-portal/style.css" />
<script type="text/javascript" src="includes/jscript/jquery.js"></script>
</head>



<body>

<table class="wrapper" align="center" cellpadding="0" cellspacing="0">

<tr><td><table width="100%" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="13%" height="49" style="padding-left:35px; background:url('templates/WHG-portal/images/whmcslogobg.png') repeat-x;"> 
          <div align="left"><a href="http://webhostgalaxy.com"><img alt="Web Host Galaxy Logo - Click To Go To Main Site Home" src="templates/WHG-portal/images/whg-logo.png" id="WHG" border="0" name="WHG" /></a></div></td>
        <td width="29%" style="padding-left:35px; background:url('templates/WHG-portal/images/whmcslogobg.png') repeat-x;">&nbsp;</td>
        <td width="33%" style="padding-left:35px; background:url('templates/WHG-portal/images/whmcslogobg.png') repeat-x;">&nbsp;</td>
        <td width="25%" style="padding-left:35px; background:url('templates/WHG-portal/images/whmcslogobg.png') repeat-x;"> 
          <!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
          <script language="JavaScript" src="https://www.webhostgalaxy.com/ls/js/status_image.php?base_url=https://www.webhostgalaxy.com/ls&l=webhost21&x=1&deptid=0&"></script>
          <!-- END PHP Live! code : (c) OSI Codes Inc. -->
        </td>
      </tr>
    </table></td></tr>

<tr><td><table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #CCCCCC; background:#BFD5FF;"><tr><td height="30">You are here: <a href="index.php">Portal Home</a> > <a href="clientarea.php">Client Area</a></td><td style="text-align:right;">Please <a href="clientarea.php">Login</a> or <a href="register.php">Register</a></td></tr></table></td></tr>

<tr><td style="padding:0px">

<br />

<table cellpadding="0" cellspacing="0" width="100%">
<tr><td width="170" valign="top" style="padding-bottom:20px;">

<table width="100%"  border="0" cellpadding="2" cellspacing="1" class="navboxlinks">
<tr><td>&nbsp;<a href="index.php"><img src="images/clientarea.gif" alt="Home" align="middle" /></a>&nbsp;&nbsp;<a href="index.php">Home</a></td></tr>
<tr><td>&nbsp;<a href="announcements.php"><img src="images/rssfeed.gif" alt="Announcements" align="middle" /></a>&nbsp;&nbsp;<a href="announcements.php" >Announcements</a></td></tr>
<tr><td >&nbsp;<a href="downloads.php"><img src="images/zip.gif" alt="Downloads" align="middle" /></a>&nbsp;&nbsp;<a href="downloads.php">Downloads</a></td></tr>
<tr><td>&nbsp;<a href="affiliates.php"><img src="images/affiliates.gif" alt="Affiliates" align="middle" /></a>&nbsp;&nbsp;<a href="affiliates.php">Affiliates</a></td></tr>
<tr><td>&nbsp;<a href="knowledgebase.php"><img src="images/help.gif" alt="Knowledgebase" align="middle" /></a>&nbsp;&nbsp;<a href="knowledgebase.php">Knowledgebase</a></td></tr>
<tr><td>&nbsp;<a href="supporttickets.php"><img src="images/supporttickets.gif" alt="Support Tickets" align="middle" /></a>&nbsp;<a href="supporttickets.php">Support Tickets</a></td></tr>
<tr><td>&nbsp;<a href="submitticket.php"><img src="images/viewtickets.gif" alt="Submit Ticket" align="middle" /></a>&nbsp;<a href="submitticket.php">Submit Ticket</a></td></tr>
<tr><td>&nbsp;<a href="domainchecker.php"><img src="images/domains.gif" alt="Domain Checker" align="middle" /></a>&nbsp;&nbsp;<a href="domainchecker.php" >Domain Checker</a></td></tr>
<tr><td>&nbsp;<a href="serverstatus.php"><img src="images/status.gif" alt="Server Status" align="middle" /></a>&nbsp;&nbsp;<a href="serverstatus.php" >Server Status</a></td></tr>
<tr><td>&nbsp;<a href="cart.php"><img src="images/order.gif" alt="Order" align="middle" /></a>&nbsp;&nbsp;<a href="cart.php">Order</a></td></tr>
</table>

<br />


<table width="100%"  border="0" cellpadding="2" cellspacing="1" class="navbar"><tr><td class="navbox">

<form method="post" action="dologin.php">
<div align="center"><strong>Client Login</strong><br />
<img src="images/spacer.gif" width="1" height="5" alt="" /><br />
<table border="0" cellspacing="0" cellpadding="1">
<tr><td><div align="right"><span class="smalltext">Email:</span></div></td><td><input name="username" type="text" class="navinput" /></td></tr>
<tr><td><div align="right"><span class="smalltext">Password:</span></div></td><td><input name="password" type="password" class="navinput" /></td></tr>
</table>
<input type="checkbox" name="rememberme" /> Remember Me &nbsp; <input type="submit" class="submitbutton" value="Login" />
</div>
</form>

</td></tr></table>

<br />


<table width="100%"  border="0" cellpadding="2" cellspacing="1" class="navbar"><tr><td class="navbox">

<form method="post" action="knowledgebase.php?action=search">
<div align="center"><strong>Search</strong><br />
<img src="images/spacer.gif" width="1" height="5" alt="" /><br />
<select name="searchin" class="navinput" style="width:130px;">
<option value="Knowledgebase">Knowledgebase</option>
<option value="Downloads">Downloads</option>
</select>
<br />
<img src="images/spacer.gif" width="1" height="5" alt="" /><br />
<input name="search" type="text" class="navinput" size="15" />
&nbsp;
<input type="submit" class="submitbutton" value="Go" />
</div>
</form>

</td></tr></table>

</td><td valign="top" style="padding-left:20px;padding-bottom:20px;"><p>You must login to access this page. These login details differ from your websites control panel username and password.</p>
<form action="dologin.php?goto=clientarea" method="post" name="frmlogin" id="frmlogin">
  
  <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" border="0" align="center" class="frame">
    <tr>
      <td><table border="0" align="center" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" align="right" class="fieldarea">Email Address:</td>
            <td><input type="text" name="username" size="40" value="" /></td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea">Password:</td>
            <td><input type="password" name="password" size="25" value="" /></td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea"><input type="checkbox" name="rememberme" /></td>
            <td>Remember Me</td>
          </tr>
          <tr>
            <td width="150" align="right" class="fieldarea">&nbsp;</td>
            <td><input type="submit" value="Login" /></td>
          </tr>
        </table></td>
    </tr>
  </table><br />
</form>
<p align="center"><strong>Forgotten Your Password?</strong> <a href="pwreset.php">Request a Password Reset</a></p>
<script type="text/javascript">
document.frmlogin.username.focus();
</script>
<br /><p align="center">Powered by <a href="http://www.whmcs.com/" target="_blank">WHMCompleteSolution</a></p><?php
require('../wp/wp-content/themes/simplewp/header.php');
 
include $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/simplewp/footer.php";
?>