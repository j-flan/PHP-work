<?php
    session_start();
    $Body = 0;
    if(isset($_SESSION['internID'])){
        $Body .= "<p>You have not logged in or registered. Please return to the " . 
        " <a href= 'InternLogin.php'>Registration / " . 
        " Log In Page</a>.</p>\n";
        ++$errors;
    }
    if ($errors == 0){
        if(isset($_GET['opportunityID']))
            $OpportunityID = $_GET['opportunityID'];
        else{
            $Body .= "<p>You have not selected an opportunity. Please return to the " . 
            " <a href='AvailableOpportunities.php?" . SID . "'>Available " . 
            " Opportunities page</a>.</p>\n";
            ++$errors;
        }
    }
    if ($errors == 0){
        $DBConnect = @mysql_connect("localhost", "root", "");
        if($DBConnect === FALSE){
            $Body .= "<p>Unable to connect to the database" . 
            " Server. Error Code " . mysql_errorno() . ": " . mysql_error() . "</p>\n";
            ++$errors;
        }
        else{
            $DBName = "internships";
            $result = @mysql_select_db($DBName, $DBConnect);
            if($result === FALSE){
                $Body .= "<p>Unable to select the database. " . mysql_errno($DBConnect) . 
                ": " . mysql_error($DBConnect) . "</p>\n";
                ++$errors;
            }
        }
    }
    if($errors == 0){
        $TableName = "assigned_opportunities";
        $SQLstring = "DELETE FROM $TableName" .
        " WHERE opportunityID=$OpportunityID " .
        " AND internID=" . $_SESSION['internID'] .
        " AND date_approved IS NULL";
        $QueryResult = @mysql_query($SQLstring, $DBConnect);
        if($QueryResult === FALSE){
            $Body .= "<p>Unable to execute the query. " . mysql_errno($DBConnect) . 
            ": " . mysql_error($DBConnect) . "</p>\n";
            ++$errors;
        }
        else{
            $AffectedRows = mysql_affected_rows($DBConnect);
            if($AffectedRows == 0)
                $Body .= "<p>You had not previously selected opportunity # $OpportunityID</p>\n";
            else
                $Body .= "<p>Your request for opportunity # $OpportunityID has been removed</p>\n";
        }
        mysql_close($DBConnect);
    }
    if($_SESSION['internID'] > 0)
        $Body .= "<p>Return to the <a href='AvailableOpportunities.php?" . SID. "'>" .
        " Available Opportunities</a> page.</p>\n";
    else
        $Body .= "<p>Please <a href='InternLogin.php'>Register or Log In</a> to  use this page.</p>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Jeff Flanegan
    CWB 208
    CancelSelection.php
    2019-11-1-->
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Cancel Selection</title>
    </head>
    <body>
    <h1>College Internship</h1>
    <h2>Cancel Selection</h2>
    <?php
        echo $Body;
	?>
    </body>

</html>
