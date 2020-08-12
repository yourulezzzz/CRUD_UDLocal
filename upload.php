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
                <h2> Upload Dokumen </h2>
                <table>
                    <?php
                    if (isset($_POST['upload'])) {
                        $allowed_ext    = array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip');
                        $file_name        = $_FILES['file']['name'];
                        $file_ext        = pathinfo($file_name, PATHINFO_EXTENSION);
                        $file_size        = $_FILES['file']['size'];
                        $file_tmp        = $_FILES['file']['tmp_name'];

                        $nama            = $_POST['nama'];
                        $tgl            = date("Y-m-d");

                        $koneksi = mysqli_connect("localhost", "root", "", "db_tokobangunan");

                        if (in_array($file_ext, $allowed_ext) === true) {
                            if ($file_size < 1044070) {
                                $lokasi = 'C:/xampp/htdocs/Website/upload/' . $nama . '.' . $file_ext;
                                move_uploaded_file($file_tmp, $lokasi);
                                $sql = ("INSERT INTO t_file_upload VALUES(NULL, '$tgl', '$nama', '$file_ext', '$file_size', '$lokasi')");
                                $simpan = mysqli_query($koneksi, $sql) or     die("Proses Tambah data GAGAL! <br> ");
                                if ($sql) {
                                    echo '<div class="ok">SUCCESS: File berhasil di Upload!</div>';
                                } else {
                                    echo '<div class="error">ERROR: Gagal upload file!</div>';
                                }
                            } else {
                                echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 1 Mb!</div>';
                            }
                        } else {
                            echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
                        }
                    }
                    ?>

                    <p>
                        <form action="" method="post" enctype="multipart/form-data">
                            <table width="100%" align="center" border="0" bgcolor="#eee" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="40%" align="right"><b>Nama File</b></td>
                                    <td><b>:</b></td>
                                    <td><input type="text" name="nama" size="40" required /></td>
                                </tr>
                                <tr>
                                    <td width="40%" align="right"><b>Pilih File</b></td>
                                    <td><b>:</b></td>
                                    <td><input type="file" name="file" required /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="upload" value="Upload" /></td>
                                </tr>
                            </table>
                            <p><?php echo isset($pesan) ? $pesan : "" ?></p>
                            <aside>
            </article>
        </div>
        <div id="content">
            <article id="" class="card">
                <h2> Download Dokumen </h2>
                <table class="table" width="100%" cellpadding="3" cellspacing="0">
                    <tr>
                        <th width="30">No.</th>
                        <th width="200">Tgl. Upload</th>
                        <th>Nama File</th>
                        <th width="70">Tipe</th>
                        <th width="70">Ukuran</th>
                    </tr>
                    <?php
                    include('config.php');
                    $koneksi = mysqli_connect("localhost", "root", "", "db_tokobangunan");
                    $sql = ("SELECT * FROM t_file_upload ORDER BY id DESC");
                    $download = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($download) > 0) {
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($download)) {
                            echo '
						<tr bgcolor="#fff">
							<td align="center">' . $no . '</td>
							<td align="center">' . $data['tanggal_upload'] . '</td>
							<td><a href="' . $data['file'] . '">' . $data['nama_file'] . '</a></td>
							<td align="center">' . $data['tipe_file'] . '</td>
							<td align="center">' . formatBytes($data['ukuran_file']) . '</td>
						</tr>
						';
                            $no++;
                        }
                    } else {
                        echo '
					<tr bgcolor="#fff">
						<td align="center" colspan="4" align="center">Tidak ada data!</td>
					</tr>
					';
                    }
                    ?>
                </table>
            </article>
        </div>

    </main>
    <footer>
        <p>Copyright &#169; 2020 Rul Corp Dev. All rights reserved.</p>
    </footer>
</body>

</html>