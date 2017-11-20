<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host View</title>
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


    <div class="Host Revenue">
        <label>Host Revenue</label>

        <form method="post" action="host.php">
            <!-- refresh page -->
            <input type="text" name="hostid" placeholder="Host ID">
            <input type="text" name="stime" placeholder="Start Time">
            <input type="text" name="etime" placeholder="End Time">

            <p><input type="submit" value = "Revenue" name="Hostrevenuesubmit"></p>
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
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>


<?php

session_start();


//this tells the system that it's no longer just parsing
//html; it's now parsing PHP

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_f4l0b", "a60250157", "dbhost.ugrad.cs.ubc.ca:1522/ug");

function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the
        // connection handle
        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
        echo htmlentities($e['message']);
        $success = False;
    } else {

    }
    return $statement;

}

function executeBoundSQL($cmdstr, $list) {
    /* Sometimes the same statement will be executed for several times ... only
     the value of variables need to be changed.
     In this case, you don't need to create the statement several times;
     using bind variables can make the statement be shared and just parsed once.
     This is also very useful in protecting against SQL injection.
     See the sample code below for how this functions is used */

    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr);

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
        echo htmlentities($e['message']);
        $success = False;
    }

    foreach ($list as $tuple) {
        foreach ($tuple as $bind => $val) {
            //echo $val;
            //echo "<br>".$bind."<br>";
            OCIBindByName($statement, $bind, $val);
            unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

        }
        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($statement); // For OCIExecute errors pass the statement handle
            echo htmlentities($e['message']);
            echo "<br>";
            $success = False;
        }
    }

}


function printcontracts($result)
{ //prints results from a select statement
    echo "<br>These are your contracts:<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<tr><th>House Location</th><th>House Rating</th><th>Daily Rate</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        // echo $row[0];
        echo '<tr>';
        echo "<td>" . $row["HOUSE_LOCATION"] . "</td><td>" . $row["HOUSE_RATING"] . "</td><td>" . $row["TYPE_DAILYRATE"] . "</td>"; //or just use "echo $row[0]"
        echo '</tr>';
    }
    echo "</table>";
}
function printpayments($result)
{ //prints results from a select statement
    echo "<br>These are your payments<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<tr><th> Payment ID</th><th> Payment Amount</th><th> Payment Method </th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo '<tr>';
        echo "<td>" . $row["PAYMENT_ID"] . "</td><td>" . $row["PAYMENT_AMOUNT"] . "</td><td>" . $row["PAYMENT_CARDTYPE"] . "</td>";
        echo '</tr>';
    }
    echo "</table>";


}

function printResult($result) { //prints results from a select statement
    echo "<br>Got data from table tab1:<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<tr><th>HOUSE ID</th><th>Location</th><th>Availability</th><th>House Rules</th><th>House Rating</th><th>Host ID</th><th>House Type</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo '<tr>';
        echo "<td>" . $row["HOUSE_ID"] . "</td><td>" . $row["HOUSE_LOCATION"] . "</td><td>" . $row["HOUSE_AVAILABILITY"] . "</td></tr>"
            . $row["HOUSE_RULES"] . "</td><td>" . $row["HOUSE_RATING"] . "</td><td>" . $row["HOST__ID"] . "</td></tr>". $row["TYPE__NAME"] . "</td>"; //or just use "echo $row[0]"
        echo '</tr>';;
    }
    echo "</table>";

}

function printHouses($result)
{
    echo "<br>These are your houses:<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<tr><th>host ID</th><th>House ID</th><th>Location</th><th>type</th><th>rating</th><th>initial charge</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo '<tr>';
        echo "<td>" . $row["HOST_ID"] . "</td><td>" . $row["HOUSE_ID"] . "</td><td>" . $row["HOUSE_LOCATION"] . "</td><td>" . $row["TYPE_NAME"] . "</td><td>"
            . $row["HOUSE_RATING"] . "</td><td>" . $row["TYPE_INITIALCHARGE"] . "</td>";
        echo '</tr>';
    }
    echo "</table>";
}

function   printreservations($result) {
    echo "<br>These are reservations you've received:<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<tr><th>reservation reference#</th><th>customer id</th><th>host id </th><th>house id</th><th>reservation status </th><th>start time</th><th>end time</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo '<tr>';
        echo "<td>" . $row["RESERVATION_REFERENCE#"] . "</td><td>" . $row["CUSTOMER_ID"] . "</td><td>" . $row["HOST_ID"] . "</td><td>" . $row["HOUSE_ID"] . "</td><td>"
            . $row["RESERVATION_STATUS"] . "</td><td>" . $row["START_TIME"] . "</td><td>" . $row["END_TIME"] . "</td>";
        echo '</tr>';
    }
    echo "</table>";
}

function   printaccepted($result) {
    echo "<br>These are your accepted reservations:<br>";
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo "<th><th>reservation reference#</th><th>customer id</th><th>host id </th><th>house id</th><th>reservation status </th><th>start time</th><th>end time</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo '<tr>';
        echo "<td>" . $row["RESERVATION_REFERENCE#"] . "</td><td>" . $row["CUSTOMER_ID"] . "</td><td>" . $row["HOST_ID"] . "</td><td>" . $row["HOUSE_ID"] . "</td><td>"
            . $row["RESERVATION_STATUS"] . "</td><td>" . $row["START_TIME"] . "</td><td>" . $row["END_TIME"] . "</td>";
        echo '</tr>';
    }
    echo "</table>";
}


// Connect Oracle...
if ($db_conn) {


    if (array_key_exists('pay', $_POST)) {

        $bind1 = $_POST['customer_id'];
        $bind2 = $_POST['refno'];
        $bind3 = $_POST['cardtype'];
        $bind4 = $_POST['cardname'];
        $bind5 = $_POST['card#'];

        $query01 = "select reservation.house_id
            from reservation 
            where reservation.reservation_reference# = '$bind2'";
        $query02 = "select reservation.customer_id
            from reservation 
            where reservation.reservation_reference# = '$bind2'";
        $query03 = "select reservation.host_id
            from reservation 
            where reservation.reservation_reference# = '$bind2'";

        $query04 = "select reservation.reservation_status
            from reservation 
            where reservation.reservation_reference# = '$bind2'";

        $statement01 = oci_parse($db_conn, $query01);
        oci_execute($statement01);
        $houseid = OCI_Fetch_Array($statement01,OCI_BOTH)[0];


        $statement02 = oci_parse($db_conn, $query02);
        oci_execute($statement02);
        $cid = OCI_Fetch_Array($statement02,OCI_BOTH)[0];

        $statement03 = oci_parse($db_conn, $query03);
        oci_execute($statement03);
        $hostid = OCI_Fetch_Array($statement03,OCI_BOTH)[0];

        $statement04 = oci_parse($db_conn, $query04);
        oci_execute($statement04);
        $status = OCI_Fetch_Array($statement04,OCI_BOTH)[0];


        if ($bind1 != $cid) {
            echo "wrong name";
            return;
        };

        if ($status != 'accepted') {
            echo "Invalid Reservation!!";
            return;
        };



        $number = mt_rand (10000,99999);
        $conID = mt_rand (10000,99999);
        $query1 = "select type_initialcharge
            from reservation c, house h, housetype ht
            where c.reservation_reference# = '$bind2' AND c.house_id = h.house_id AND h.type_name = ht.type_name";

        $query4 = "select type_dailyrate
            from reservation c, house h, housetype ht
            where c.reservation_reference# = '$bind2' AND c.house_id = h.house_id AND h.type_name = ht.type_name";

        $query2 = "select member_rewardpoints
            from member
            where customer_id = '$bind1'";

        $query3 = "select end_time-start_time
            from reservation c,timeperiod t
            where c.reservation_reference# = t.reservation_reference# AND reservation_reference# = '$bind2'";

        $statement1 = oci_parse($db_conn, $query1);
        oci_execute($statement1);
        $result1 = OCI_Fetch_Array($statement1,OCI_BOTH);

        $statement4 = oci_parse($db_conn, $query4);
        oci_execute($statement4);
        $result4 = OCI_Fetch_Array($statement4,OCI_BOTH);

        $statement2 = oci_parse($db_conn, $query2);
        oci_execute($statement2);
        $result2 = OCI_Fetch_Array($statement2,OCI_BOTH);

        $statement3 = oci_parse($db_conn, $query3);
        oci_execute($statement3);
        $result3 = OCI_Fetch_Array($statement3,OCI_BOTH);


        $amount = $result1[0] + $result4[0] * $result3[0];
        echo  $amount;
        $queryi001 = "insert into payment values ('$number', '$amount', '$bind3', '$bind4', '$bind5', 0)";
        $queryi002 = "insert into contract values ('$conID', '$bind2', '$bind1', '$hostid', '$number', '$houseid')";
        $queryi003 = "update reservation set reservation_status = 'paid' where reservation_reference# = '$bind2'";

        $statement001 = oci_parse($db_conn, $queryi001);
        $statement002 = oci_parse($db_conn, $queryi002);
        $statement003  = oci_parse($db_conn, $queryi003);
        oci_execute($statement001);
        oci_execute($statement002);
        oci_execute($statement003);


        echo 'Paid!! Your Payment id is :' . $number;

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }
    if (array_key_exists('accepted', $_POST)) {

        $bind1 = $_POST['customer_id'];

        $queryi = "select * from reservation join timeperiod on reservation.reservation_reference# = timeperiod.reservation_reference# where customer_id = '$bind1' AND reservation_status = 'accepted'";

        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        printaccepted($statement);
        echo 'Take Reservation Successfully!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('takereservation', $_POST)) {

        $bind1 = $_POST['refno'];
        $bind2 = $_POST['host_id'];

        $queryi = "select * from reservation where reservation_reference# = '$bind1'";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            if ($row["HOST_ID"] != $bind2) {
                echo "Sorry, you don't have this reservation";
                return;
            }
        }

        $queryi = "update reservation set reservation_status = 'accepted' where reservation_reference# = '$bind1'";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'Take Reservation Successfully!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }
    if (array_key_exists('reservations', $_POST)) {

        $bind1 = $_POST['host_id'];


        $queryi = "select * from reservation join timeperiod on reservation.reservation_reference# = timeperiod.reservation_reference# where reservation.host_id = '$bind1'
                                    ";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        printreservations($statement);
        echo 'insert success!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('insertsubmit', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['cid'];
        $bind2 = $_POST['cnam'];
        $bind3 = $_POST['cem'];
        $bind4 = $_POST['cph'];
        $bind5 = $_POST['crat'];
        $bind6 = $_POST['cadd'];

        //":bind7" => $_POST['crp']

        $queryi = "insert into customer values ('$bind1', '$bind2', '$bind3', $bind4, $bind5, '$bind6')";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'insert success!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }
    if (array_key_exists('removesubmit', $_POST)) {
        // get the values from user and delete data row from table
        //$tuple = array(":delNum" => $_POST['delNum']);
        //$alltuples = array($tuple);

        $bindde = $_POST['cid'];
        $queryd = "delete from customer where CUSTOMER_ID='$bindde'";

        $statement = oci_parse($db_conn, $queryd);
        oci_execute($statement);
        echo 'see you!';

        //executeBoundSQL("delete from CUSTOMER where nid=:delNum", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('updatesubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['cid'];
        $bind2 = $_POST['cnam'];
        $bind3 = $_POST['cem'];
        $bind4 = $_POST['cph'];
        $bind5 = $_POST['crat'];
        $bind6 = $_POST['cadd'];



        $queryu = "update customer set CUSTOMER_NAME='$bind2', CUSTOMER_EMAIL='$bind3', CUSTOMER_PHONE='$bind4', CUSTOMER_RATING='$bind5', CUSTOMER_ADDRESS='$bind6' where CUSTOMER_ID='$bind1'";
        $statement = oci_parse($db_conn, $queryu);
        oci_execute($statement);
        echo 'update success!';

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);

    }

    if (array_key_exists('inserthostsubmit', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['hid'];
        $bind2 = $_POST['hnam'];
        $bind3 = $_POST['hph'];
        $bind4 = $_POST['hadd'];

        //":bind7" => $_POST['crp']

        $queryi = "insert into host values ('$bind1', '$bind2', '$bind3', '$bind4')";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'process....
                          host add complete!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);

    }

    if (array_key_exists('updatehostsubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['hid'];
        $bind2 = $_POST['hnam'];
        $bind3 = $_POST['hph'];
        $bind4 = $_POST['hadd'];


        $queryuh = "update host set HOST_NAME='$bind2', HOST_PHONE='$bind3', HOST_ADDRESS='$bind4' where HOST_ID='$bind1'";
        $statement = oci_parse($db_conn, $queryuh);
        oci_execute($statement);
        echo 'process....
                          new info updated!';

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);

    }

    if (array_key_exists('removehostsubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bindde = $_POST['hid'];

        $queryd = "delete from host where HOST_ID='$bindde'";

        $statement = oci_parse($db_conn, $queryd);
        oci_execute($statement);
        echo 'Attention! This is a DANGEROUS action....
                          delete host complete';

        //executeBoundSQL("delete from CUSTOMER where nid=:delNum", $alltuples);

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);

    }


    if (array_key_exists('changetimesubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['refn'];
        $bind2 = $_POST['stime'];


        $queryct = "update P
            set P.START_TIME = '$bind2'
            from TIMEPERIOD P
            where P.RESERVATION_REFERENCE# = '$bind1'";

        $statement = oci_parse($db_conn, $queryct);
        oci_execute($statement);
        echo "Your MOVE-IN time change to '$bind2'.";

        //executeBoundSQL("delete from CUSTOMER where nid=:delNum", $alltuples);

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);
    }


    if (array_key_exists('contracthistory', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['s_date'];
        $bind2 = $_POST['card_type'];


        $queryht = " select contract_id
        from contract c, payment p, timeperiod t
          where c.payment_id = p.payment_id AND c.reservation_reference# = t.reservation_reference# AND p.payment_cardtype =  '$bind2' AND t.start_time >=to_date('$bind1')";

        $statement = oci_parse($db_conn, $queryht);
        oci_execute($statement);
        echo 'Sorry! Time following time is not available. Good Luck with your other search!';
        //$result = OCI_Fetch_Array($statement,OCI_BOTH);

        echo '<h4>Contract History</h4>';
        echo '<table cellpadding="0" cellspacing="0" class="db-table">';
        echo "<tr><th>Contract ID</th></tr>";
        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
            echo '<tr>';
            echo "<td>" . $row["CONTRACT_ID"]  ."</td>" ; //or just use "echo $row[0]"
            echo '</tr>';
        }
        echo "</table>";

        //executeBoundSQL("delete from CUSTOMER where nid=:delNum", $alltuples);

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);
    }


    if (array_key_exists('showunavailablesubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['thid'];


        $queryht = "select TP.START_TIME, TP.END_TIME
            from contract C, timeperiod TP
            where TP.RESERVATION_REFERENCE# = C.RESERVATION_REFERENCE#
            AND C.HOUSE_ID = '$bind1'";

        $statement = oci_parse($db_conn, $queryht);
        oci_execute($statement);
        echo 'Sorry! Time following time is not available. Good Luck with your other search!';
        //$result = OCI_Fetch_Array($statement,OCI_BOTH);

        echo '<h4>CONTRACT</h4>';
        echo '<table cellpadding="0" cellspacing="0" class="db-table">';
        echo "<tr><th>Start_Time</th><th>End_Time</th></tr>";
        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {
            echo '<tr>';
            echo "<td>" . $row["START_TIME"] . "</td><td>" . $row["END_TIME"] ."</td>" ; //or just use "echo $row[0]"
            echo '</tr>';
        }
        echo "</table>";

        //executeBoundSQL("delete from CUSTOMER where nid=:delNum", $alltuples);

        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);
    }


    if (array_key_exists('memberpaysubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['conid'];
        $bind2 = $_POST['cusid'];

        $query1 = "select type_initialcharge
            from contract c, house h, housetype ht
            where c.contract_id = '$bind1' AND c.house_id = h.house_id AND h.type_name = ht.type_name";

        $query4 = "select type_dailyrate
            from contract c, house h, housetype ht
            where c.contract_id = '$bind1' AND c.house_id = h.house_id AND h.type_name = ht.type_name";

        $query2 = "select member_rewardpoints
            from member
            where customer_id = '$bind2'";

        $query3 = "select end_time-start_time
            from contract c,timeperiod t
            where c.reservation_reference# = t.reservation_reference# AND contract_id = '$bind2'";


        $statement1 = oci_parse($db_conn, $query1);
        oci_execute($statement1);
        $result1 = OCI_Fetch_Array($statement1,OCI_BOTH);

        $statement4 = oci_parse($db_conn, $query4);
        oci_execute($statement4);
        $result4 = OCI_Fetch_Array($statement4,OCI_BOTH);

        $statement2 = oci_parse($db_conn, $query2);
        oci_execute($statement2);
        $result2 = OCI_Fetch_Array($statement2,OCI_BOTH);

        $statement3 = oci_parse($db_conn, $query3);
        oci_execute($statement3);
        $result3 = OCI_Fetch_Array($statement3,OCI_BOTH);

        $allcost = $result1[0] + $result4[0] * $result3[0];

        if($allcost > $result2[0]) {
            $resultAdd = $allcost - $result2[0];
            $leftreward = 0;
        }else if($allcost <= $result2[0]){
            $resultAdd = 0;
            $leftreward = $result2[0] - $allcost;
        }

        echo "<tr><th>You paid '$allcost'</th></tr>";

        while($allcost>=10){
            $leftreward = $leftreward + 1;
            $allcost = $allcost - 10;
        }


        $querycurr = "select MEMBER_REWARDPOINTS from member where CUSTOMER_ID='$bind2'";
        $statementcurr = oci_parse($db_conn, $querycurr);
        oci_execute($statementcurr);
        $resultcurrentPoint = OCI_Fetch_Array($statementcurr,OCI_BOTH);

        $leftreward = $leftreward + $resultcurrentPoint[0];

        echo "<tr><th>You have '$leftreward' points left!</th></tr>";

        $queryup = "update member set MEMBER_REWARDPOINTS = '$leftreward' where CUSTOMER_ID='$bind2'";
        $statementfff = oci_parse($db_conn, $queryup);
        oci_execute($statementfff);


        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);

    }

    if (array_key_exists('Hostrevenuesubmit', $_POST)) {
        // Update tuple using data from user
        // $tuple = array(
        $bind1 = $_POST['stime'];
        $bind2 = $_POST['etime'];
        $bind3 = $_POST['hostid'];


        $query1 = "select p123.payment_amount
                     from payment p123
                    where p123.payment_id IN (select c.payment_id
                                                from contract c
                                                where c.reservation_reference# IN (select c1.reservation_reference# 	
                                                                                     from contract c1, timeperiod t 
                                                                                     where t.start_time>=to_date('$bind1') 
                                                                                      AND t.end_time <= to_date ('$bind2') 
                                                                                      AND t.reservation_reference# = c1.reservation_reference# 
                                                                                      AND c1.host_id = '$bind3'))";

        /*
         * echo "<tr><th>ID</th><th>Name</th><th>Location</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["LOCATION"] . "</td></tr>"; //or just use "echo $row[0]"
    }
         */

        $statement1 = oci_parse($db_conn, $query1);
        oci_execute($statement1);
        echo '<table cellpadding="0" cellspacing="0" class="db-table">';
        echo "<tr><th>".$bind3."(seperate)</th><th>Host Revenue (accumulate)</th></tr>";

        $printresult = 0;
        while ($row = OCI_Fetch_Array($statement1, OCI_BOTH)) {
            echo '<tr>';
            $printresult = $printresult + $row[0];
            echo "<td>" . $row[0]. "</td><td>".$printresult."</td>" ; //or just use "echo $row[0]"
            echo '</tr>';
        }
        echo "<tr><td>TOTAL:</td><td>".$printresult."</td></tr>";
        echo "</table>";


        //executeBoundSQL("update CUSTOMER set CUSTOMER_NAME=:bind2, CUSTOMER_EMAIL=:bind3, CUSTOMER_PHONE=:bind4, CUSTOMER_RATING=:bind5, CUSTOMER_ADDRESS=:bind6 where CUSTOMER_ID=:bind1", $alltuples);
        OCICommit($db_conn);

    }
//    if (array_key_exists('findhouse', $_POST)) {
//        $tuple = array (
//            ":bind1" => $_POST['housetype'],
//            ":bind2" => $_POST['rating'],
//            ":bind3" => $_POST['starttime'],
//            ":bind4" => $_POST['endtime']
//        );
//        $alltuples = array (
//            $tuple
//        );
//        executeBoundSQL("select host_id, house_id, house_location, house_type, house_rating, type_initialcharge
//                                from house, housetype
//                                where house.house_id = housetype.house_id
//                                      AND type_name=:bind1
//                                      AND house_rating=:bind2
//                                      except
//                                      select host_id, house_id, house_location, house_type, house_rating, type_initialcharge
//                                      from house, housetype, contract
//                                      where house.house_id = housetype.house_id
//                                            AND house.house_id = contract.house_id
//                                            AND (s_date between (:bind3, :bind4) OR e_date between (:bind3, :bind4) OR (s_date < :bind3 AND e_date > :bind4));
//
//                                      ", $alltuples);
//        OCICommit($db_conn);
//
//    }

    if (array_key_exists('paymenthistory', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['customer_id'];

        $queryi = "select payment.payment_id, payment.payment_amount, payment.payment_cardtype
                       from payment 
                       join contract on contract.payment_id = payment.payment_id
                       where contract.customer_id = '$bind1'";


        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        printpayments($statement);


        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('mean', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['type'];

        $queryi = "select AVG(house.house_rating) as avgR
                    from house
                    where house.type_name = '$bind1'
                    group by house.type_name";

        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        $row = OCI_Fetch_Array($statement, OCI_BOTH);
        echo 'This is the average for ' . $bind1 . ' : ';
        echo $row[0];


        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('register', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['customer_id'];

        $queryi = "insert into member values ('$bind1', 50, 50)";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'insert success!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }



    if (array_key_exists('quit', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['customer_id'];

        $queryi = "delete from member where customer_id = '$bind1'";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'quit successfully! See u Soon!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('contracts', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['customer_id'];

        $query = "select house.house_location, house.house_rating, housetype.type_dailyrate 
                    from house
                          join housetype on house.type_name = housetype.type_name
                            join contract on contract.house_id = house.house_id
                            where contract.customer_id = '$bind1'" ;

        $statement = oci_parse($db_conn, $query);
        oci_execute($statement);
        printcontracts($statement);

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('inserthousesubmit', $_POST)) {
        //Getting the values from user and insert data into the table
        //$tuple = array(
        $bind1 = $_POST['hid'];
        $bind2 = $_POST['loc'];
        $bind3 = $_POST['ava'];
        $bind4 = $_POST['rules'];
        $bind5 = $_POST['rating'];
        $bind6 = $_POST['host_id'];
        $bind7 = $_POST['type'];

        //":bind7" => $_POST['crp']

        $queryi = "insert into house values ('$bind1', '$bind2', '$bind3', '$bind4', '$bind5', '$bind6', '$bind7')";
        $statement = oci_parse($db_conn, $queryi);
        oci_execute($statement);
        echo 'Add success!';

        //executeBoundSQL("insert into CUSTOMER values ('$bind1', :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    if (array_key_exists('reservehouse', $_POST)) {


        $hid = $_POST['house_id'];
        $cid = $_POST['customer_id'];
        $s_t = $_POST['starttime'];
        $e_t = $_POST['endtime'];


        $query = "select house.house_id, timeperiod.start_time, timeperiod.end_time
                                from house 
                                join contract on house.house_id = contract.house_id
                                join timeperiod on contract.reservation_reference# = timeperiod.reservation_reference#
                                where house.house_id= '$hid'";


        $statement = oci_parse ($db_conn, $query);
        oci_execute ($statement);
        while ($row = OCI_Fetch_Array($statement, OCI_BOTH)) {

            if ($s_t <= $row["START_TIME"]) {
                if ($e_t  >= $row["START_TIME"]) {
                    echo "<br> Soory!!! Reservation can't be made, as the following time period is booked already </br>";
                    echo "House " . "<tr><td>" . $row["HOUSE_ID"] . " was booked from  </td><td>" . $row["START_TIME"] . " to </td><td>" . $row["END_TIME"] . "</td></tr>";
                    return;
                }
            } else {
                if ($s_t <= $row["END_TIME"]) {
                    echo "<br> Soory!!! Reservation can't be made, as the following time period is booked already </br>";
                    echo "House " . "<tr><td>" . $row["HOUSE_ID"] . " was booked from  </td><td>" . $row["START_TIME"] . " to </td><td>" . $row["END_TIME"] . "</td></tr>";
                    return;
                }
            }
        }


        $row = OCI_Fetch_Array($statement, OCI_BOTH);



        echo $hostid;
        $number = mt_rand (1000,9999);
        $query2 = "insert into reservation values ($number, '$cid', '$hostid', '$hid', 'pending')";
        $querytime = "insert into timeperiod values ($number, '$s_t', '$e_t')";
        $statement = oci_parse ($db_conn, $query2);
        $statement1 = oci_parse ($db_conn, $querytime);
        oci_execute ($statement);
        oci_execute ($statement1);
        echo "reserved!!! Your Reference# is : " . $number;
        OCICommit($db_conn);

    }
    if (array_key_exists('findhouse', $_POST)) {
        // $tuple = array (

        $type = $_POST['housetype'];
        $rating = $_POST['rating'];

        $query = "select house.host_id, house.house_id, house.house_location, house.type_name, house.house_rating, housetype.type_initialcharge 
                                from house 
                                join housetype on house.type_name = housetype.type_name
                                where 
                                      house.type_name= '$type'
                                      AND house.house_rating= '$rating'";

        $statement = oci_parse ($db_conn, $query);
        oci_execute ($statement);
        printHouses($statement);
        OCICommit($db_conn);

    }


    if (array_key_exists('reset', $_POST)) {
        // Drop old table...
        echo "<br> dropping table <br>";
        executePlainSQL("Drop table tab1");

        // Create new table...
        echo "<br> creating new table <br>";
        executePlainSQL("create table tab1 (nid number, name varchar2(30), location varchar2(30), primary key (nid))");
        OCICommit($db_conn);

    } else
//	if (array_key_exists('insertsubmit', $_POST)) {
//			//Getting the values from user and insert data into the table
//		$tuple = array (
//			":bind1" => $_POST['insNo'],
//			":bind2" => $_POST['insName'],
//			":bind3" => $_POST['insLocation']
//
//		);
//		$alltuples = array (
//			$tuple
//		);
//		executeBoundSQL("insert into tab1 values (:bind1, :bind2, :bind3)", $alltuples);
//		OCICommit($db_conn);
//
//	} else
        if (array_key_exists('deletesumbit', $_POST)) {
            // get the values from user and delete data row from table
            $tuple = array(":delNum" => $_POST['delNum']);
            $alltuples = array($tuple);

            executeBoundSQL("delete from tab1 where nid=:delNum", $alltuples);
            OCICommit($db_conn);
        } else
            if (array_key_exists('updatesubmit', $_POST)) {
                // Update tuple using data from user
                $tuple = array (
                    ":bind1" => $_POST['oldName'],
                    ":bind2" => $_POST['newName'],
                    ":bind3" => $_POST['oldLocation'],
                    ":bind4" => $_POST['newLocation']
                );
                $alltuples = array (
                    $tuple
                );
                executeBoundSQL("update tab1 set name=:bind2, location=:bind4 where name=:bind1 AND location=:bind3", $alltuples);
                OCICommit($db_conn);

            } else
                if (array_key_exists('dostuff', $_POST)) {
                    // Insert data into table...
                    executePlainSQL("insert into house values('091', '6335 Thunderbird Crescent', 'yes', 'no smoke', 4, '1234', 'condo' )");
                    // Inserting data into table using bound variables
                    $list1 = array (
                        ":bind1" => '238',
                        ":bind2" => "Crescent Road",
                        ":bind3" => "no",
                        ":bind4" => 'smoke',
                        ":bind5" => 5,
                        ":bind6" => "1722",
                        ":bind7" => 'house',

                    );
                    $list2 = array (
                        ":bind1" => '298',
                        ":bind2" => "Crescent Road",
                        ":bind3" => "yes",
                        ":bind4" => 'no smoke',
                        ":bind5" => 3,
                        ":bind6" => "8074",
                        ":bind7" => 'house',

                    );
                    $list3 = array (
                        ":bind1" => '278',
                        ":bind2" => "Math Annex",
                        ":bind3" => "yes",
                        ":bind4" => 'smoke',
                        ":bind5" => 5,
                        ":bind6" => "8933",
                        ":bind7" => 'apartment',
                    );
                    executeBoundSQL("insert into house values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", $allrows); //the function takes a list of lists
                    // Update data...
                    //executePlainSQL("update tab1 set nid=10 where nid=2");
                    // Delete data...
                    //executePlainSQL("delete from tab1 where nid=1");
                    OCICommit($db_conn);
                }

    if ($_POST && $success) {
        //POST-REDIRECT-GET -- See http://en.wikipedia.org/wiki/Post/Redirect/Get
        header("location: host.php");
        $result = executePlainSQL("select * from house");
    } else {
        // Select data...
        //$result = executePlainSQL("select * from housetype join house on house.type__name = housetype.type__name");
        printHouses($result);
    }

    //Commit to save changes...
    OCILogoff($db_conn);
} else {
    echo "cannot connect";
    $e = OCI_Error(); // For OCILogon errors pass no handle
    echo htmlentities($e['message']);
}

/* OCILogon() allows you to log onto the Oracle database
     The three arguments are the username, password, and database.
     You will need to replace "username" and "password" for this to
     to work.
     all strings that start with "$" are variables; they are created
     implicitly by appearing on the left hand side of an assignment
     statement */
/* OCIParse() Prepares Oracle statement for execution
The two arguments are the connection and SQL query. */
/* OCIExecute() executes a previously parsed statement
      The two arguments are the statement which is a valid OCI
      statement identifier, and the mode.
      default mode is OCI_COMMIT_ON_SUCCESS. Statement is
      automatically committed after OCIExecute() call when using this
      mode.
      Here we use OCI_DEFAULT. Statement is not committed
      automatically when using this mode. */
/* OCI_Fetch_Array() Returns the next row from the result data as an
     associative or numeric array, or both.
     The two arguments are a valid OCI statement identifier, and an
     optinal second parameter which can be any combination of the
     following constants:

     OCI_BOTH - return an array with both associative and numeric
     indices (the same as OCI_ASSOC + OCI_NUM). This is the default
     behavior.
     OCI_ASSOC - return an associative array (as OCI_Fetch_Assoc()
     works).
     OCI_NUM - return a numeric array, (as OCI_Fetch_Row() works).
     OCI_RETURN_NULLS - create empty elements for the NULL fields.
     OCI_RETURN_LOBS - return the value of a LOB of the descriptor.
     Default mode is OCI_BOTH.  */
?>