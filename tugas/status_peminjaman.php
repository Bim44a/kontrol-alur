<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">Informasi Status Peminjaman</h3>
            </div>

            <div class="card-body">
                <?php
                //----DATA ANGGOTA----//
                $nama_anggota = "Budi Santoso";
                $total_pinjaman = 2;
                $buku_terlambat = 1;
                $hari_keterlambatan = 5;

                //----LEVEL MEMBER dengan SWITCH----//
                $level_member = "";
                switch (true) {
                    case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
                        $level_member = "Bronze";
                        break;
                    case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
                        $level_member = "Silver";
                        break;
                    case ($total_pinjaman > 15):
                        $level_member = "Gold";
                        break;
                    default:
                        $level_member = "Tidak Diketahui";
                        break;
                }

                //---LOGIC PINJAMAN & DENDA dengan IF-ELSEIF-ELSE---//
                $denda_per_hari = 1000;
                $maksimal_denda = 50000;

                $total_denda = 0;
                $status_pinjam = "";
                $peringatan = "";

                // Hitung denda
                if ($buku_terlambat > 0) {
                    $total_denda = $buku_terlambat * $hari_keterlambatan *
                        $denda_per_hari;

                    if ($total_denda > $maksimal_denda) {
                        $total_denda = $maksimal_denda;
                    }

                    $status_pinjam = "Tidak bisa meminjam (ada keterlambatan)";
                    $peringatan = "Anda memiliki keterlambatan selama $hari_keterlambatan hari.";
                } elseif ($total_pinjaman >= 3) {

                    $status_pinjam = "Tidak bisa meminjam (batas maksimal tercapai)";
                    $peringatan = "Anda sudah mencapai batas maksimal peminjaman.";
                } else {

                    $status_pinjam = "Boleh meminjam buku";
                    $peringatan = "Tidak ada keterlambatan.";
                }
                ?>

                <!-- Informasi Anggota -->
                <h4>Data Anggota</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Nama:</strong> <?= $nama_anggota ?></li>
                    <li class="list-group-item"><strong>Level Member:</strong> <?= $level_member ?></li>
                    <li class="list-group-item"><strong>Total Pinjaman:</strong> <?= $total_pinjaman ?> buku</li>
                </ul>

                <hr>

                <!-- Status -->
                <h4>Status Peminjaman</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Status:</strong> <?= $status_pinjam ?></li>
                    <li class="list-group-item"><strong>Buku Terlambat:</strong> <?= $buku_terlambat ?> buku</li>
                    <li class="list-group-item">
                        <strong>Total Denda:</strong> Rp <?= number_format($total_denda, 0, ',', '.') ?>
                    </li>
                </ul>

                <!-- Peringatan -->
                <p><strong>Keterangan:</strong> <?= $peringatan ?></p>

            </div>
        </div>
    </div>
</body>

</html>