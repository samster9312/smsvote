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
$password = $_REQUEST['password'];
$delete = $_REQUEST['delete'];
$PHP_SELF = $_SERVER['PHP_SELF'];

if($submit) {
    //if id edit else add
    if($id){
        if($password) {
            $sql = "UPDATE user SET name='$name', password='".  md5($password)."' WHERE userID = '$id'"; 
        }  else {
            $sql = "UPDATE user SET name='$name' WHERE userID = '$id'";
        }
            
    } else {
        $sql = "INSERT INTO user (name, password) VALUES ('$name', '".  md5($password)."')";
    }
    $result = mysql_query($sql);
    echo '<script> window.alert("Användaren är skapad/uppdaterad!");
        window.location = "admin.php" </script>';

} elseif ($delete=="yes") {
    //Delete
    $sql = "DELETE FROM user WHERE userID='$id'";
    $result = mysql_query($sql);
    echo '<script> window.alert("Användaren är borttagen!");
        window.location = "admin.php" </script>';
    
} else {
    //if we dont press submit
    if(!$id) {
        //Print out the list
        $result = mysql_query("SELECT * FROM user");
        echo '
        <table class=border>
        <tr>
            <th>Namn</th>
            <th>Ta bort</th>
        </tr>
        ';
        while ($row = mysql_fetch_array($result)) {
            ?>
        <tr onclick="window.location = 'admin.php?id=<?php echo $row['userID']; ?>'" style="cursor:pointer;" >
            
            <?php
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td><a href='.$PHP_SELF. '?delete=yes&id=' . $row['userID'] . '>Ta bort</a></td>';
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
        $sql = "SELECT * FROM user WHERE userID=$id";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['userID'];
        $name = $row['name'];
        $password = $row['password'];
        echo '
            <input type=hidden name=id value="'.$id.'">
            ';
    }
    echo '
        
        <label>Namn:</label><input type="text" name="name" id="name" value="'.$name.'" autofocus/>
        <label>Lösenord:</label><input type="password" name="password" id="password"/>
        <label>Bekräfta lösenord:</label><input type="password" name="password1" id="password1" oninput="check(this)"/>
        <label><input type="submit" name="submit" value="Enter">
        <script>
            function check(input) {
              if (input.value != document.getElementById("password").value) {
                input.setCustomValidity("Lösenorden måste vara samma");
              } else {
                // input is valid -- reset the error message
                input.setCustomValidity("");
              }
            }
        </script>
        </form>
        ';
}


?>
</body>
</html>