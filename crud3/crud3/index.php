<?php
// Include config file
                    require_once 'config.php';
                    
                    // Define variables and initialize with empty values
                    // $search = "";
                    
                    // Processing form data when form is submitted
                    // if($_SERVER["REQUEST_METHOD"] == "GET"){
                    //     // Validate search query
                    //     $search = trim($_GET["search"]);
                    // }
                    
                    // Attempt select query execution
                    // $sql = "SELECT * FROM users";
                    // if(!empty($search)){
                    //     $sql .= " WHERE name LIKE '%" . $mysqli->real_escape_string($search) . "%' OR address LIKE '%" . $mysqli->real_escape_string($search) . "%'";
                    // }
                    ?>
                   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<!-- <form name="form1" method="get" id="search-form">
		<input type="text" placeholder="Search" name="search" aria-label="Search" required>
		<input type="submit" value="Search" name="submit"></input>

	</form>
<div id="search-results"></div> -->


   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            <div class="search">
                            <div class="input-group mb-4 mt-3">
                                <div class="form-outline">
                                    <label for="search">search:</label>
                                    <input type="text" id="getName" name="getName" />
                                </div>
                            </div>
                        </div>
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        
                        <h2 class="pull-left">Customers Details</h2>
                        <a href="create.php" class="btn btn-danger pull-right">Add New Customer</a>
                    </div>
                    <?php
                    // Include config file
                    require_once 'config.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM users";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Password</th>";
                                        echo "<th>Image</th>";
                                     
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody id='showdata'>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['contact'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td><img src='" . $row['avatar'] . "' width='50'></td>";
                                       
                                        // echo "<td>".$row['image']."</td>";
                                      
      
                                        echo "<td>";
                                       
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    ?>
                </div>
            </div>        
        </div>
    </div>
 <?php   
$mysqli->close();
?>
<script>
        $(document).ready(function() {
            $('#getName').on("keyup", function() {
                var getName = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: 'search.php',
                    data: {
                        name: getName
                    },
                    success: function(response) {
                        $("tbody").html(response);
                    }
                });
            });
        });
    </script>

</body>
</html>
