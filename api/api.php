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
$text = $_REQUEST['text'];
$values = explode(' ', $text);
$team = $values[1];
$event = $values[0];
echo $team;
echo '<br>';
echo $event;
$list = "SELECT teamID FROM team WHERE value = '".$team."'";
$result = mysql_query($list);
$row = mysql_fetch_array($result);
$list = "SELECT eventID FROM event WHERE identity = '".$event."'";
$result2 = mysql_query($list);
$row2 = mysql_fetch_array($result2);

echo '<br>Team';
$teamID = $row['teamID'];
echo $teamID;
$eventID = $row2['eventID'];
echo '<br>';
echo $eventID;
$vote = "INSERT INTO votes VALUES ('', '".$number."', '".$teamID."', NOW(),'".$eventID."')";
mysql_query($vote);

?>