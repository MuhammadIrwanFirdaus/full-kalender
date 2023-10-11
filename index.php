<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender</title>
    <link rel="stylesheet" href="assets/fullcalendar.css">
    <link rel="stylesheet" href="assets/bootstrap.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <script src="assets/jquery.min.js"></script>
    <script src="assets/jquery-ui.min.js"></script>
    <script src="assets/moment.min.js"></script> 
    <script src="assets/fullcalendar.min.js"></script>
    <script src="plugin-fa/bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
  /* Warna latar belakang untuk baris ganjil */
table tr:nth-child(odd) {
    background-color: #f2f2f2;
}

#calendar {
    background-color: blue;
    color:black; /* Atur warna teks agar kontras dengan latar belakang */
}
  /* Gaya hover pada baris tabel */
table tr:hover {
    background-color: #ddd;
}
        /* Memusatkan kontainer secara horizontal */
        .container {
            margin: 0 auto;
            text-align: center; /* Memusatkan isi secara horizontal */
            max-width: 800px; /* Tetapkan lebar maksimum sesuai kebutuhan */
        }

        /* Memusatkan kontainer secara vertikal (opsional) */
        .container {
            height: 100vh; /* Tetapkan tinggi tertentu atau gunakan metode lain untuk menentukan tinggi */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

#notification {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: 10px;
        margin-top: 10px;
        text-align: center;
    }

    /* Kalender styling */
#calendar {
    max-width: 800px;
    margin: 0 auto;
    z-index: 1;
    margin-left: 10px;
    position: relative;
}

#content {
    flex: 1; /* Ini akan mengisi sisa ruang di sebelah kanan sidebar */
    padding: 20px; /* Atur jarak dari tepi konten utama */
}


           /* Tambahkan gaya CSS untuk mengatur tampilan responsif */
           @media (max-width: 768px) {
            .wrapper {
                padding-left: 0; /* Hapus padding kiri pada wrapper */
                
            }
            .form-control {
                max-width: 100%; /* Maksimum lebar input saat layar kecil */
            }

            .wrapper.toggled {
                padding-left: 250px; /*Kembalikan padding kiri saat sidebar terbuka */
            }

            /* Tambahkan gaya CSS untuk mengatur tampilan kalender dan tabel pada layar kecil */
            #calendar {
                margin-left: -15px; /* Koreksi margin untuk kalender */
            }

            .card-title {
                font-size: 1.25rem; /* Ukuran font judul card */
            }   
        }

                    /* CSS untuk tabel responsif */
            .responsive-table {
                overflow-x: auto;
                white-space: nowrap;
            }

</style>

</head>
<body>
    <div class="wrapper">
                    <!-- Sidebar -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul>
            <li>
                <h3>Jadwal</h3>
            </li>
        </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-th-large"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <span class="dropdown-item dropdown-header">Pengaturan pengguna</span>
                <a href="login.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </div>
        </li>
    </ul>
</nav>

            <h2 class="text-center"><a href="#"></a></h2>
            <br>
            <div class="container">
                <div id="calendar"></div>
                <!-- <div id="notification"></div> -->
                
            </div>

            <?php
            include "koneksi.php";
            $sql = "SELECT * FROM events WHERE end_event >= NOW() ORDER BY start_event ASC";
            $result = $koneksi->query($sql);
            
            if (!$result) {
                die("Query gagal: " . $koneksi->error);
            }
            
        ?>

                        <!-- Konten Utama -->
        <div id="content">
            <!-- Tambahkan konten utama Anda di sini, termasuk kalender -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <br>
                        <h3 class="card-title">Jadwal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                            <th>Acara</th>
                            <th>Tempat</th>
                            <th>Dihadiri</th>
                            <th>Pakaian</th>
                            <th>Waktu</th>
                            <th>keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['tempat'] . "</td>";
                    echo "<td>" . $row['dihadiri'] . "</td>";
                    echo "<td>" . $row['pakaian'] . "</td>";
                    echo "<td>" . $row['start_event'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                </div>

                <!-- Formulir untuk menambahkan data baru -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Jadwal Baru</h3>
                    </div>
                    <!-- Formulir -->
                    <div class="card-body">
                        <form id="addEventForm">
                            <div class="form-group">
                                <label for="title">Acara</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control" id="tempat" name="tempat" required>
                            </div>
                            <div class="form-group">
                                <label for="dihadiri">Dihadiri</label>
                                <input type="text" class="form-control" id="dihadiri" name="dihadiri" required>
                            </div>
                            <div class="form-group">
                                <label for="pakaian">Pakaian</label>
                                <input type="text" class="form-control" id="pakaian" name="pakaian" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal dan Waktu</label>
                                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                            </div>

                            <button type="button" class="btn btn-primary" id="addEventButton">Tambah Jadwal</button>
                            <button type="button" class="btn btn-warning" id="editEventButton">Simpan Edit</button>
                            <button type="button" class="btn btn-danger" id="deleteEventButton">Hapus Data</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

            <script>



                //persiapan JQuery
                $(document).ready(function(){
                    var calendar = $('#calendar').fullCalendar({
                        //izinkan tabel bisa di edit
                        editable: true,
                        //ATUR HEADER KALENDER
                        header: {
                            left : 'prev, next today',
                            center : 'title',
                            right : 'month, agendaWeek, agendaDay'
                        },
                        //tampilkan data dari database
                        events : 'tampil.php',
                        //izinkan tabel/kalender bisa di pilih /edit
                        selectable :true,
                        selectHelper :true,

                            eventClick: function(event) {
                            // Isi formulir dengan data acara yang akan diubah
                            $("#title").val(event.title);
                            $("#tempat").val(event.tempat);
                            $("#dihadiri").val(event.dihadiri);
                            $("#pakaian").val(event.pakaian);
                            $("#keterangan").val(event.keterangan);

                            // Format ulang tanggal dan waktu sesuai dengan format input tanggal
                            var start = moment(event.start).format("YYYY-MM-DD HH:mm");
                            $("#tanggal").val(start);

                            // Simpan ID acara yang akan diubah untuk referensi
                            EventId = event.id;
                        },
                    
                        eventDrop: function(event) {
    var title = event.title;
    var id = event.id;
    var keterangan = event.keterangan; // Ambil keterangan yang sudah ada

    // Dapatkan tanggal dari tanggal yang telah dipilih dari kalender
    var date = moment(event.start).format("YYYY-MM-DD");
    
    // Gunakan waktu yang telah ada
    var time = moment(event.start).format("HH:mm");

    // Gabungkan tanggal dan waktu menjadi satu string
    var dateTime = date + " " + time;

    // Gunakan moment.js untuk memformat tanggal dan waktu ke dalam format yang sesuai
    var start = moment(dateTime, "YYYY-MM-DD HH:mm").format("Y-MM-DD HH:mm:ss");
    var end = moment(dateTime, "YYYY-MM-DD HH:mm").format("Y-MM-DD HH:mm:ss");

    //perintah ajax lempar data untuk disimpan
    $.ajax({
        url : "ubah.php",
        type : "POST",
        data : {
            title: title,
            tempat: event.tempat, 
            dihadiri: event.dihadiri,
            pakaian: event.pakaian,
            start: start,
            end: end,
            keterangan: event.keterangan, // Kirim keterangan yang sudah ada
            id : id
        },
        success :function(){
            //jika simpan sukses refresh kalender dan tampilkan pesan
            calendar.fullCalendar('refetchEvents');
            alert('ubah jadwal Sukses dan klik ok untuk refresh....!');
            location.reload();
        }
    });
},

                    });
                                        // Tangani klik tombol "Simpan Edit"
                            $("#editEventButton").on("click", function () {
                                var id = EventId; // Gunakan ID acara yang disimpan sebelumnya
                                var title = $("#title").val();
                                var tempat = $("#tempat").val();
                                var dihadiri = $("#dihadiri").val();
                                var pakaian = $("#pakaian").val();
                                var tanggal = $("#tanggal").val();
                                var keterangan = $("#keterangan").val();

                                 // Validasi input
                                    if (!title || !tempat || !dihadiri || !pakaian || !tanggal || !keterangan) {
                                        alert('Harap isi semua field sebelum menambahkan jadwal.');
                                        return;
                                    }

                                // Kirim data ke server menggunakan AJAX
                                $.ajax({
                                    url: "ubah.php", // Ganti dengan nama file PHP yang akan memproses perubahan data
                                    type: "POST",
                                    data: {
                                        id: id,
                                        title: title,
                                        tempat: tempat,
                                        dihadiri: dihadiri,
                                        pakaian: pakaian,
                                        start: tanggal, // Atur kembali sesuai dengan kebutuhan Anda
                                        end: tanggal,   // Atur kembali sesuai dengan kebutuhan Anda
                                        keterangan: keterangan,
                                    },
                                    success: function () {
                                        // Jika perubahan sukses, refresh kalender dan tampilkan pesan
                                        calendar.fullCalendar('refetchEvents');
                                        alert('Perubahan Sukses....!');
                                        location.reload();
                                    }
                                });
                            });
                                // Tangani klik tombol "Tambah Jadwal"
                                    $("#addEventButton").on("click", function () {
                                    var title = $("#title").val();
                                    var tempat = $("#tempat").val();
                                    var dihadiri = $("#dihadiri").val();
                                    var pakaian = $("#pakaian").val();
                                    var tanggal = $("#tanggal").val();
                                    var keterangan = $("#keterangan").val();

                                    // Validasi input
                                    if (!title || !tempat || !dihadiri || !pakaian || !tanggal || !keterangan) {
                                        alert('Harap isi semua field sebelum menambahkan jadwal.');
                                        return;
                                    }

                                    // Kirim data ke server menggunakan AJAX
                                    $.ajax({
                                        url: "simpan.php",
                                        type: "POST",
                                        data: {
                                            title: title,
                                            tempat: tempat,
                                            dihadiri: dihadiri,
                                            pakaian: pakaian,
                                            start: tanggal,
                                            end: tanggal,
                                            keterangan: keterangan
                                        },
                                        success: function () {
                                            // Jika simpan sukses, refresh kalender dan tampilkan pesan
                                            calendar.fullCalendar('refetchEvents');
                                            alert('Simpan Sukses....!');
                                            console.log('Simpan sukses');
                                            location.reload();
                                        },
                                        error: function (xhr, textStatus, errorThrown) {
                                        console.error("Error: " + errorThrown);
                                        console.error("Status: " + textStatus);
                                        console.error(xhr);
                                        alert('Terjadi kesalahan saat mengirim data. Silakan periksa konsol untuk informasi lebih lanjut.');
                                    }
                                    });
                                });
                                    // Tangani klik tombol "Hapus Data"
                                    $("#deleteEventButton").on("click", function () {
                                        // Tampilkan konfirmasi sebelum menghapus data
                                        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                                            var id = EventId; // Gunakan ID acara yang disimpan sebelumnya
                                            var title = $("#title").val();
                                            var tempat = $("#tempat").val();
                                            var dihadiri = $("#dihadiri").val();
                                            var pakaian = $("#pakaian").val();
                                            var tanggal = $("#tanggal").val();
                                            var keterangan = $("#keterangan").val();

                                            // Kirim data ke server menggunakan AJAX
                                            $.ajax({
                                                url: "hapus.php", // Ganti dengan nama file PHP yang akan memproses penghapusan data
                                                type: "POST",
                                                data: {
                                                    id: id,
                                                    title: title,
                                                    tempat: tempat,
                                                    dihadiri: dihadiri,
                                                    pakaian: pakaian,
                                                    start: tanggal, // Atur kembali sesuai dengan kebutuhan Anda
                                                    end: tanggal,   // Atur kembali sesuai dengan kebutuhan Anda
                                                    keterangan: keterangan
                                                },
                                                success: function () {
                                                    // Jika penghapusan sukses, refresh kalender dan tampilkan pesan
                                                    calendar.fullCalendar('refetchEvents');
                                                    alert('Menghapus Data Sukses....!');
                                                    location.reload();
                                                }
                                            });
                                        }
                                    });
                                        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
                                        // var today = moment().format('YYYY-MM-DD');

                                        // // Menyaring acara-acara yang tanggalnya sama dengan hari ini
                                        // var eventsToday = calendar.fullCalendar('clientEvents', function(event) {
                                        //     return event.start.format('YYYY-MM-DD') === today;
                                        // });

                                        // // Jika ada acara hari ini, tampilkan notifikasi
                                        // if (eventsToday.length > 0) {
                                        //     var notificationText = 'Jadwal hari ini:';
                                        //     eventsToday.forEach(function(event) {
                                        //         notificationText += '<br>' + event.title + ' - ' + event.start.format('HH:mm');
                                        //     });
                                        //     $('#notification').html(notificationText);
                                        // } else {
                                        //     $('#notification').html('Tidak ada jadwal hari ini.');
                                        // }

                });//aaaaaaaaaaaaaaaaaaaaa
                
                
            </script>
</body>

</html>