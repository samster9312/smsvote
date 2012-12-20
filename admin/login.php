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
<html>
    <head>
        <LINK href="../style/login.css" rel="stylesheet" type="text/css">
    </head>
    <body>

<form name="login" method="post" action="validate.php">

<strong>Inloggning </strong>
<br>
<input type="hidden" name="sida" value="<? echo $GET_[sida]; ?>">
<label>Anv&auml;ndare:</label>
<input name="user" type="text" id="user" required autofocus>

<label>L&ouml;senord:</label>
<input name="pass" type="password" id="pass" required>

<input type="submit" name="Submit" value="Logga in">

</form>

</body>
</html>