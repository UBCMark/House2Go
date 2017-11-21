<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer View</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="customer.css">

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


<h1 class="text-center">Customer View</h1>

<div class="column">


        <div class="search-house">
            <label>Customer Looking for House</label>
            <form method="POST" action="customer.php">
                <!--refresh page when submit-->

                <p><input type="text" name="housetype" placeholder="House Type">
                    <input type="text" name="rating" placeholder="Rating">
                    <input type="text" name="starttime" placeholder="Start Time">
                    <input type="text" name="endtime" placeholder="End Time"> </p>

                <p><input type="submit" value="Find House!" name="findhouse"></p>
        </div>
    </form>


        <div class="reserve house">
            <label>Reserve your house!</label>
            <form method="POST" action="customer.php">
                <!--refresh page when submit-->

                <p><input type="text" name="house_id" placeholder="House ID">
                    <input type="text" name="customer_id" placeholder="Customer ID">
                    <input type="text" name="starttime" placeholder="Start Date - yyyy/mm/dd">
                    <input type="text" name="endtime" placeholder="End Date - yyyy/mm/dd"> </p>

                <p><input type="submit" value="Reserve!" name="reservehouse"></p>
        </div>
    </form>

    <div class="Change-StartTime">
        <label>Change Time</label>

        <form method="post" action="customer.php">
            <!-- refresh page -->
            <input type="text" name="refn" placeholder="Reservation Reference#">
            <input type="text" name="stime" placeholder="Start Time">
            <input type="text" name="etime" placeholder="End Time">



            <p><input type="submit" value = "Change Time" name="changetimesubmit"></p>
    </div>
    </form>

    <div class="accepted">
        <label>See My Accepted Reservation</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID"></p>

            <p><input type="submit" value="See Accepted Reservation" name="accepted"></p>
    </div>
    </form>

    <div class="pay">
        <label>Make Payment Below (Sign Contract)</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID">
                <input type="text" name="refno" placeholder="Reference No">
                <input type="text" name="cardtype" placeholder="Card Type">
                <input type="text" name="cardname" placeholder="Name on Card">
                <input type="text" name= "card#" placeholder="Card Number">
            </p>

            <p><input type="submit" value="Accept and Pay!" name="pay"></p>
    </div>
    </form>

    <div class="payment history">
        <label>Payment History</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID">


            <p><input type="submit" value="See my payments" name="paymenthistory"></p>
    </div>
    </form>



    <!--    update P-->
    <!--    set P.START_TIME = '$bind1'-->
    <!--    from TIMEPERIOD P-->
    <!--    where P.RESERVATION_REFERENCE# = '$bind2'-->
    <div class="show contract time">
        <label>Show Booked Time</label>

        <form method="post" action="customer.php">
            <!-- refresh page -->
            <input type="text" name="thid" placeholder="House ID">

            <p><input type="submit" value = "Show Now" name="showunavailablesubmit"></p>
    </div>
    </form>


    <div class="Register for Member!">
        <label>Register for Member</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID">


            <p><input type="submit" value="Become Member!" name="register"></p>
    </div>
    </form>

    <div class="Quit Member!">
        <label>Quit Member</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID">


            <p><input type="submit" value="Quit Member!" name="quit"></p>
    </div>
    </form>

    <div class="mycontracts">
        <label>What I signed...</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="customer_id" placeholder="Customer ID">

            <p><input type="submit" value="Show my Contracts!" name="contracts"></p>
    </div>
    </form>


    <div class="averagerating">
        <label> Average Rating</label>
        <form method="POST" action="customer.php">
            <!--refresh page when submit-->

            <p><input type="text" name="type" placeholder="House Type"></p>

            <p><input type="submit" value="Average Rating" name="mean"></p>
    </div>
    </form>

    <div class="Member-pay">
        <label>Member Pay</label>

        <form method="post" action="customer.php">
            <!-- refresh page -->
            <input type="text" name="conid" placeholder="Reference#">
            <input type="text" name="cusid" placeholder="Customer ID">
            <input type="text" name="cardtype" placeholder="Card Type">
            <input type="text" name="cardname" placeholder="Name on Card">
            <input type="text" name= "card#" placeholder="Card Number">

            <p><input type="submit" value = "Pay" name="memberpaysubmit"></p>
    </div>
    </form>
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>


<?php

include_once "main.php"; // this will include main.php

?>