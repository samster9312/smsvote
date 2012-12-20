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
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="login" method="post" action="validate.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Inloggning </strong></td>
</tr>
<tr><input type="hidden" name="sida" value="<? echo $GET_[sida]; ?>">
<td width="78">Anv&auml;ndare</td>
<td width="6">:</td>
<td width="294"><input name="user" type="text" id="user" required></td>
</tr>
<tr>
<td>L&ouml;senord</td>
<td>:</td>
<td><input name="pass" type="password" id="pass" required></td>
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
