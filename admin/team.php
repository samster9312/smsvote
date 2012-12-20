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
$value = $_REQUEST['value'];
$people = $_REQUEST['people'];
$eventID = $_REQUEST['eventID'];
$delete = $_REQUEST['delete'];
$PHP_SELF = $_SERVER['PHP_SELF'];

if($submit) {
    //if id edit else add
    if($id){
        $sql = "UPDATE team SET name='$name', value='$value', people='$people',eventID='$eventID' WHERE teamID = '$id'";
    } else {
        $sql = "INSERT INTO team (name, value, people, eventID) VALUES ('$name', '$value', '$people', '$eventID')";
    }
    $result = mysql_query($sql);
    echo '<script> window.alert("Teamet är skapat/uppdaterat!");
        window.location = "team.php" </script>';

} elseif ($delete=="yes") {
    //Delete
    $sql = "DELETE FROM team WHERE teamID='$id'";
    $result = mysql_query($sql);
    echo '<script> window.alert("Teamet är borttaget!");
        window.location = "team.php" </script>';
    
} else {
    //if we dont press submit
    if(!$id) {
        //Print out the list
        $result = mysql_query("SELECT team.teamID, team.value, team.time, team.people, team.name AS team, event.name AS event FROM team, event WHERE team.eventID = event.eventID");
        $resEvent = mysql_query("SELECT name, eventID FROM event");
        echo '
        <table class=border>
        <tr>
            <th>Namn</th>
            <th>Värde</th>
            <th>Tid</th>
            <th>Personer</th>
            <th>Event</th>
            <th>Ta bort</th>
        </tr>
        ';
        while ($row = mysql_fetch_array($result)) {
            ?>
        <tr onclick="window.location = 'team.php?id=<?php echo $row['teamID']; ?>'" style="cursor:pointer;" >
            
            <?php
                    echo '<td>' . $row['team'] . '</td>';
                    echo '<td>' . $row['value'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td>' . $row['people'] . '</td>';
                    echo '<td>' . $row['event'] . '</td>';
                    echo '<td><a href='.$PHP_SELF. '?delete=yes&id=' . $row['teamID'] . '>Ta bort</a></td>';
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
        $sql = "SELECT * FROM team WHERE teamID=$id";
        $resEvent = mysql_query("SELECT name, eventID FROM event");
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['teamID'];
        $name = $row['name'];
        $value = $row['value'];
        $people = $row['people'];
        $eventID = $row['eventID'];
        echo '
            <input type=hidden name=id value="'.$id.'">
            ';
    }
    echo '
        
        <label>Namn:</label><input type="text" name="name" id="name" value="'.$name.'" autofocus required/>
        <label>Värde:</label><input type="text" name="value" id="value" value="'.$value.'" required/>
        <label>Personer:</label><input type="date" name="people" id="people" value="'.$people.'"/>
        <label>Event:</label><select name="eventID"
        <option value="">Välj ett event</option>';  
        while($nt=mysql_fetch_array($resEvent)){
            if ($row['eventID']==$nt[eventID])
            echo "<option value=$nt[eventID] selected>$nt[name]</option>";
            else
            echo "<option value=$nt[eventID]>$nt[name]</option>";
            }
        echo '
        

        <label><input type="submit" name="submit" value="Enter">
        </form>
        ';
}


?>
</body>
</html>