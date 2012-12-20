<!--    This file is part of smsvote.

    opensmsvote is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    opensmsvote is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with opensmsvote.  If not, see <http://www.gnu.org/licenses/>.-->
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<?php
require_once 'config/include.php';
$event = $_REQUEST[event];
$list = "SELECT eventID FROM event WHERE identity = '".$event."'";
$result2 = mysql_query($list);
$row2 = mysql_fetch_array($result2);
$eventID = $row2[eventID];
$query = "SELECT name, people, teamID FROM team WHERE eventID = ".$eventID;
$query3 = "SELECT teamID FROM votes WHERE eventID = ".$eventID;
$list2 = mysql_query($query);
$vote = mysql_query($query3);
$total = mysql_num_rows($vote);
echo '<br>';
echo '<table class="table">
    <tr>
    <th>L&aring;t</th>
    <th>Uppf&ouml;rd av</th>
    <th>Antal r&ouml;ster</th>
    <th>Andel av r&ouml;sterna</th>
    <th></th>
    </tr>';
while($row = mysql_fetch_array($list2))
  {
    $query2 = "SELECT ID FROM votes WHERE eventID = '".$eventID."' AND teamID = '".$row['teamID']."' ";
    $result = mysql_query($query2);
    $num_rows = mysql_num_rows($result);
    $percent = ($num_rows/$total)*100;
    $percent = number_format($percent, '2');
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['people'] . "</td>";
    echo "<td>" . $num_rows . "</td>";
    echo "<td>" . $percent . "&#37;</td>";
    echo "<td><meter min='0' max='100' value='".$percent."'></td>";
    echo "</tr>";
}
echo "<tr><td colspan=4>Totalt ";
echo $total;
echo " r&ouml;ster";
echo "</table>";
?>
