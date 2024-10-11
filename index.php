<?php
// Sertakan file koneksi
include 'koneksi.php';

// Query untuk mendapatkan data catatan
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container">
<h2>Daftar Catatan</h2>
    <a class='btn btn-info btn-sm' href="pages/create.php">Tambah Catatan Baru</a>
    <a class='btn btn-info btn-sm' href="pages/tentangsaya.php">Tentang Saya</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Catatan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                // Looping data dari database
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-success btn-sm' href='./pages/edit.php?id=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a class='btn btn-danger btn-sm' href='./actions/delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Belum ada catatan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>

</html>
<?php
// Tutup koneksi
$conn->close();
?>
