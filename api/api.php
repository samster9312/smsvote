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
include '../config/include.php';
$number = $_REQUEST['phone'];
echo $number;
$values = $_REQUEST['text'];
$team = $values[strlen($values)-1];
echo $values;
$list = "SELECT teamID FROM team WHERE value = '".$team."'";
$result = mysql_query($list);
$row = mysql_fetch_array($result);
print_r($row);
$teamID = $row['teamID'];
echo $teamID;
if (strpos($values, "UV") !==false ) {
echo "<br>Hej";
$vote = "INSERT INTO votes VALUES ('', '".$number."', '".$teamID."', NOW())";
mysql_query($vote);
} else {
echo "FEL!";
}
?>