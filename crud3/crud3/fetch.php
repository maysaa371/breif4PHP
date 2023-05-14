<?php
require 'config.php';
$output ='';
$sql="SELECT * FROM users WHERE name LIKE '%".$_POST['search']."%'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    $output .='<h4 align="center">Search Result</h4>';
    $output .=' <div class="table-responsive">
             <table class="table table bordered">
             <tr>
             <th> Name</th>
             <th>Contact</th>
             <th>Address</th>
             <th>Email</th>
            
             </tr>';

            while($row=mysqli_fetch_array($result))
            {
                $output .=
                '<tr>
                <td>'.$row["name"].'</td>
                <td>'.$row["contact"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$row["email"].'</td>
                
                
                </tr>';
            }
            echo $output;
}
else{
    echo 'Data Not Found';
}
?>
