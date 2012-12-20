<!--    This file is part of smsvote.

    smsvote is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    smsvote is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with opensmsvote.  If not, see <http://www.gnu.org/licenses/>.-->
<?php
require_once '../config/include.php';
//Define user and pass
$user = $_REQUEST['user'];
$pass = md5($_REQUEST['pass']);


// To protect MySQL injection (more detail about MySQL injection)
$user = stripslashes($user);
$pass = stripslashes($pass);
$user = mysql_real_escape_string($user);
$pass = mysql_real_escape_string($pass);
//Hämta användarna för att jämföra med den som loggar in
$sql="SELECT * FROM user WHERE name='$user' AND password='$pass'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $user and $pass, table row must be 1 row

if($count==1){
$group=mysql_result($result,$i,"groupID");
$stock=mysql_result($result,$i,"stockID");
// Register $user, $pass, $group, $stock and redirect to file
session_register("user");
session_register("pass");
session_register("group");
session_register("stock");
//Omdirigera till startsidan
header("location:index.php");
}
else {
    //If wrong password or user give a new opportunity to log in
echo '
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="validate.php">
<tr><td colspan="2">Felaktig anv&auml;ndare eller l&ouml;senord</td></tr>
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Inloggning </strong></td>
</tr>
<tr><input type="hidden" name="sida" value="<? echo $GET_[sida]; ?>">
<td width="78">Anv&auml;ndare</td>
<td width="6">:</td>
<td width="294"><input name="user" type="text" id="user"></td>
</tr>
<tr>
<td>L&ouml;senord</td>
<td>:</td>
<td><input name="pass" type="password" id="pass"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Logga in"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
';
}

ob_end_flush();

?>