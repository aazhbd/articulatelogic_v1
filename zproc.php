<?php
if($_POST)
{
    $url = $_POST['name'];
    
    mysql_connect("localhost", "articulatelogic", "al#100");
    mysql_select_db("articulatelogic_main");
    
    //mysql_connect("localhost", "root", "");
    //mysql_select_db("artlogicdb");
    
    extract($_POST);

    $r = mysql_query("select * from files where url = '$url'");

    $c = 0;
    $c = mysql_num_rows($r);

    if($c > 0) echo "not available";
    else echo "available";
}
else{
    echo "you are not allowed to access this file directly";
}
?>