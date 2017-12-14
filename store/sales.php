<?php
    session_start();
    require "session_check.php";
    require "connect.php";
    require "sales_functions.php";
    if(isset($_SESSION['email'])){
       $user_type = $_SESSION['user_type'];
    }else{
        header("location:login.php");
    }

    if(isset($_POST['submit'])){
        //echo "<script>alert('ra');</script>";
        $i = 1;
        $id = time().rand(100000,999999);
        $date = date("Y-m-d H:i:s");
        $totalItems = 0;
        $error = false;
        while(isset($_POST["inputName".$i])){
            $code = $_POST['inputCode'.$i];
            $quantity = $_POST['inputQuantity'.$i];
            $unitPrice = $_POST['inputUnitPrice'.$i];
            $totalPrice = $_POST['inputTotalPrice'.$i];
            
            //if adding of items is failed
            if(!purchaseItemsAdd($connection,$id,$code,$quantity,$unitPrice,$totalPrice)){
                $error = true;
                break;
            }
            $i++;
            
        }
        $totalItems = $i - 1;
        $price = $_POST['ss'];
        $shopKeeperEmail = $_SESSION['email'];
        

        if(!$error && purchaseAdd($connection,$id,$totalItems,$price,$shopKeeperEmail,$date)){
            echo '<script>alert("Purchase added successfully");</script>';
        }else{
            echo '<script>alert("Failed to add the purchase");</script>';
        }

    }
?>
<!doctype html>
<html lang="en">
<head>
    <style type="text/css">
        /* Dropdown Button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;

}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
    background-color: white;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {

    display: none;
    max-height: 175px;

    overflow-y: scroll;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    min-width: 98%;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
    </style>
    <script type="text/javascript">
        var sno = 1;   
        var totalPrice = 0;
        
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.add("show");
    var hint = document.getElementById("hint").value;
    var text = "";
    if(hint.length!=0){
             $.ajax({
                url: "loadProductDetails.php",
                type: "post",
                data: {hint:hint},
                success: function (response) {
                   // you will get response from your php page (what you echo or print)   
                   var i = 0;
                   response = jQuery.parseJSON(response);
                   
                    while(i < response.length){
                        text += '<a href="#" onclick="insert('+"'"+response[i]['code']+"'"+')">'+response[i]['name']+'</a>';
                        
                        i++;
                    }
                    document.getElementById('myDropdown').innerHTML = text;
                },
                error: function() {
                   
                }
            });
        }
    
}
function insert(code){
    document.getElementById("hint").value = "";
    $.ajax({
                url: "loadProductDetails2.php",
                type: "post",
                data: {code:code},
                success: function (response) {
                   // you will get response from your php page (what you echo or print)   
                   var i = 0;
                    var text = "";
                    response = jQuery.parseJSON(response);
                    var xTable=document.getElementById('myTable');
                    var tr=document.createElement('tr');

                    text += '<td>'+sno+'</td><td><input class="form-control col-md-3" name="inputName'+sno+'" value="'+response[0]['name']+'" ><td> <input class="form-control" name="inputCode'+sno+'" id="inputCode'+sno+'" value="'+response[0]['code']+'"  /></td>';
                    text += '<td> <input id="inputUnitPrice'+sno+'" name="inputUnitPrice'+sno+'" value="'+response[0]['mrp']+'"   class="form-control col-md-1" /> </td><td><input class="form-control" type="text" onkeyup="calculateTotalAmount('+"'"+sno+"'"+')" name="inputQuantity'+sno+'" id="inputQuantity'+sno+'" value="1"/></td><td> <input class="form-control" id="inputTotalPrice'+sno+'" name="inputTotalPrice'+sno+'" value="'+response[0]['mrp']+'"  /></td>';
                    tr.innerHTML = text;
                    xTable.appendChild(tr);

                    
                    
                    

                    document.getElementById('myDropdown').innerHTML = "";
                    

                    sno++;
                    ramaiah();
                    
                },
                error: function() {
                   
                }
            });
}
function ramaiah(){
    var t = 0;
    var i = 1;
    while(i < sno){
        t += Number(document.getElementById("inputTotalPrice"+i).value);
        i++;
    }
    document.getElementById('totalPrice').value = t;

}
function calculateTotalAmount(sno){
    var inputUnitPrice = Number(document.getElementById("inputUnitPrice"+sno).value);
    var inputQuantity = Number(document.getElementById("inputQuantity"+sno).value);
    document.getElementById('inputTotalPrice'+sno).value = inputUnitPrice * inputQuantity;
    ramaiah();
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    </script>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sales | Strore Management</title>

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
                <li>
                    <a href="productList.php">
                        <i class="pe-7s-note2"></i>
                        <p>Products List</p>
                    </a>
                </li>
                <?php
                    }
                ?>
                <li class="active">
                    <a href="sales.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Sales</p>
                    </a>
                </li>
                <?php
                    if($user_type){
                ?>
                <li >
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
                        <div class="card ">
                            
                            <div class="content ">
                                    

                                <div class="dropdown ">
                                    <label>Enter product name or code</label>
                                    <input type="text" onkeyup ="myFunction()" id="hint" class="dropbtn form-control" style="width:400px">
                                    
                                    <div id="myDropdown" class="dropdown-content">
                                        
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Total Items</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <form method="post">
                                    
                                    <table class="table table-hover table-striped" >
                                        <thead>
                                            <th>S.No</th>
                                        	<th>Name</th>
                                        	<th>Code</th>
                                        	<th>Each unit price</th>
                                        	<th>Quantity</th>
                                            <th>Total price</th>
                                            
                                        </thead>
                                        <tbody id="myTable">
                                            
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-3 pull-right">
                                            <label class=""><b>Total Price</b></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control col-md-2" placeholder="total price" name="ss" id="totalPrice" value=""  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 pull-right">

                                            <div class="form-group">
                                                <input style="background-color: #eaeaea " type="submit" class="btn btn-success form-control col-md-2" placeholder="Name" required="" name="submit" value="Proceed to checkout">
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

    

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>