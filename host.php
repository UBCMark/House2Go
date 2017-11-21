<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host View123</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="host.css">

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


<h1 class="text-center">Host View</h1>

<div class="column">
    <div class="add-host">
        <label>Add New House</label>
        <form method="post" action="host.php">
            <!-- refresh page -->
            <input type="text" name="hid" placeholder="House ID">
            <input type="text" name="loc" placeholder="House Location">
            <input type="text" name="ava" placeholder="House Availability">
            <input type="text" name="rules" placeholder="House Rules">
            <input type="text" name="rating" placeholder="House Rating">
            <input type="text" name="host_id" placeholder="Your Host ID">
            <input type="text" name="type" placeholder="House Type">

            <p><input type="submit" value="Add My House!" name="inserthousesubmit"></p>
    </div>
    </form>


    <div class="Host-Revenue">
        <label>Host Revenue</label>

        <form method="post" action="host.php">
            <!-- refresh page -->
            <input type="text" name="hostid" placeholder="Host ID">
            <input type="text" name="stime" placeholder="Start Time">
            <input type="text" name="etime" placeholder="End Time">

            <p><input type="submit" value = "Revenue" name="hostrevenuesubmit"></p>
    </div>
    </form>

    <div class="reservations">
        <label>See my reservations</label>
        <form method="POST" action="host.php">
            <!--refresh page when submit-->

            <p><input type="text" name="host_id" placeholder="My Host ID"></p>

            <p><input type="submit" value="See my reservations" name="reservations"></p>
    </div>
    </form>


    <div class= "Take Reservation">
        <label>Take Reservation</label>
        <form method="POST" action="host.php">
            <!--refresh page when submit-->

            <p><input type="text" name="refno" placeholder="Reference#"></p>
            <p><input type="text" name="host_id" placeholder="My Host ID"></p>

            <p><input type="submit" value="See my reservations" name="takereservation"></p>
    </div>
    </form>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

<?php

include_once "main.php"; // this will include main.php

?>