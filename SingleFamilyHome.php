<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--Jeff Flanegan
    CWB 208
    SingleFamilyHome.php
    2019-8-25-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Single Family Home</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    </head>
    <body>
        <?php
        $SingleFamilyHome = 399500;//store variable
        $SingleFamilyHome_Display = number_format($SingleFamilyHome, 2);//define precision
        echo "<p>The current median price of a single family home in Pleasanton, CA is "
        . "$$SingleFamilyHome_Display.</p>";
        ?>
    </body>
</html>
