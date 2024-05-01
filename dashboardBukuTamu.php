<?php
require 'database.php';
include 'logicBukuTamu.php';

// Ambil data pemesan dari database
$pengunjung = query("SELECT * FROM pengunjung");
// Jika tombol delete ditekan
if(isset($_GET['id_pengunjung'])) {
  $delete_id = $_GET['id_pengunjung'];
  
  // Query untuk menghapus data dari database
  $query = "DELETE FROM pengunjung WHERE id_pengunjung = $delete_id";
    $result = mysqli_query($connectdb, $query);

    if($result) {
      // Redirect kembali ke halaman ini setelah menghapus data
      header("Location: ".$_SERVER['PHP_SELF']);
      exit;
    } else {
      echo "Error deleting record: " . mysqli_error($connectdb);
    }
  }
  $sambutanAdmin = "Selmat Datang Admin!";
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container mt-5">
      <div class="col-md-12 text-end">
        <a href="loginAdmin.php" class="btn btn-danger mt-3 py-2 px-3">Log-out</a>
      </div>
      <h1>Data Buku Tamu</h1>
      <b class="text-primary"><?php echo $sambutanAdmin; ?></b>
      <hr>
      <div class="d-flex justify-content-center">
        <a href="dashboardadmin.php" class="btn btn-primary mt-3 py-2 px-5 mx-2">Data Pemesan</a>
        <a href="dashboardBukuTamu.php" class="btn btn-primary mt-3 py-2 px-5">Data Buku Tamu</a>
      </div>
      <hr />
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pengunjung</th>
            <th>Telepon</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th class="px-5">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($pengunjung as $custemer) : ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?= $custemer["nama_pengunjung"]; ?></td>
            <td><?= $custemer["telepon_pengunjung"]; ?></td>
            <td><?= $custemer["pesan_pengunjung"]; ?></td>
            <td><?= $custemer["tanggal"];?></td>
            <td>
              <?= date('d-m-y | H:i:s',strtotime($custemer["tanggal"])); ?>
            </td>
            <td>
              <!-- Tombol delete -->
              <button
                type="button"
                class="btn btn-outline-danger"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal<?= $custemer['id_pengunjung']; ?>"
              >
                delete
              </button>
            </td>
          </tr>
          <div
            class="modal fade"
            id="exampleModal<?= $custemer['id_pengunjung']; ?>"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Konfirmasi Penghapusan Data
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Tutup
                  </button>
                  <a
                    href="?id_pengunjung=<?= $custemer['id_pengunjung']; ?>"
                    class="btn btn-danger"
                    >Hapus</a
                  >
                </div>
              </div>
            </div>
          </div>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
