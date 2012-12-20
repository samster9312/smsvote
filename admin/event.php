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
//Kolla om användaren är inloggad
session_start();
if(!session_is_registered(user)){
    //Om användaren inte är inloggad skicka användaren till inloggningssidan
header("location: login.php");
}
require_once '../config/include.php';
$submit = $_REQUEST['submit'];
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$identity = $_REQUEST['identity'];
$startdate = $_REQUEST['startdate'];
$starttime = $_REQUEST['starttime'];
$enddate = $_REQUEST['enddate'];
$endtime = $_REQUEST['endtime'];
$delete = $_REQUEST['delete'];
$PHP_SELF = $_SERVER['PHP_SELF'];

if($submit) {
    //if id edit else add
    if($id){
        $sql = "UPDATE event SET name='$name', identity='$identity', startdate='$startdate',starttime='$starttime', enddate='$enddate', endtime='$endtime' WHERE eventID = '$id'";
    } else {
        $sql = "INSERT INTO event (name, identity, startdate, starttime, enddate, endtime) VALUES ('$name', '$identity', '$startdate', '$starttime', '$enddate', '$endtime')";
    }
    $result = mysql_query($sql);
    echo '<script> window.alert("Eventet är skapat/uppdaterat!");
        window.location = "event.php" </script>';

} elseif ($delete=="yes") {
    //Delete
    $sql = "DELETE FROM event WHERE eventID='$id'";
    $result = mysql_query($sql);
    echo '<script> window.alert("Eventet är borttaget!");
        window.location = "event.php" </script>';
    
} else {
    //if we dont press submit
    if(!$id) {
        //Print out the list
        $result = mysql_query("SELECT * FROM event");
        echo '
        <table class=border>
        <tr>
            <th>Namn</th>
            <th>Identitet</th>
            <th>Startdatum</th>
            <th>Starttid</th>
            <th>Slutdatum</th>
            <th>Sluttid</th>
            <th>Ta bort</th>
        </tr>
        ';
        while ($row = mysql_fetch_array($result)) {
            ?>
        <tr onclick="window.location = 'event.php?id=<?php echo $row['eventID']; ?>'" style="cursor:pointer;" >
            
            <?php
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['identity'] . '</td>';
                    echo '<td>' . $row['startdate'] . '</td>';
                    echo '<td>' . $row['starttime'] . '</td>';
                    echo '<td>' . $row['enddate'] . '</td>';
                    echo '<td>' . $row['endtime'] . '</td>';
                    echo '<td><a href='.$PHP_SELF. '?delete=yes&id=' . $row['eventID'] . '>Ta bort</a></td>';
        }
        echo '</tr>
';
    }
    echo '
        </table>
        <form method="post" action="'.$PHP_SELF.'" id="form">
        ';
    if($id) {
        //Edit the selected event
        $sql = "SELECT * FROM event WHERE eventID=$id";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['eventID'];
        $name = $row['name'];
        $identity = $row['identity'];
        $startdate = $row['startdate'];
        $starttime = $row['starttime'];
        $enddate = $row['enddate'];
        $endtime = $row['endtime'];
        echo '
            <input type=hidden name=id value="'.$id.'">
            ';
    }
    echo '
        
        <label for="name">Namn:</label><input type="text" name="name" id="name" value="'.$name.'" autofocus  required/>
        <label>Identitet:</label><input type="text" name="identity" id="identity" value="'.$identity.'"  required/>
        <label>Startdatum:</label><input type="date" name="startdate" id="startdate" value="'.$startdate.'"/>
        <label>Starttid:</label><input type="time" name="starttime" id="starttime" value="'.$starttime.'"/>
        <label>Slutdatum:</label><input type="date" name="enddate" id="enddate" value="'.$enddate.'"/>
        <label>Sluttid:</label><input type="time" name="endtime" id="endtime" value="'.$endtime.'"/>
        <label><input type="submit" name="submit" value="Enter">
        </form>
        ';
}


?>
</body>
</html>