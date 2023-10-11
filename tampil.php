<?php
//panggil koneksi
include "koneksi.php";

$tampil = mysqli_query($koneksi, "SELECT * FROM events order by id");

$dataArr = array();
while($data = mysqli_fetch_array($tampil)){

    $dataArr[] = array(
        'id' => $data['id'],
        'title' => $data['title'],
        'tempat' => $data['tempat'],
        'dihadiri' => $data['dihadiri'],
        'pakaian' => $data['pakaian'],
        'start' => $data['start_event'],
        'end' => $data['end_event'],
    );

}

echo json_encode($dataArr);
