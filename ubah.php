<?php

include "koneksi.php";

if(isset($_POST['id'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $tempat = $_POST['tempat'];
    $dihadiri = $_POST['dihadiri'];
    $pakaian = $_POST['pakaian'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE events set title = '$title', tempat = '$tempat', dihadiri = '$dihadiri', pakaian = '$pakaian', start_event = '$start', end_event = '$end', keterangan = '$keterangan' WHERE id = '$id' ");

}