<?php
include('../sqconfig.php');

mysqli_select_db($db, 'qasurvey') or  die("Could not access DB");

function displayPoll($prompt, $questions) {
	echo "<td><b>".$prompt."<b><form method=\"post\" action=\"\"<table border=\"0\"/>";

	for($i = 0; $i < count($questions); $i++) {
		echo "<tr><td><label><input type=\"radio\" name=\"poll\" value=\"".$i."\" />".
			$questions[$i]."</label></td></tr>";
	}
	echo "<table>
		<input type=\"submit\" name=\"submit\" value=\"Vote!\" />
		</form></td></td></table>";
}

$selectionOne = "SELECT * FROM poll WHERE pollID=1";
$processOne = mysqli_query($db, $selectionOne);
$mod_cone = NULL;
$mod_ctwo = NULL;
$mod_cthree = NULL;
$mod_cfour = NULL;
while($row = mysqli_fetch_array($processOne, MYSQLI_ASSOC)) {
	$mod_cone = (int)$row['cone'] + 1;
	$mod_ctwo = (int)$row['ctwo'] + 1;
	$mod_cthree = (int)$row['cthree'] + 1;
	$mod_cfour = (int)$row['cfour'] + 1;
}

$selectionTwo = "SELECT * FROM poll WHERE pollID=2";
$processTwo = mysqli_query($db, $selectionTwo);
while($row = mysqli_fetch_array($processTwo, MYSQLI_ASSOC)) {
        $mod_cone = (int)$row['cone'] + 1;
        $mod_ctwo = (int)$row['ctwo'] + 1;
        $mod_cthree = (int)$row['cthree'] + 1;
        $mod_cfour = (int)$row['cfour'] + 1;
}

$selectionThree = "SELECT * FROM poll WHERE pollID=3";
$processThree = mysqli_query($db, $selectionThree);
while($row = mysqli_fetch_array($processThree, MYSQLI_ASSOC)) {
        $mod_cone = (int)$row['cone'] + 1;
        $mod_ctwo = (int)$row['ctwo'] + 1;
        $mod_cthree = (int)$row['cthree'] + 1;
        $mod_cfour = (int)$row['cfour'] + 1;
}

$selectionFour = "SELECT * FROM poll WHERE pollID=4";
$processFour = mysqli_query($db, $selectionFour);
while($row = mysqli_fetch_array($processFour, MYSQLI_ASSOC)) {
        $mod_cone = (int)$row['cone'] + 1;
        $mod_ctwo = (int)$row['ctwo'] + 1;
        $mod_cthree = (int)$row['cthree'] + 1;
        $mod_cfour = (int)$row['cfour'] + 1;
}

$choices = array('Sugar', 'Splenda', 'Cane Sugar', 'None');
echo "<table><tr><td><b>Results: </b><table><tr><td>".($mod_cone)."</td><td>".
        $choices[0]."</td></tr><tr><td>".($mod_ctwo)."</td><td>".$choices[1]."</td></tr>
	<tr><td>".($mod_cthree)."</td><td>".$choices[2]."</td></tr><tr><td>".($mod_cfour)."</td><td>".$choices[3]."</td></tr></table></td>";
displayPoll("Which sugar do you put in your coffe?", $choices);

if(isset($_POST['submit'])) {
	if(isset($_POST['poll'])) {
		$selection = $_POST['poll'];
	}else {
		$selection = '';
	}
	if(strlen($selection) > 0) {
		switch((int)$selection) {
		case 0:
			$select_stmt = "UPDATE poll SET cone='{$mod_cone}' WHERE pollID = 1"; 
			break;
		case 1:
			$select_stmt = "UPDATE poll SET ctwo='{$mod_ctwo}' WHERE pollID = 2";
			break;
		case 2:
			$select_stmt = "UPDATE poll SET cthree='{$mod_cthree}' WHERE pollID = 3";
			break;
		case 3:
			$select_stmt = "UPDATE poll SET cfour='{$mod_cfour}' WHERE pollID = 4";
			break;
		}
		$process = mysqli_query($db, $select_stmt) or die(mysqli_error($db));
		if($process) {
			echo "You vote has been cast => ";
		}else {
			echo "Error";
		}
		echo $choices[$selection];
	}else {
		echo "You made no choice!";
	}

}




?>
