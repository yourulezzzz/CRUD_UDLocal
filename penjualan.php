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
            <article id="" class="card">
                <h2> Input Barang Keluar </h2>
                <table>

                    <?php
                    //CONNECTION DATABASE
                    $koneksi = mysqli_connect("localhost", "root", "", "db_tokobangunan");

                    //FUNCTION INSERT DATA 
                    function tambah($koneksi)
                    {
                        if (isset($_POST['btn_simpan'])) {
                            $id_trx = time();
                            $id_barang = $_POST['id_barang'];
                            $nama_barang = $_POST['nama_barang'];
                            $tanggal = $_POST['tanggal'];
                            $tipe_barang = $_POST['tipe_barang'];
                            $harga = $_POST['harga'];
                            $beli = $_POST['jml_beli'];
                            $total = $_POST['total'];

                            if (!empty($id_barang) && !empty($nama_barang)  && !empty($tanggal) && !empty($tipe_barang) && !empty($harga) && !empty($beli) && !empty($total)) {
                                $sql = "INSERT INTO t_list_trx( id_barang, nama_barang, tanggal, tipe_barang, harga , jml_beli, total) 
            VALUES ( '" . $_POST['id_barang'] . "', '" . $_POST['nama_barang'] . "', '" . $_POST['tanggal'] . "', '" . $_POST['tipe_barang'] . "', '" . $_POST['harga'] . "', '" . $_POST['jml_beli'] . "', '" . $_POST['total'] . "');";
                                $simpan = mysqli_query($koneksi, $sql) or die("Proses Tambah data GAGAL! <br> ");
                                if ($simpan && isset($_GET['aksi'])) {
                                    if ($_GET['aksi'] == 'create') {
                                        header('Location: penjualan.php');
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
                                        <td><input type="hidden" name="id_trx"></td>
                                    </tr>
                                    <tr>
                                        <td> Kode Barang </td>
                                        <td><input type="text" name="id_barang" required id="id_trans"></td>
                                    </tr>
                                    <tr>
                                        <td> Nama Barang </td>
                                        <td><input type="text" name="nama_barang" required></td>
                                    </tr>
                                    <tr>
                                        <td> Tanggal </td>
                                        <td><input type="text" name="tanggal" id="date"></td>
                                    </tr>
                                    <tr>
                                        <td> Tipe Barang </td>
                                        <td><input type="text" name="tipe_barang" required></td>
                                    </tr>
                                    <tr>
                                        <td> Harga Barang </td>
                                        <td><input type="text" name="harga" required></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td> Jumlah Barang </td>
                                        <td><input type="text" name="jml_beli" required maxlength="11" pattern="[1-9]"></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td> Total </td>
                                        <td><input type="text" name="total" required></td>
                                    </tr>
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

                                <p><?php echo isset($pesan) ? $pesan : "" ?></p>
                </table>
            </article>
            </aside1>
        </div>
        <aside>
            <article id="" class="card">
                <h2> Data Barang Keluar </h2>
                <table>
                    <?php
                    }

                    //FUNCTION VIEW DATA 
                    function tampil_data($koneksi)
                    {
                        $seleksi = ("SELECT id_trx, id_barang, nama_barang, tipe_barang, harga, jml_beli, total FROM t_list_trx  ORDER BY id_trx") or die(mysqli_error());
                        $hasil_seleksi = mysqli_query($koneksi, $seleksi);

                        echo "<center>";
                        echo "<legend><h3 style='margin-top:0px;'> Data Barang Keluar </h3></legend>";

                        echo "<table class='tabel-data' class='table-hover' class='table-bordered' border='1'>";
                        echo "<tr>
                                                <th> ID Transaksi </th>
                                                <th> Kode Barang </th>
                                                <th> Nama Barang </th> 
                                                <th> Tipe Barang </th>
                                                <th> Harga Barang </th>
                                                <th> Jumlah Pembelian </th>
                                                <th> Total </th>
                                                <td colspan=1> Action </td>
                                                </tr>";

                        while ($data = mysqli_fetch_array($hasil_seleksi)) {

                    ?>
                        <tr>
                            <td><?php echo $data['id_trx']; ?></td>
                            <td><?php echo $data['id_barang']; ?></td>
                            <td><?php echo $data['nama_barang']; ?></td>
                            <td><?php echo $data['tipe_barang']; ?></td>
                            <td><?php echo $data['harga']; ?></td>
                            <td><?php echo $data['jml_beli']; ?></td>
                            <td><?php echo $data['total']; ?></td>
                            <td>
                                <a href="penjualan.php?aksi=delete&id_trx=<?= $data['id_trx']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>

                        </tr>
                <?php
                        }
                    }

                    // FUNCTION DELETE DATA 
                    function hapus($koneksi)
                    {
                        if (isset($_GET['id_trx']) && isset($_GET['aksi'])) {
                            $id_trx = $_GET['id_trx'];
                            $sql_hapus = "DELETE FROM t_list_trx WHERE id_trx=" . $id_trx;
                            $hapus = mysqli_query($koneksi, $sql_hapus);

                            if ($hapus) {
                                if ($_GET['aksi'] == 'delete') {
                                    header('Location: penjualan.php');
                                }
                            }
                        }
                    }
                    // --- Tutup Fungsi Hapus
                    // ===================================================================
                    // --- Program Utama
                    if (isset($_GET['aksi'])) {
                        switch ($_GET['aksi']) {
                            case "create":
                                echo '<a href="penjualan.php" class="btn btn-info"> &laquo; Home</a>';
                                tambah($koneksi);
                                break;
                            case "read":
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
        </aside>
        </article>
    </main>
    <footer>
        <p>Copyright &#169; 2020 Rul Corp Dev. All rights reserved.</p>
    </footer>
</body>

</html>