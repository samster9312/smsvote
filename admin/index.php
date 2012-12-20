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
    along with smsvote.  If not, see <http://www.gnu.org/licenses/>.-->
<?php
//Kolla om användaren är inloggad
session_start();
if(!session_is_registered(user)){
    //Om användaren inte är inloggad skicka användaren till inloggningssidan
header("location: login.php");
}
?>
<a href="event.php">Event</a>
<br>
<a href="team.php">Team</a>
<br>
<a href="admin.php">Användare</a>