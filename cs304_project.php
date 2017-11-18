<!doctype html>
<div lang="en">
    <head>
        <title>House2Go</title>
        <!-- required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- bootstrap cs -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
              integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
              crossorigin="anonymous">
    </head>

    <style>
        .add-cus, .update-cus, .remove-cus, .add-host, .update-host, .remove-host {
            margin-top: 20px;
            padding: 1%;
            border: thin solid black;
        }

        .search-house {
            margin-top: 50px;
            padding: 1%;
            border: thin solid black;
        }

        .view {
            width: 30%;
            float: left;
        }

        .siteTitle {
            color: black;
            text-align: center;
        }


    </style>

    <h1 class="siteTitle">Welcome1 to House2Go</h1>

    <div class="management">
        <div class="col-md-6 view">
            <label>Management</label>


            <!-- RESET TABLES -->
            <form method="POST" action="cs304_project.php">
                <p><input type="submit" value="Reset Tables" name="reset"></p>
            </form>


            <form>
                <div class="add-cus">
                    <label>Add Customer</label>
                    <br>
                    <form method="post" action="cs304_project.php">
                        <!-- refresh page -->
                        <input type="text" name="cid" placeholder="Customer ID">
                        <input type="text" name="cnam" placeholder="Name">
                        <input type="text" name="cem" placeholder="Email">
                        <input type="text" name="cph" placeholder="Phone">
                        <input type="text" name="cadd" placeholder="Address">
                        <input type="text" name="crat" placeholder="Rating">
                        <input type="text" name="cfee" placeholder="Fee">
                        <input type="text" name="crp" placeholder="Reward Points">

                    </form>
                    <br>
                    <button type="submit" name="insertsubmit">Insert</button>
                </div>
            </form>

            <form>
                <div class="update-cus">
                    <label>Update Customer</label>
                    <br>
                    <form method="post" action="cs304_project.php">
                        <!-- refresh page -->
                        <input type="text" name="cid" placeholder="Customer ID">
                        <input type="text" name="cnam" placeholder="Name">
                        <input type="text" name="cem" placeholder="Email">
                        <input type="text" name="cph" placeholder="Phone">
                        <input type="text" name="cadd" placeholder="Address">
                        <input type="text" name="crat" placeholder="Rating">
                        <input type="text" name="cfee" placeholder="Fee">
                        <input type="text" name="crp" placeholder="Reward Points">

                    </form>
                    <br>
                    <button type="submit" name="updatesubmit">Update</button>
                </div>
            </form>

            <form>
                <div class="remove-cus">
                    <label>Remove Customer</label>
                    <br>
                    <form method="post" action="cs304_project.php">
                        <!-- refresh page -->
                        <input type="text" name="cid" placeholder="Customer ID">
                    </form>
                    <br>
                    <button type="submit" name="removesubmit">Remove</button>
                </div>
            </form>

            <form>
                <div class="add-host">
                    <label>Add Host</label>
                    <br>
                    <form method="post" action="cs304_project.php">
                        <!-- refresh page -->
                        <input type="text" name="hid" placeholder="Host ID">
                        <input type="text" name="hnam" placeholder="Name">
                        <input type="text" name="hph" placeholder="Phone">
                        <input type="text" name="hadd" placeholder="Address">

                    </form>
                    <br>
                    <button type="submit" name="insertsubmit">Insert</button>
                </div>
            </form>

            <form>
                <div class="update-host">
                    <label>Update Host</label>
                    <br>
                    <form method="post" action="cs304_project.php">
                        <!-- refresh page -->
                        <input type="text" name="hid" placeholder="Host ID">
                        <input type="text" name="hnam" placeholder="Name">
                        <input type="text" name="hph" placeholder="Phone">
                        <input type="text" name="hadd" placeholder="Address">

                    </form>
                    <br>
                    <button type="submit" name="updatesubmit">Update</button>
                </div>
            </form>

            <form>
                <div class="remove-host"
                <label>Remove Host</label>
                <br>
                <form method="post" action="cs304_project.php">
                    <!-- refresh page -->
                    <input type="text" name="hid" placeholder="Host ID">
                </form>
                <br>
                <button type="submit" name="removesubmit">Remove</button>
        </div>
        </form>

    </div>
</div>
<div class="customerView">
    <div class="col-md-6 view">
        <label>Customer View</label>

        <form>
            <div class="search-house">
                <label>Search House</label>
                <br>
                <form method="post" action="cs304_project.php">
                    <!-- refresh page -->
                    <input type="text" name="houseid" placeholder="House ID">
                    <input type="text" name="housenam" placeholder="Name">
                    <input type="text" name="housecity" placeholder="City">
                    <input type="text" name="houseprov" placeholder="Province">
                    <input type="text" name="housecoun" placeholder="Country">
                    <input type="text" name="houserat" placeholder="Rating">

                </form>
                <br>
                <button type="submit" name="searchhousesubmit">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-6 view">
    <label>Host View</label>
</div>


<form method="POST" action="cs304_project.php">
    <!--refresh page when submit-->
    <input type="submit" value="run hardcoded queries" name="dostuff"></p>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
</div>
</html>


<?php

//this tells the system that it's no longer just parsing
//html; it's now parsing PHP

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon("ora_f4l0b", "a60250157", "dbhost.ugrad.cs.ubc.ca:1522/ug");

function executePlainSQL($cmdstr)
{ //takes a plain (no bound variables) SQL command and executes it
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

function executeBoundSQL($cmdstr, $list)
{
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

function printResult($result)
{ //prints results from a select statement
    echo "<br>Got data from table tab1:<br>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Location</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["LOCATION"] . "</td></tr>"; //or just use "echo $row[0]"
    }
    echo "</table>";

}

// Connect Oracle...
if ($db_conn) {

    if (array_key_exists('reset', $_POST)) {
        // Drop old table...
        echo "<br> dropping table <br>";
        executePlainSQL("Drop table tab1");

        // Create new table...
        echo "<br> creating new table <br>";
        executePlainSQL("create table tab1 (nid number, name varchar2(30), location varchar2(30), primary key (nid))");
        OCICommit($db_conn);

    } else
        if (array_key_exists('insertsubmit', $_POST)) {
            //Getting the values from user and insert data into the table
            $tuple = array(
                ":bind1" => $_POST['insNo'],
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insLocation']

            );
            $alltuples = array(
                $tuple
            );
            executeBoundSQL("insert into tab1 values (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);

        } else
            if (array_key_exists('deletesumbit', $_POST)) {
                // get the values from user and delete data row from table
                $tuple = array(":delNum" => $_POST['delNum']);
                $alltuples = array($tuple);

                executeBoundSQL("delete from tab1 where nid=:delNum", $alltuples);
                OCICommit($db_conn);
            } else
                if (array_key_exists('updatesubmit', $_POST)) {
                    // Update tuple using data from user
                    $tuple = array(
                        ":bind1" => $_POST['oldName'],
                        ":bind2" => $_POST['newName'],
                        ":bind3" => $_POST['oldLocation'],
                        ":bind4" => $_POST['newLocation']
                    );
                    $alltuples = array(
                        $tuple
                    );
                    executeBoundSQL("update tab1 set name=:bind2, location=:bind4 where name=:bind1 AND location=:bind3", $alltuples);
                    OCICommit($db_conn);

                } else
                    if (array_key_exists('dostuff', $_POST)) {
                        // Insert data into table...
                        executePlainSQL("insert into tab1 values (10, 'Frank', 'Vancouver')");
                        // Inserting data into table using bound variables
                        $list1 = array(
                            ":bind1" => 6,
                            ":bind2" => "All",
                            ":bind3" => "All"
                        );
                        $list2 = array(
                            ":bind1" => 7,
                            ":bind2" => "John",
                            ":bind3" => "Vancouver"
                        );
                        $allrows = array(
                            $list1,
                            $list2
                        );
                        executeBoundSQL("insert into tab1 values (:bind1, :bind2, :bind3)", $allrows); //the function takes a list of lists
                        // Update data...
                        //executePlainSQL("update tab1 set nid=10 where nid=2");
                        // Delete data...
                        //executePlainSQL("delete from tab1 where nid=1");
                        OCICommit($db_conn);
                    }

    if ($_POST && $success) {
        //POST-REDIRECT-GET -- See http://en.wikipedia.org/wiki/Post/Redirect/Get
        header("location: cs304_project.php");
    } else {
        // Select data...
        $result = executePlainSQL("select * from tab1");
        printResult($result);
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
