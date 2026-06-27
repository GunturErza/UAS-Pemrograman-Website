<?php
session_start();
require_once "koneksi.php"; // Memanggil koneksi database

// 1. KEAMANAN: Cek apakah user sudah login. Jika belum, tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// 2. DATA FETCHING: Ambil semua data dari tabel barang di MySQL
$query = mysqli_query($conn, "SELECT * FROM barang ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UAS Project | Data Barang</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin logout?')">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Project UAS Toko</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><i class="fas fa-user mr-2"></i> <?php echo $_SESSION['username']; ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-box"></i>
              <p>Data Master <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="barang.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Data Barang</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Barang Toko</h3>
            <div class="card-tools">
              <a href="barang_tambah.php" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Data Barang
              </a>
            </div>
          </div>
          
          <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th width="10%">Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                // Looping mengambil data mysql baris demi baris
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($row['kode_barang']); ?></td>
                  <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                  <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                  <td><?= htmlspecialchars($row['stok']); ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Version 1.0</div>
    <strong>Copyright &copy; 2026.</strong> All rights reserved.
  </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });
  });
</script>
</body>
</html>
