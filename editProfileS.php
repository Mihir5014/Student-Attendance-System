<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style2.css">
<?php
include 'studentDashboard.php';
?>
<style>
	.size{
		font-size: 48px;
	}
	.link{
		text-decoration: none;
		font-family: 'Poppins', sans-serif;
	}
	.button{
      background-color:#0A2558 ; 
      border: solid; 
      padding: 14px 50px; 
      color: white; 
      border-radius: 4px;
      cursor: pointer;
    }
    .button1{
      font-size: 15px;
      background-color:#0A2558 ; 
      border: solid; 
      padding: 10px 22px; 
      color: white; 
      border-radius: 4px;
      cursor: pointer;
    }
</style>

<div class="home-content">
	<form method="post" action="<?php $_PHP_SELF ?>">
		<table border="1" class="table1">
			<tr class="bgheading">
            <td style="width: 30%;">
                <h2 class="heading">Edit</h2>
            </td>
        </tr>
        <tr>
        	<td>
        		<table class="table3">
        			
        				<?php

        				include_once ("Config.php");

        				$sid = $_SESSION['sid'];

        				$result = mysqli_query($con,"SELECT * FROM student_info WHERE S_Id = '$sid' ");

        				while ($res = mysqli_fetch_array($result)) {
        					$sid = $res['S_Id'];
        					echo "<tr>";
        					echo "<td align='center'><i class='bi-person-circle size'></i></td>";
        					echo "<td align='left'><h2>".$res['S_Name']."</h2></td>";   
        					echo "<td align='right' colspan='2'><a href='editProfileS.php?id=$sid'><i class='bi-pencil-square'></i> Edit </a></td>";    				
        				?>
        			</tr>
                    <tr>
                    	<td>
                    		Full Name:
                    	</td>
                    	<td>
                    		<input type="text" name="sname" id="sname" value="<?php echo $res['S_Name']; ?>" class="w3-input" disabled>
                    	</td>
                    	<td>
                    		Date of Birth:
                    	</td>
                    	<td>
                    		<input type="date" name="sdob" id="sdob" value="<?php echo $res['S_Dob']; ?>" class="w3-input" disabled>
                    	</td>
                    </tr>
                    <tr>
                        <td>
                            Standard:
                        </td>
                        <td>
                            <input type="number" name="standard" id="standard" value="<?php echo $res['S_Standard']; ?>" class="w3-input" disabled>
                        </td>
                        <td>
                            Div:
                        </td>
                        <td>
                            <input type="text" name="div" id="div" value="<?php echo $res['S_Division']; ?>" class="w3-input" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Roll No:
                        </td>
                        <td>
                            <input type="number" name="rollno" id="rollno" value="<?php echo $res['S_RollNo']; ?>" class="w3-input" disabled>
                        </td>
                        <td>
                            Gender:
                        </td>
                        <td>
                            <input type="text" name="gender" id="gender" value="<?php echo $res['S_Gender']; ?>" class="w3-input" disabled>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                    		Email:
                    	</td>
                    	<td>
                    		<input type="email" name="mail" id="mail" value="<?php echo $res['S_Email']; ?>" class="w3-input" disabled>
                    	</td>
                    	<td>
                    		Mobile No:
                    	</td>
                    	<td>
                    		<input type="number" name="smono" id="smono" value="<?php echo $res['S_MobileNo']; ?>" class="w3-input" disabled>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                    		Address:
                    	</td>
                    	<td colspan="3">
                    		 <textarea name="address" id="address" style="height: 70px" class="w3-input" disabled placeholder="Address"><?php echo $res['S_Address']; ?></textarea>
                    	</td>
                    </tr>
                     <tr>
                    	<td>
                    		Username:
                    	</td>
                    	<td>
                    		<input type="text" name="uname" id="uname" value="<?php echo $res['S_Username']; ?>" class="w3-input">
                    	</td>
                    	<td align="center" colspan="2">
                    		<a href="changePasswordS.php?id=<?php echo $sid;?>" class="link">Change Password</a>
                    	</td>
                    </tr>
                    <tr>
                        <td>
                            Security Question:
                        </td>
                        <td colspan="3">
                            <select name="question" class="w3-input">
                                <option selected value="<?php echo $res['Security_Question']; ?>"><?php echo $res['Security_Question']; ?></option>
                                <option value="What is the name of your First Pet?">What is the name of your First Pet?</option>
                                <option value="What is the name of your First School?">What is the name of your First School?</option>
                                <option value="Who is your favourite Actor?">Who is your favourite Actor?</option>
                                <option value="What is your favourite Book?">What is your favourite Book?</option>
                                <option value="What city were you born in?">What city were you born in?</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Answer:
                        </td>
                        <td colspan="3">
                            <input type="text" name="answer" class="w3-input" placeholder="Answer" required value="<?php echo $res['Security_Answer']; ?>">
                        </td>
                    </tr>  
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit" name="update" class="button">Update</button>
                        </td>
                        <td colspan="2" align="center">
                            <button type="submit" name="cancel" class="button" formaction="manageAccountS.php">Cancel</button>
                        </td>
                    </tr>                   
        			<?php
                    }
        			?>
        		</table>
        	</td>
        </tr>
		</table>
	</form>
</div>

<?php

if (isset($_POST['update'])) {

    $sid = $_GET['id'];
    $uname = $_POST['uname'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $record = "UPDATE student_info SET S_Username = '$uname', Security_Question = '$question' , Security_Answer = '$answer' WHERE S_Id = '$sid' ";

    if (mysqli_query($con, $record)) {
        //echo "Data Inserted ";
    } 
    if($record){
        $_SESSION['status']="Data Updated";
        $_SESSION['status_code']="success";
    }
    else{
        $_SESSION['status']="data is not inserted";
        $_SESSION['status_code']="error";
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
