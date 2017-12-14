<?php
    session_start();
    require "session_check.php";
    require "connect.php";
    require "product_functions.php";
    if(isset($_SESSION['email'])){
       $user_type = $_SESSION['user_type'];
       
    }else{
        header("location:login.php");
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Individual sales details | Strore Management</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Store Management
                </a>
            </div>

            <ul class="nav">
                <?php
                    if($user_type){
                ?>
                <li>
                    <a href="productAdd.php">
                        <i class="pe-7s-user"></i>
                        <p>Product Add</p>
                    </a>
                </li>
                <li >
                    <a href="productList.php">
                        <i class="pe-7s-note2"></i>
                        <p>Products List</p>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li >
                    <a href="sales.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Sales</p>
                    </a>
                </li>
                <?php
                    if($user_type){
                ?>
                <li class="active">
                    <a href="salesReport.php">
                        <i class="pe-7s-science"></i>
                        <p>Sales Report</p>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li >
                    <a href="individualSalesReport.php">
                        <i class="pe-7s-science"></i>
                        <p>Self Sales Report</p>
                    </a>
                </li>
                <?php
                    if($user_type){
                ?>
                <li >
                    <a href="usersList.php">
                        <i class="pe-7s-science"></i>
                        <p>Users List</p>
                    </a>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(isset($_SESSION['email'])){
                        echo '<li class="active-pro">';
                            echo '<a href="logout.php">';
                                echo '<i class="pe-7s-rocket"></i>';
                               echo '<p>Logout</p>';
                            echo '</a>';
                        echo '</li>';
                    }
                ?>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Product</a>
                </div>
                <div class="collapse navbar-collapse">
                    <!--
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">5</span>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                -->
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <?php
                                    $id = $_GET['id'];
                                ?>
                                <h4 class="title"><b><?php echo $id; ?></b> Details</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>S.No</th>
                                    	<th>Product Code</th>
                                    	<th>Unit Price</th>
                                    	<th>Quantity</th>
                                        <th>Total Price</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            $query = mysql_query("select * from purchaseitems where id='$id'");
                                            $i = 1;
                                            while($row = mysql_fetch_assoc($query)){
                                                echo "<tr>";
                                                    echo '<td>'.$i.'</td>';
                                                    echo '<td>'.$row['code'].'</td>';
                                                    echo '<td>'.$row['unitPrice'].' /-</td>';
                                                    echo '<td>'.$row['quantity'];
                                                    
                                                    echo '</td>'; 
                                                    echo '<td>'.$row['totalPrice'].'</td>';
                                                    
                                                echo '</tr>';
                                                $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="form-group pull-right" >
                                            <label>Total Price</label>
                                            <input type="text" class="form-control" value="<?php
                                                $q = mysql_query("select * from purchases where id='$id'");
                                                $a = mysql_fetch_array($q);
                                                echo $a['price'];
                                            ?>" disabled="" style="margin-right: 10px"  />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <!--
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                -->
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Strore Management</a>
                </p>
            </div>
        </footer>


    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>