<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management View</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="management.css">


    <style>


    </style>
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a href="index.html" class="navbar-brand"><i class="glyphicon glyphicon-phone"></i>House2Go</a>
            <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggle collapsed"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="active"><a href="customer.php">Customer </a></li>
                <li role="presentation"><a href="host.php">Host </a></li>
                <li role="presentation"><a href="management.php">Management </a></li>
            </ul>
        </div>
    </div>
</nav>




<h1 class="text-center">Management View</h1>

<div class="column">

    <div class="add-cus">
        <label>Add Customer</label>

        <form method="POST" action="management.php">
            <p><input type="text" name="cid" placeholder="Customer ID">
                <input type="text" name="cnam" placeholder="Name">
                <input type="text" name="cem" placeholder="Email">
                <input type="text" name="cph" placeholder="Phone">
                <input type="text" name="crat" placeholder="Rating">
                <input type="text" name="cadd" placeholder="Address"></p>


            <p><input type="submit" value="Insert!" name="insertsubmit"></p>

        </form>
    </div>

    <div class="update-cus">
        <label>Update Customer</label>

        <form method="post" action="management.php">
            <!-- refresh page -->
            <input type="text" name="cid" placeholder="Customer ID">
            <input type="text" name="cnam" placeholder="Name">
            <input type="text" name="cem" placeholder="Email">
            <input type="text" name="cph" placeholder="Phone">
            <input type="text" name="crat" placeholder="Rating">
            <input type="text" name="cadd" placeholder="Address">

            <p><input type="submit" value="Update" name="updatesubmit"></p>
        </form>
    </div>

    <div class="remove-cus">
        <label>Remove Customer</label>

        <form method="post" action="management.php">
            <!-- refresh page -->
            <input type="text" name="cid" placeholder="Customer ID">

            <p><input type="submit" value="Remove" name="removesubmit"></p>
        </form>
    </div>


    <div class="add-host">
        <label>Add Host</label>

        <form method="post" action="management.php">
            <!-- refresh page -->
            <input type="text" name="hid" placeholder="Host ID">
            <input type="text" name="hnam" placeholder="Name">
            <input type="text" name="hph" placeholder="Phone">
            <input type="text" name="hadd" placeholder="Address">


            <p><input type="submit" value="Insert" name="inserthostsubmit"></p>
        </form>
    </div>


    <div class="update-host">
        <label>Update Host</label>

        <form method="post" action="management.php">
            <!-- refresh page -->
            <input type="text" name="hid" placeholder="Host ID">
            <input type="text" name="hnam" placeholder="Name">
            <input type="text" name="hph" placeholder="Phone">
            <input type="text" name="hadd" placeholder="Address">

            <p><input type="submit" value="Update" name="updatehostsubmit"></p>
        </form>
    </div>


    <div class="remove-host"
    <label>Remove Host</label>

    <form method="post" action="management.php">
        <!-- refresh page -->
        <input type="text" name="hid" placeholder="Host ID">

        <p><input type="submit" value="Remove" name="removehostsubmit"></p>
    </form>
</div>


<div class="getcontract">
    <label>Contract History Lookup</label>
    <form method="POST" action="management.php">
        <!--refresh page when submit-->

        <p><input type="text" name="s_date" placeholder="From When?">
            <input type="text" name="card_type" placeholder="Card Type"></p>


        <p><input type="submit" value="Look Up Contract" name="contracthistory"></p>
    </form>
</div>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>


<?php

include_once "main.php"; // this will include main.php

?>