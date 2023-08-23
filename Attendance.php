<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style2.css">
<?php
include 'facultyDashboard.php';
include_once ("Config.php");
?>
<style>
    .table4{
        padding: 10px 10px;
    }
</style>
<div class="home-content">
<form method="post">
	<table border="1" class="table1">
		<tr class="bgheading">
			<td style="width: 30%;">
				<h2 class="heading">Attendance</h2>
			</td>
		</tr>
        <tr>
            <td>
                <table>
                    <tr class="table4">
                        <td class="table4">Standard</td>
                        <td class="table4">
                            <select name = "Standard" class="w3-input">
                                <option disabled selected>--</option>
                                    <?php

                                        $result = mysqli_query($con,"SELECT Stan_Name from standard_info");

                                        while ($res = mysqli_fetch_array($result)) {
                                            echo "<option value='".$res['Stan_Name'] . "'>".$res['Stan_Name']."</option>";
                                        }
                                    ?>
                            </select>
                        </td>
                        <td class="table4">Division</td>     
                        <td class="table4">
                            <select name = "Division" class="w3-input">
                                <option disabled selected>--</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>  
                            </select>
                        </td>    
                        <td>
                            <button class="button" type="submit" name="display">Display</button>
                        </td>
                    </tr>    
                </table>
            </td>
        </tr>
        <?php
        if (isset($_POST['display'])) {
        ?>
		<tr>
			<td>
				<table class="table3" border="1" align ="center">
				    <tr>	
					    <th>Student Name</th>
					    <th>Student RollNo</th>
					    <th>Attendance</th>
					</tr>
				    <?php

                        $standard = $_POST['Standard'];
                        $division = $_POST['Division'];

                        $result = mysqli_query($con, "SELECT S_Id, S_Name, S_RollNo FROM student_info WHERE S_Standard = '$standard' AND S_Division = '$division' ORDER BY S_RollNo");
                        
                 
                        while ($res= mysqli_fetch_array($result)) {
                        
                            echo "<tr>";
                            $sid1 = $res['S_Id'];
                        ?>    
                            <td><?php echo $res['S_Name']; ?><input type="hidden" name="student_id[]" value="<?php echo $sid1; ?>"></td>
                        <?php

                            $_SESSION['sid1'] = $sid1; 
                            echo "<td>".$res['S_RollNo']."</td>";
                            echo "<td>";

                        ?>

                            
                            <div class = 'radio'>
                            <label><input style="cursor: pointer;" type="radio" name="attendance[<?php echo $sid1; ?>]"  value="Present" required>Present</label>
                            &emsp;
                            <label><input style="cursor: pointer;" type="radio" name="attendance[<?php echo $sid1; ?>]" value="Absent">Absent</label>
                            <div>
                            </td>
                        <?php    
                           
                        }                                       
				    ?>
				    </tr>
				    <tr align="center">                     	   	
                        <td colspan="5">
                            <div class="allbutton"> 
		                    <input type="submit" name="add" value="Add">
                            </div> 
		                </td>                           
		            </tr>
			    </table>
			</td>
		</tr>
        <?php
    }
        ?>
	</table>
</form>
</div>
<?php


if (isset($_POST['add'])) {
	
	$attendance = $_POST['attendance'];
	$student_id = $_POST['student_id'];
    
    $sid1 = $_SESSION['sid1'];

    foreach ($_POST['attendance'] as $index => $value) {

        $record = "INSERT INTO attendance_info (Attendance_status, S_Id) values ('$value','$index')";

        if (mysqli_query($con, $record)) {
            //echo "data inserted";
        }
        if($record){
            $_SESSION['status']="Data inserted";
            $_SESSION['status_code']="success";
        }
        else{
            $_SESSION['status']="data is not inserted";
            $_SESSION['status_code']="error";
        }
    }
}

?>
<script src="alert.min.js"></script>
<?php
if(isset($_SESSION['status']))
{
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "ok done!",
        });
    </script>
    <?php
        unset($_SESSION['status']);
    }
?>

<?php
/*

foreach ($_POST['attendance'] as $index=>$value) {
        echo $index;
        echo $value;
        
            $record = "INSERT INTO attendance_info (Attendance_status, S_Id) values ('$value',".$_POST['student_id'][$index].")";

            if (mysqli_query($con, $record)) {
               echo "data inserted";
            }           
        //$attendance1 = implode(" ",$attendance);      
    }

*/
?>