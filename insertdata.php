<!DOCTYPE html>
<html>

<head>
    <title> Website Toko Bangunan </title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <header>
        <div class="jumbotron">
            <h1> Toko Bangunan </h1>
            <p> Jl Kayu Manis RT -- RW -- No -- Balekambang</p>
            <p> Kramat Jati Jakarta Timur </p>
            <p> Phone : --- </p>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php"> Monitoring </a></li>
                <li><a href="insertdata.php"> Input Data Barang </a></li>
                <li><a href="penjualan.php"> Input Penjualan </a></li>
                <li><a href="upload.php"> Dokumen </a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="content">
            <article id="insert" class="card">
                <h2> Input Barang Masuk </h2>
                <table>


                    <?php

                    //CONNECTION DATABASE
                    $koneksi = mysqli_connect("localhost", "root", "", "db_tokobangunan");

                    //FUNCTION INSERT DATA 
                    function tambah($koneksi)
                    {
                        if (isset($_POST['btn_simpan'])) {
                            $id_barang = $_POST['id_barang'];
                            $nama_barang = $_POST['nama_barang'];
                            $tipe_barang = $_POST['tipe_barang'];
                            $warna_barang = $_POST['warna_barang'];
                            $stock = $_POST['stock'];
                            $ukuran = $_POST['ukuran'];
                            $tanggal = $_POST['tanggal'];

                            if (!empty($id_barang) && !empty($nama_barang) && !empty($tipe_barang) && !empty($warna_barang) && !empty($stock) && !empty($ukuran) && !empty($tanggal)) {
                                $sql = "INSERT INTO t_barang( id_barang, nama_barang, tipe_barang, warna_barang, stock, ukuran, tanggal) 
            VALUES ( '" . $_POST['id_barang'] . "', '" . $_POST['nama_barang'] . "', '" . $_POST['tipe_barang'] . "', '" . $_POST['warna_barang'] . "', '" . $_POST['stock'] . "', '" . $_POST['ukuran'] . "', '" . $_POST['tanggal'] . "');";
                                $simpan = mysqli_query($koneksi, $sql) or die("Proses Tambah data Pelanggan GAGAL! <br> ");
                                if ($simpan && isset($_GET['aksi'])) {
                                    if ($_GET['aksi'] == 'create') {
                                        header('Location: transaksi.php');
                                    }
                                }
                            } else {
                                $pesan = "<p style='color: red'>Tidak dapat menyimpan atau data belum lengkap!</p>";
                            }
                        }
                    ?>

                        <p>
                            <form action="" method="post" enctype="multipart/form-data">
                                <table width="100%" align="center" border="0" bgcolor="#eee" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td></td>
                                        <td><input type="hidden"></td>
                                    </tr>
                                    <tr>
                                        <td> Kode Barang </td>
                                        <td><input type="text" name="id_barang" required></td>
                                    </tr>
                                    <tr>
                                        <td> Nama Barang </td>
                                        <td><input type="text" name="nama_barang" required></td>
                                    </tr>
                                    <tr>
                                        <td> Tipe Barang </td>
                                        <td><input type="text" name="tipe_barang" required></td>
                                    </tr>
                                    <tr>
                                        <td> Warna Barang </td>
                                        <td><input type="text" name="warna_barang" required></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td> Jumlah Barang </td>
                                        <td><input type="text" name="stock" required maxlength="11" pattern=[1-9]></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td> Ukuran Barang </td>
                                        <td><input type="text" name="ukuran" required maxlength="11" pattern=[1-9]></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td> Tanggal </td>
                                        <td><input type="text" name="tanggal" id="date"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <left>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-reply-all"></i> Clear </button>
                                            </left>
                                        </td>
                                    </tr>
                                </table>
                                <center>
                                    <div class="form-action-buttons">
                                        <input type="submit" name="btn_simpan" class="btn btn-success"><i class="fa fa-save">
                                    </div>
                                </center>
                </table>
                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
                <aside>
            </article>
        </div>

        <aside>
            <article id="home" class="card">
                <h2> Data Barang </h2>
                <table>
                    <?php
                    }

                    //FUNCTION VIEW DATA 
                    function tampil_data($koneksi)
                    {
                        $seleksi = ("SELECT t_barang.id_barang, t_barang.nama_barang, t_barang.tipe_barang, t_barang.ukuran, SUM(stock) AS Total, m_barang.harga FROM t_barang INNER JOIN m_barang ON t_barang.id_barang = m_barang.id_barang GROUP BY id_barang,nama_barang ORDER BY id_barang") or die(mysqli_error());
                        $hasil_seleksi = mysqli_query($koneksi, $seleksi);

                        echo "<center>";
                        echo "<legend><h3 style='margin-top:0px;'> Data Barang </h3></legend>";

                        echo "<table class='tabel-data' class='table-hover' class='table-bordered' border='1'>";
                        echo "<tr>
    <th> Kode Barang </th>
    <th> Nama Barang </th> 
    <th> Tipe Barang </th>
    <th> Ukuran </th>
    <th> Stock </th>
    <th> Harga </th>
    </tr>";

                        while ($data = mysqli_fetch_array($hasil_seleksi)) {

                    ?>
                        <tr>
                            <td><?php echo $data['id_barang']; ?></td>
                            <td><?php echo $data['nama_barang']; ?></td>
                            <td><?php echo $data['tipe_barang']; ?></td>
                            <td><?php echo $data['ukuran']; ?></td>
                            <td><?php echo $data['Total']; ?></td>
                            <td><?php echo $data['harga']; ?></td>
                        </tr>

                <?php
                        }
                    }


                    // ===================================================================
                    // --- Program Utama
                    if (isset($_GET['aksi'])) {
                        switch ($_GET['aksi']) {
                            case "create":
                                echo '<a href="transaksi.php" class="btn btn-info"> &laquo; Home</a>';
                                tambah($koneksi);
                                break;
                            case "read":
                                tampil_data($koneksi);
                                break;
                            case "update":
                                ubah($koneksi);
                                tampil_data($koneksi);
                                break;
                            case "delete":
                                hapus($koneksi);
                                break;
                            default:
                                echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidak ada!</h3>";
                                tambah($koneksi);
                                tampil_data($koneksi);
                        }
                    } else {
                        tambah($koneksi);
                        tampil_data($koneksi);
                    }
                ?>
                </table>
            </article>
            </div>
            <aside>
    </main>
    <footer>
        <p>Copyright &#169; 2020 Rul Corp Dev. All rights reserved.</p>
    </footer>
</body>

</html>