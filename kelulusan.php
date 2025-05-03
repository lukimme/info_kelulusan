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
    </style>


</head>

<body class="min-h-screen bg-cover bg-no-repeat bg-center overflow-hidden"
    style="background-image: url('img/bg22.jpg');">
    <div class="bg-black bg-opacity-70 min-h-screen flex items-center justify-center p-4">
        <div id="hasil-konten" class="bg-white rounded-lg shadow-lg max-w-[800px] w-full p-6 mx-auto text-center">
            <!-- <div id="hasil-konten" class="bg-white p-6 md:p-10 rounded-lg shadow max-w-[800px] mx-auto text-center"> -->

            <img src="img/logopanjang.png" alt="Logo Sekolah" class="mx-auto w-40 mb-4" />
            <h2 class="text-2xl  font-bold text-gray-800">PENGUMUMAN HASIL UJIAN SEKOLAH</h2>
            <h2 class="text-2xl  font-bold text-gray-800">SMK BUDI MULIA PAKISAJI</h2>
            <p class="text-gray-600 mt-1 mb-6 text-sm md:text-base">Tahun Pelajaran 2024/2025</p>

            <p class="text-gray-600 mb-6 text-sm md:text-base">
                Berdasarkan surat keputusan Kepala SMK Budi Mulia Pakisaji dengan nomor:
                <strong>019/SMK.BM/SK/E.2/V/2025</strong>
                mengumumkan bahwa ananda dengan nomor ujian: <?= $data['no_peserta'] ?>
            </p>

            <div class="text-gray-800 mb-6 text-sm md:text-base text-center">
                <p class="text-2xl"><strong><?= $data['nama_siswa'] ?></strong> </p>
                <p>NISN <?= $data['nisn'] ?> | Kelas <?= $data['kelas'] ?></p>

            </div>

            <div class=" py-4 px-6 rounded bg-green-100 text-green-700 font-bold text-xl md:text-2xl uppercase mb-4">
                DINYATAKAN LULUS
            </div>

            <p class="text-sm text-gray-600 mb-6">
                Silakan cetak hasil ini dan hubungi wali kelas untuk informasi lebih lanjut.
            </p>

            <div class="flex flex-wrap justify-center gap-2 mt-6">
                <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded"
                    onclick="window.location.href='index.html'">Kembali</button>
                <button class="bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="downloadAsPDF()">Download
                </button>
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


</body>

</html>