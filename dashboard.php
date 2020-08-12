<!DOCTYPE html>
<html>

<head>
    <title> Website Toko Bangunan </title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <article class="card">
                <h1>Tentang</h1>
                <p>
                    TB. --- merupakan sebuah perusahaan perorangan yang membantu
                    masyarakat untuk mendapatkan bahan-bahan bangunan secara mudah dan murah
                    untuk menciptakan pembangunan yang lebih maju. Dengan dukungan kuat dan
                    pengembangan yang berkualitas dalam usaha bahan bangunan, segmen usaha yang
                    dikelola oleh perusahaan bangunan ini memproduksi berbagai macam keperluan
                    bahan bangunan serta membuat barang yang berupa internite, paping blok, biss beton,
                    dan batako. <br> <br>
                    Adapun hari kerja karyawan di Toko Bangunan -- yaitu hari Senin
                    sampai Sabtu. Untuk jam kerjanya mulai pukul 07.30 sampai 17.00 WIB, dengan
                    waktu istirahat pukul 11.45 sampai 12.30 WIB
                </p>
            </article>
            <article id="" class="card">
                <h2> Data Barang </h2>
                <table>
                    <?php

                    //CONNECTION DATABASE
                    $koneksi = mysqli_connect("localhost", "root", "", "db_tokobangunan");


                    //FUNCTION VIEW DATA 
                    function tampil_data($koneksi)
                    {
                        $seleksi = ("SELECT t_barang.id_barang, t_barang.nama_barang, t_barang.tipe_barang, t_barang.ukuran, SUM(stock) AS Total, m_barang.harga FROM t_barang INNER JOIN m_barang ON t_barang.id_barang = m_barang.id_barang GROUP BY id_barang,nama_barang ORDER BY id_barang") or die(mysqli_error());
                        $hasil_seleksi = mysqli_query($koneksi, $seleksi);

                        echo "<center>";
                        echo "<table class='tabel-data' class='table-hover' class='table-bordered' border='1' >";
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
                                echo '<a href="dashboard.php" class="btn btn-info"> &laquo; Home</a>';
                            default:
                                tampil_data($koneksi);
                        }
                    } else {
                        tampil_data($koneksi);
                    }
                    ?>

                </table>
            </article>
        </div>
        <aside>
            <article id="home" class="card">
                <h2> Data Barang Keluar </h2>
                <table>
                    <?php

                    //FUNCTION VIEW DATA 
                    function tampil_data1($koneksi)
                    {
                        $seleksi = ("SELECT id_trx, id_barang, nama_barang, tipe_barang, harga, jml_beli, total FROM t_list_trx GROUP BY id_barang,nama_barang ORDER BY id_barang") or die(mysqli_error());
                        $hasil_seleksi = mysqli_query($koneksi, $seleksi);

                        echo "<center>";
                        echo "<legend><h3 style='margin-top:0px;'> Data Barang </h3></legend>";

                        echo "<table class='tabel-data' class='table-hover' class='table-bordered' border='1'>";
                        echo "<tr>
                                                <th> ID Transaksi </th>
                                                <th> Kode Barang </th>
                                                <th> Nama Barang </th> 
                                                <th> Tipe Barang </th>
                                                <th> Harga Barang </th>
                                                <th> Jumlah Pembelian </th>
                                                <th> Total </th>
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
                            default:
                                tampil_data1($koneksi);
                        }
                    } else {
                        tampil_data1($koneksi);
                    }
                    ?>
                    <?php

                    ?>
                </table>
            </article>
        </aside>

    </main>
    <footer>
        <p>Copyright &#169; 2020 Rul Corp Dev. All rights reserved.</p>
    </footer>
</body>

</html>