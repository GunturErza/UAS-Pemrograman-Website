x   <?php
session_start();
require_once "koneksi.php";

// Cek apakah user sudah login, arahkan ke login.php jika belum [cite: 118, 119]
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Ambil data barang dari database (Sesuaikan nama tabel dengan yang ada di database kamu)
$query = mysqli_query($conn, "SELECT * FROM barang ORDER BY id ASC");
?>

<div class="card-body">
    <a href="barang_tambah.php" class="btn btn-primary btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah Data Barang
    </a>

    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php
            [cite_start]$no = 1; [cite: 138, 139]
            [cite_start]// Looping data dari database [cite: 140]
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
