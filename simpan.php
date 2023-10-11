<?php

include "koneksi.php";

if(isset($_POST['title'])&& isset($_POST['tempat']) && isset($_POST['dihadiri'])&& isset($_POST['pakaian'])&& isset($_POST['keterangan'])) {

    $title = $_POST['title'];
    $tempat = $_POST['tempat'];
    $dihadiri = $_POST['dihadiri'];
    $pakaian = $_POST['pakaian'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT into events VALUES('','$title','$tempat','$dihadiri','$pakaian','$start','$end','$keterangan') ");

}