Server

Save In Database

Here is an example of the server side script using PDO :
<?php
if(isset($_POST['audio'])){
  $audio = $_POST['audio'];
  $sql = $PDO->prepare("INSERT INTO `myTable` VALUES (?)");
  $sql->execute(array($audio));
}
Now, the database table will have a value like this :
data:audio/wav;base64,UklGRiQAAgBXQVZFZm10IBAAAAABAAIARKwAABCxAgAEABAAZGF0YQAAAgAAAAAAAAAAAAAAA.......
This will be a long long value. So, make sure the database column's type is set to "LONGTEXT" in MySQL.
When you want to play it, make an audio element with `src` attribute with this base64 value obtained from database. Example :
<?php
$sql = $PDO->query("SELECT `audio` FROM `myTable` WHERE `id` = 'whatever'");
$base64 = $sql->fetchColumn();
echo "<audio src='". $base64 ."'></audio>";
Saving as Files

This is the same as the previous one. Send the base64 data to the server and in the server, do as follows :
<?php
if(isset($_POST['audio'])){
  $audio = $_POST['audio'];
  $decoded = base64_decode($audio);
  $file_location = "./save_folder/recorded_audio.wav";
 
  file_put_contents($file_location, $decoded);
}
