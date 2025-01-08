<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "travel_umroh_haji"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID paket dari URL
$id_paket = isset($_GET['id_paket']) ? intval($_GET['id_paket']) : 0;

// Query data paket berdasarkan ID
$sql = "SELECT 
            p.id_paket,
            np.nama_paket, 
            p.harga, 
            p.tanggal_berangkat, 
            p.kuota, 
            p.durasi_perjalanan, 
            p.rute_perjalanan, 
            p.fasilitas, 
            p.deskripsi_paket, 
            p.itinerary, 
            p.syarat_ketentuan, 
            p.gambar
        FROM paket_umroh_haji p
        JOIN nama_paket np ON p.id_nama_paket = np.id_nama_paket
        WHERE p.id_paket = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_paket);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ambil data paket
    $row = $result->fetch_assoc();
    $nama_paket = $row['nama_paket'];
    $harga = number_format($row['harga'], 0, ',', '.');
    $tanggal_berangkat = date("d M Y", strtotime($row['tanggal_berangkat']));
    $durasi_perjalanan = $row['durasi_perjalanan'];
    $rute_perjalanan = nl2br($row['rute_perjalanan']);
    $fasilitas = nl2br($row['fasilitas']);
    $deskripsi_paket = nl2br($row['deskripsi_paket']);
    $itinerary = nl2br($row['itinerary']);
    $syarat_ketentuan = nl2br($row['syarat_ketentuan']);
    $gambar = $row['gambar'];
} else {
    echo "Data paket tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nama_paket); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<header class="bg-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="../assets/logo1.jpeg" alt="Alfalah" style="width: 80px; height: auto;">
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-dark" href="../Home/index.html">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Paket Umroh
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../paket-umroh/index.html">Umroh Bronze</a></li>
                            <li><a class="dropdown-item" href="#">Umroh Silver</a></li>
                            <li><a class="dropdown-item" href="#">Umroh Radiant</a></li>
                            <li><a class="dropdown-item" href="#">Umroh Ascendant</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" href="#" id="jadwalDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Jadwal Umroh
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="jadwalDropdown">
                            <li><a class="dropdown-item" href="#">Januari</a></li>
                            <li><a class="dropdown-item" href="#">Februari</a></li>
                            <li><a class="dropdown-item" href="#">Maret</a></li>
                            <li><a class="dropdown-item" href="#">April</a></li>
                            <li><a class="dropdown-item" href="#">Mei</a></li>
                            <li><a class="dropdown-item" href="#">Juni</a></li>
                            <li><a class="dropdown-item" href="#">Juli</a></li>
                            <li><a class="dropdown-item" href="#">Agustus</a></li>
                            <li><a class="dropdown-item" href="#">September</a></li>
                            <li><a class="dropdown-item" href="#">Oktober</a></li>
                            <li><a class="dropdown-item" href="#">November</a></li>
                            <li><a class="dropdown-item" href="#">Desember</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Haji</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Kemitraan</a></li>
                </ul>
            </nav>
            <a href="#" class="btn" style="background-color: maroon; color: white;">Login Admin</a>
        </div>
    </header>

    <div class="container mt-4">
        <!-- Header Paket -->
        <div class="row">
            <div class="col-lg-8">
                <h1 class="fw-bold"><?php echo htmlspecialchars($nama_paket); ?></h1>
                <div class="badge-wrapper">
                    <span class="badge-custom badge-airline">Garuda Indonesia</span>
                    <span class="badge-custom badge-status">Tersedia</span>
                </div>
            </div>
        </div>

        <!-- Gambar dan Info Utama -->
        <div class="row">
            <div class="col-lg-8">
                <div id="paketCarousel" class="carousel slide mb-4">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="path_to_images/<?php echo htmlspecialchars($gambar); ?>" 
                                class="d-block w-100" 
                                alt="<?php echo htmlspecialchars($nama_paket); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="card-body">
                        <h3 class="price-title">Mulai Dari</h3>
                        <h2 class="price-amount">Rp <?php echo $harga; ?></h2>
                        <hr>
                        <ul class="feature-list">
                            <li><i class="bi bi-calendar"></i> Keberangkatan: <?php echo $tanggal_berangkat; ?></li>
                            <li><i class="bi bi-clock"></i> Durasi: <?php echo $durasi_perjalanan; ?> Hari</li>
                            <li><i class="bi bi-airplane"></i> Maskapai: Garuda Indonesia</li>
                        </ul>
                        <button class="btn-booking"><a class="nav-link text-white" href="../pendaftaran/index.html">Pesan Sekarang</a></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Paket -->
        <div class="row mt-4">
            <div class="col-12">
                <h3>Deskripsi Paket</h3>
                <p class="deskripsi-paket">
                    <?php echo $deskripsi_paket; ?>
                </p>
            </div>
        </div>

        <!-- Detail Program -->
        <div class="row mt-4">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#itinerary">Itinerary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#syarat">Syarat & Ketentuan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-content p-3 border border-top-0">
                        <!-- Tab Itinerary -->
                        <div class="tab-pane fade show active" id="itinerary">
                            <?php echo $itinerary; ?>
                        </div>

                        <!-- Tab Fasilitas -->
                        <div class="tab-pane fade" id="fasilitas">
                            <?php echo $fasilitas; ?>
                        </div>

                        <!-- Tab Syarat -->
                        <div class="tab-pane fade" id="syarat">
                            <?php echo $syarat_ketentuan; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Brand & Description -->
                <div class="col-md-3 mb-4">
                    <div class="footer-brand">
                        <span>Alfalah</span>
                        <div style="font-size: 14px;">Haji & Umroh</div>
                    </div>
                    <p class="footer-description">Comfortable and Quiet Worship, Our Service No. 1 in Indonesia</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2 mb-4">
                    <h5 class="footer-heading">Quicky</h5>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Akomodasi Penerbangan</a></li>
                        <li><a href="#">Fasilitas</a></li>
                        <li><a href="#">Galeri</a></li>
                    </ul>
                </div>

                <!-- Paket Umroh -->
                <div class="col-md-2 mb-4">
                    <h5 class="footer-heading">Paket Umroh</h5>
                    <ul class="footer-links">
                        <li><a href="#">Umroh Bronze</a></li>
                        <li><a href="#">Umroh Silver</a></li>
                        <li><a href="#">Umroh Radiant</a></li>
                        <li><a href="#">Umroh Ascendant</a></li>
                    </ul>
                </div>

                <!-- Paket Haji -->
                <div class="col-md-2 mb-4">
                    <h5 class="footer-heading">Paket Haji</h5>
                    <ul class="footer-links">
                        <li><a href="#">Haji Immortal</a></li>
                        <li><a href="#">Haji Diamond</a></li>
                        <li><a href="#">Haji Platinum</a></li>
                    </ul>
                </div>

                <!-- Kantor Kami -->
                <div class="col-md-3 mb-4">
                    <h5 class="footer-heading">Kantor Kami</h5>
                    <ul class="footer-links">
                        <li><a href="#">Indonesia</a></li>
                        <li><a href="#">Saudi Arabia</a></li>
                        <li><a href="#">Uni Emirates Arab</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="row footer-bottom">
                <div class="col-md-6">
                    <small>Copyright © 2006 - 2023 Al Nasr Travel | All Reserved</small>
                </div>
                <div class="col-md-6 text-end">
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>