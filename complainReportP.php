<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style2.css">
<?php
include 'principalDashboard.php';
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
                <h2 class="heading">Complain Report</h2>
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
                <table class="table3" border="1">
                    <tr>    
                        <th>Complain ID</th>
                        <th>Student Name</th>
                        <th>Complain About</th>
                        <th>Complain Message</th>
                        <th>Reply</th>
                    </tr>
                    <?php

                    $standard = $_POST['Standard'];
                    $division = $_POST['Division'];

                    $result = mysqli_query($con, "SELECT student_info.S_Name, student_info.S_RollNo, student_info.S_Standard, student_info.S_Division, complain_info.C_About, complain_info.C_Id, complain_info.C_Message, complain_info.C_Reply, complain_info.C_Id FROM student_info INNER JOIN complain_info on student_info.S_Id=complain_info.S_Id WHERE student_info.S_Standard = '$standard' AND student_info.S_Division = '$division'");

                    while ($res= mysqli_fetch_array($result)) {
                        
                        echo "<tr>";
                        $id = $res['C_Id'];
                        echo "<td>".$res['C_Id']."</td>";
                        echo "<td>".$res['S_Name']."</td>";
                        echo "<td>".$res['C_About']."</td>";
                        echo "<td>".$res['C_Message']."</td>";
                        echo "<td>".$res['C_Reply']."</td>";
                        echo "</tr>";
                    }                                       
                    ?>                  
                </table>
            </td>
        </tr>
        <?php
    }
        ?>
    </table>
</form>
</div>