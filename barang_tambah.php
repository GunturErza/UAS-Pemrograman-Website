<?php
session_start();
require_once "koneksi.php"; // Memanggil koneksi database

// 1. KEAMANAN: Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// 2. PROSES SIMPAN DATA: Jika tombol 'Simpan Data' ditekan
if (isset($_POST['submit'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];

    // Query SQL untuk memasukkan data ke tabel barang
    $query_tambah = "INSERT INTO barang (kode_barang, nama_barang, harga, stok) 
                     VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok')";
    
    // Mengeksekusi query dan mengecek apakah berhasil
    if (mysqli_query($conn, $query_tambah)) {
        echo "<script>
                alert('Berhasil! Data barang baru telah ditambahkan.');
                window.location='barang.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UAS Project | Tambah Barang</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
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
            <h1>Tambah Data Barang</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Input Barang Baru</h3>
          </div>
          
          <form action="barang_tambah.php" method="POST">
            <div class="card-body">
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="Contoh: BRG-004" required>
              </div>
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang lengkap" required>
              </div>
              <div class="form-group">
                <label>Harga Satuan (Rp)</label>
                <input type="number" name="harga" class="form-control" placeholder="Hanya angka, contoh: 15000" required>
              </div>
              <div class="form-group">
                <label>Jumlah Stok</label>
                <input type="number" name="stok" class="form-control" placeholder="Masukkan jumlah stok awal" required>
              </div>
            </div>
            
            <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
              <a href="barang.php" class="btn btn-default float-right">Batal</a>
            </div>
          </form>
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
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
