<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PILIH.in - Navigasi Masa Depanmu</title>
    <link href="./src/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans text-slate-800 bg-slate-50 flex flex-col min-h-screen overflow-x-hidden">

    <?php include 'component/navbar.php'; ?>

    <main class="flex-grow">
        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-gradient-to-br from-purple-600 via-purple-500 to-indigo-600">
            
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 left-10 w-72 h-72 bg-purple-300 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-4 lg:px-12 relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-6 drop-shadow-md">
                    Jangan Biarkan Masa Depanmu <br class="hidden md:block" />
                    <span class="text-purple-200">Hanya Sekadar Tebakan.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                    Lebih dari 70% mahasiswa merasa salah jurusan. PILIH.in hadir dengan algoritma presisi untuk memetakan minat bakatmu menjadi roadmap karir Semester 1-8.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="w-full sm:w-auto px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition duration-300">
                            Ke Dashboard Saya
                        </a>
                    <?php else: ?>
                        <a href="tes.php" class="w-full sm:w-auto px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition duration-300">
                            ✨ Mulai Tes Minat Bakat
                        </a>
                        <a href="kampus.php" class="w-full sm:w-auto px-8 py-4 bg-purple-700/50 text-white font-bold rounded-2xl hover:bg-purple-700/70 backdrop-blur-md transition duration-300 border border-purple-400/30">
                            Eksplorasi Kampus
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
                <svg class="relative block w-full h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,155.15,122.1,215,108.36c83.5-19.34,151.7-52.5,233.1-70.16C524.3,21.56,603.2,16.44,682.3,21.56c80,5.26,155.4,30.31,232.7,53.25C989.3,96.86,1065.5,110.19,1142.1,95.8Z" fill="#f8fafc"></path>
                </svg>
            </div>
        </section>
        
        <section class="py-20 bg-slate-50">
            <div class="container mx-auto px-4 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 flex items-center justify-center rounded-2xl mx-auto mb-6 text-3xl">⏱️</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Cepat & Presisi</h3>
                        <p class="text-slate-500 text-sm">Algoritma rekomendasi instan di bawah 5 detik berbasis data kurikulum standar DIKTI.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 flex items-center justify-center rounded-2xl mx-auto mb-6 text-3xl">🗺️</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Visualisasi Roadmap</h3>
                        <p class="text-slate-500 text-sm">Tidak hanya nama jurusan, kami berikan peta jalan spesifik dari semester 1 hingga 8.</p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg transition text-center">
                        <div class="w-16 h-16 bg-purple-100 text-purple-600 flex items-center justify-center rounded-2xl mx-auto mb-6 text-3xl">🎯</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Prospek Karir</h3>
                        <p class="text-slate-500 text-sm">Jaminan arah karir masa depan yang terkalibrasi dengan kebutuhan industri 4.0.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'component/footer.php'; ?>

</body>
</html>