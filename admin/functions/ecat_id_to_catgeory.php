<?php

function Convert_ecatid_tocatgeory($ecat_id , $type=0 )
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $Db_name  = "EcommerceWebsite";
    $mysqli = new mysqli;
    $conn = $mysqli->connect($servername, $username, $password, $Db_name);


    $ecat_idd = $ecat_id;
    $midcat_id_query  = $mysqli->query("SELECT * FROM tbl_end_category WHERE ecat_id = '$ecat_id' ");
    while ($r = mysqli_fetch_assoc($midcat_id_query)) {
        $midcat_id = $r["mcat_id"];
        $ecat_name = $r["ecat_name"];
    }

    $tcat_id_query  = $mysqli->query("SELECT * FROM tbl_mid_category WHERE mcat_id = '$midcat_id' ");
    while ($r = mysqli_fetch_assoc($tcat_id_query)) {
        $micat_name = $r["mcat_name"];
        $tcat_id = $r["tcat_id"];
    }

    $tcat_name_query  = $mysqli->query("SELECT * FROM tbl_top_category WHERE tcat_id = '$tcat_id' ");
    while ($r = mysqli_fetch_assoc($tcat_name_query)) {
        $topcat_name = $r["tcat_name"];
    }
    if ($type == 0) {
        return   $topcat_name . "<br>" . $micat_name . "<br>" . $ecat_name;
    } else {
        return   $topcat_name . " / " . $micat_name . " / " . $ecat_name;

    }
}


?>