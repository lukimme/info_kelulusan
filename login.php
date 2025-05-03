<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Kelulusan SMKBM</title>
    <link rel="icon" type="img/png" href="img/logtitle.png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center  bg-no-repeat min-h-screen"
    style="background-image: url('img/b3.jpg');background-position: top center; background-size: cover; ">
    <div class="bg-black bg-opacity-60 min-h-screen flex items-center justify-center">
        <div class="bg-cyan-500 bg-opacity-70 text-white p-8 rounded-lg w-full max-w-lg mx-4">
            <img src="img/logopanjang.png" alt="SMKBM" class="mx-auto mb-6 max-w-xs" />
            <h2 class="text-base md:text-3xl font-bold text-center mb-3 mt-4">
                PENGUMUMAN KELULUSAN<br />SMK BUDI MULIA PAKISAJI
            </h2>
            <p class="text-center mt-6 mb-4">Masukkan Nomor Peserta Ujian dan NISN.</p>
            <form method='POST' action='proses_login.php'>
                <div class="mb-4">
                    <label for="nomor" class="block font-semibold text-sm text-white mb-1">Nomor Peserta Ujian</label>
                    <input type="text" id="nomor" name='no_peserta' placeholder="4-XX-XX-XX-XXXX-XXXX-7"
                        class="w-full px-3 py-2 rounded border border-white bg-white text-black placeholder-gray-500"
                        required />
                </div>
                <div class="mb-4">
                    <label for="nisn" class="block font-semibold text-sm text-white mb-1">NISN</label>
                    <input type="text" id="nisn" name='nisn' placeholder="Nomor Induk Siswa Nasional"
                        class="w-full px-3 py-2 rounded border border-white bg-white text-black placeholder-gray-500"
                        required />
                </div>

                <?php if (isset($_GET['error'])): ?>
                <div id="alert-box"
                    class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 bg-red-500 text-white px-6 py-3 rounded shadow-lg z-50 transition duration-500 ease-in-out">
                    <strong>Tidak Terdaftar!</strong> Nomor peserta atau NISN salah.
                </div>

                <script>
                const alertBox = document.getElementById('alert-box');

                // Muncul halus
                setTimeout(() => {
                    alertBox.classList.remove('opacity-0', '-translate-y-1/2');
                    alertBox.classList.add('opacity-100', '-translate-y-20'); // Sedikit naik untuk efek muncul
                }, 100);

                // Hilang halus ke bawah setelah 5 detik
                setTimeout(() => {
                    alertBox.classList.remove('opacity-100', '-translate-y-20');
                    alertBox.classList.add('opacity-0', 'translate-y-10'); // Turun saat menghilang
                    setTimeout(() => alertBox.remove(), 500); // Hapus dari DOM
                }, 5000);
                </script>
                <?php endif; ?>


                <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-800 rounded text-white font-bold">
                    LIHAT HASIL
                    KELULUSAN</button>
            </form>
            <div class="mt-4 text-center">
                <a href="https://smkbudimuliapakisaji.sch.id/"
                    class="text-cyan-100 italic">www.smkbudimuliapakisaji.sch.id</a>
            </div>
        </div>
    </div>
</body>

</html>