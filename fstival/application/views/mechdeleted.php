<?php 
    include 'dbconnector.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Completed Tasks</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/icon" href="http://localhost/fstival/icons/logo.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        $details_query = "SELECT * FROM users WHERE id='$userid'";
        $details_result = mysqli_query($connection,$details_query);
        $details_attr = mysqli_fetch_assoc($details_result);
    ?>

    <nav  class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img style="width: 40px; height: 40px; border-radius: 50%;" src="<?php echo $details_attr["url"]; ?>" alt="">
            <?php echo $details_attr["name"]; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div style="margin-left: 35%;">
            <img style="height: 50px;" src="http://localhost/fstival/icons/titleicon.png" alt="">
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active list">
                    <a class="nav-link ho" href="../home/welcome" style="font-size: 18px;">Mechanic Near Me</a>
                </li>
                <li class="nav-item active list">
                    <a class="nav-link" href="../home/myrequest" style="font-size: 18px;">My Requests</a>
                </li>
                <li class="nav-item active list">
                    <a class="nav-link" href="../home/usercompleted" style="font-size: 18px; color: #59bac9;">Completed</a>
                </li>
                <li class="nav-item active list">
                    <a class="nav-link" href="../home/logout" style="font-size: 18px;">
                        <i class="fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
    	<div class="table-responsive">
    	<table class="table" id="table">
    		<thead>
    			<th width="10%">D.P.</th>
    			<th width="25%">Mechanic Name</th>
    			<th width="25%">Occupation</th>
    			<th width="40">Work Purpose</th>
    		</thead>
    		<tbody>
                <?php 
                    $get_list_query = "SELECT * FROM deletetask WHERE userid='$userid'";
                    $get_list_result = mysqli_query($connection,$get_list_query);
                    
                    $get_list_count = mysqli_num_rows($get_list_result);
                    if ($get_list_count > 0) {
                        while ($get_list_attr = mysqli_fetch_array($get_list_result)) {
                            $mechid = $get_list_attr["mechid"];
                            $mechanic_details_query = "SELECT * FROM users WHERE id='$mechid'";
                            $mechanic_details_result = mysqli_query($connection,$mechanic_details_query);
                            
                            $mechanic_details_attr = mysqli_fetch_assoc($mechanic_details_result);
                            ?> 
                            <tr>
                            	<td>
                            		<img style="width: 30px; height: 30px; border-radius: 50%;" src="<?php echo $mechanic_details_attr['url']; ?>" alt="dp">
                            	</td>
                            	<td><?php echo $mechanic_details_attr["name"]; ?></td>
                            	<td><?php echo $mechanic_details_attr["occupation"]; ?></td>
                            	<td><?php echo $get_list_attr["purpose"]; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                        	<td>-</td>
                        	<td>No Completed Tasks</td>
                        	<td>-</td>
                        	<td>-</td>
                        </tr>
                        <?php
                    }
                ?>
    		</tbody>
    	</table>
    </div>
    </div>
</body>
<style type="text/css">
	tbody {
		background: #fff;
	} 

	tbody:hover {
		background: #ccc;
	}
</style>
</html>