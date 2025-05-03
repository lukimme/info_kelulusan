<?php
session_start();
if (!isset($_COOKIE['token']) || !isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}
include 'config.php';
$no = $_SESSION['user'];
$q = $conn->query("SELECT * FROM data_kelulusan WHERE no_peserta = '$no'");
$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasil Kelulusan</title>
    <link rel="icon" type="image/png" href="img/logtitle.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    @keyframes smoothFadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-smooth-fade-in {
        animation: smoothFadeIn 0.7s ease-out forwards;
    }
    </style>


</head>

<body class="min-h-screen bg-cover bg-no-repeat bg-center overflow-hidden"
    style="background-image: url('img/bg22.jpg');">
    <div class="bg-black bg-opacity-70 min-h-screen flex items-center justify-center p-4">



        <div id="hasil-konten" class="bg-white rounded-lg shadow-lg max-w-[800px] w-full p-6 mx-auto text-center">

            <!-- Loader di dalam hasil konten -->
            <div id="konten-loader" class="flex flex-col items-center justify-center min-h-[300px]">
                <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-blue-500 mb-4"></div>
                <p class="text-gray-700 font-medium">Memuat hasil kelulusan...</p>
            </div>

            <div id="konten-asli" class="hidden">
                <img src="img/logopanjang.png" alt="Logo Sekolah" class="mx-auto w-40 mb-4" />
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">PENGUMUMAN KELULUSAN PESERTA DIDIK
                </h2>
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">SMK BUDI MULIA PAKISAJI</h2>
                <p class="text-gray-600 mt-1 mb-6 text-sm md:text-base">Tahun Pelajaran 2024/2025</p>

                <p class="text-gray-600 mb-6 text-sm md:text-base">
                    Berdasarkan rapat pleno kelulusan dan surat keputusan Kepala SMK Budi Mulia Pakisaji dengan nomor:
                    <strong>019/SMK.BM/SK/E.2/V/2025</strong>
                    mengumumkan bahwa peserta didik dengan nomor ujian:<br> <?= $data['no_peserta'] ?>
                </p>

                <div class="text-gray-800 mb-6 text-sm md:text-base text-center">
                    <p class="text-2xl"><strong><?= $data['nama_siswa'] ?></strong> </p>
                    <p>NISN <?= $data['nisn'] ?> | Kelas <?= $data['kelas'] ?></p>

                </div>


                <?php
$ket = strtoupper($data['ket']); // pastikan kapitalisasi seragam
$bgClass = $ket === 'LULUS' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
?>

                <div class="py-4 px-6 rounded font-bold text-xl md:text-2xl uppercase mb-4 <?= $bgClass ?>">
                    DINYATAKAN <?= $ket ?>
                </div>
                <!-- <div
                    class=" py-4 px-6 rounded bg-green-100 text-green-700 font-bold text-xl md:text-2xl uppercase mb-4">
                    DINYATAKAN <?= $data['ket'] ?>
                </div> -->

                <p class="text-sm text-gray-600 mb-6">
                    Silakan cetak hasil ini dan hubungi wali kelas untuk informasi lebih lanjut.
                </p>

                <div class="flex flex-wrap justify-center gap-2 mt-6">
                    <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded"
                        onclick="window.location.href='https://smkbudimuliapakisaji.sch.id'">Kembali</button>
                    <button class="bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="downloadAsPDF()">Download
                    </button>
                </div>

                <p id="jamSekarang" class="text-gray-600 mb-4 mt-6 text-sm italic"> </p>

            </div>
        </div>
    </div>


    <script>
    function downloadAsPDF() {
        const element = document.getElementById('hasil-konten');

        const opt = {
            margin: [10, 10, 10, 10], // top, left, bottom, right
            filename: 'hasil_kelulusan_<?= $data["nama_siswa"] ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 3,
                useCORS: true
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            },
            pagebreak: {
                mode: ['avoid-all']
            }
        };

        html2pdf().set(opt).from(element).save();
    }
    </script>

    <script>
    function updateWaktu() {
        const now = new Date();
        const jam = now.getHours().toString().padStart(2, '0');
        const menit = now.getMinutes().toString().padStart(2, '0');
        const detik = now.getSeconds().toString().padStart(2, '0');
        const waktu = `${jam}:${menit}:${detik}`;
        document.getElementById('jamSekarang').textContent = `diakses online pukul: ${waktu}`;
    }

    // Update setiap detik
    setInterval(updateWaktu, 1000);
    updateWaktu(); // Jalankan saat pertama kali
    </script>

    <script>
    setTimeout(() => {
        document.getElementById('konten-loader').style.display = 'none';
        const kontenAsli = document.getElementById('konten-asli');
        kontenAsli.classList.remove('hidden');
        kontenAsli.classList.add('animate-smooth-fade-in');
    }, 3500);
    </script>




</body>

</html>