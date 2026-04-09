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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans text-slate-800 bg-slate-50 flex flex-col min-h-screen overflow-x-hidden selection:bg-purple-200 selection:text-purple-900">

    <?php include 'components/navbar.php'; ?>

    <main class="flex-grow relative">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-300/40 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-[20%] right-[-10%] w-[400px] h-[400px] bg-indigo-300/40 rounded-full blur-[100px]"></div>
        </div>

        <section class="pt-16 pb-20 lg:pt-24 lg:pb-32 px-4">
            <div class="container mx-auto max-w-6xl">
                <div class="relative bg-white/40 backdrop-blur-2xl border border-white/60 shadow-2xl rounded-[3rem] p-8 md:p-16 lg:p-20 text-center overflow-hidden">
                    
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-32 bg-gradient-to-b from-purple-100/50 to-transparent rounded-full blur-2xl"></div>

                    <div class="relative z-10 max-w-3xl mx-auto">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 border border-purple-100 shadow-sm mb-8">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-600"></span>
                            </span>
                            <span class="text-xs font-bold tracking-wide text-purple-700 uppercase">Akurasi Algoritma 95%</span>
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8 text-slate-900">
                            Navigasi Masa Depan <br class="hidden md:block" />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-500">Bukan Sekadar Tebakan.</span>
                        </h1>
                        
                        <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed font-medium">
                            Tinggalkan kebingungan. PILIH.in memetakan minat bakatmu menjadi <strong class="text-slate-800">Roadmap Karir Semester 1-8</strong> secara instan dengan data terstandarisasi DIKTI.
                        </p>

                        <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="dashboard.php" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                                    Buka Dashboard Saya
                                </a>
                            <?php else: ?>
                                <a href="tes.php" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-purple-500/30 hover:shadow-2xl hover:shadow-purple-500/50 hover:-translate-y-1 transition duration-300">
                                    Mulai Assessment Gratis
                                </a>
                                <a href="kampus.php" class="w-full sm:w-auto px-8 py-4 bg-white/80 backdrop-blur-md text-slate-700 font-bold rounded-2xl hover:bg-white transition duration-300 border border-slate-200 shadow-sm hover:shadow-md">
                                    Eksplorasi Kampus
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-[-4rem] md:mt-[10rem] relative z-20 max-w-5xl mx-auto px-4">
                    <div class="bg-white/80 backdrop-blur-xl border border-white/50 p-2 rounded-3xl shadow-2xl">
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl h-48 md:h-80 overflow-hidden relative flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-50 opacity-50"></div>
                            <div class="text-center z-10 opacity-40">
                                <span class="text-6xl block mb-2">📊</span>
                                <p class="font-bold text-slate-400 font-mono text-sm tracking-widest uppercase">Visualisasi Roadmap Interactive</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        
        <section class="py-20 relative z-10">
            <div class="container mx-auto px-4 lg:px-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
                    <div class="bg-white/60 backdrop-blur-lg p-8 rounded-[2rem] border border-white/60 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                        <div class="w-14 h-14 bg-white border border-purple-100 shadow-sm text-purple-600 flex items-center justify-center rounded-2xl mb-6 text-2xl">⚡</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Analisis Instan</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Algoritma cerdas yang memproses jawabanmu dalam hitungan milidetik untuk hasil yang sangat presisi.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-lg p-8 rounded-[2rem] border border-white/60 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                        <div class="w-14 h-14 bg-white border border-purple-100 shadow-sm text-purple-600 flex items-center justify-center rounded-2xl mb-6 text-2xl">🗺️</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Roadmap Terstruktur</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Dapatkan peta jalan akademik lengkap dengan rincian mata kuliah krusial dari semester pertama hingga lulus.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-lg p-8 rounded-[2rem] border border-white/60 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300">
                        <div class="w-14 h-14 bg-white border border-purple-100 shadow-sm text-purple-600 flex items-center justify-center rounded-2xl mb-6 text-2xl">💼</div>
                        <h3 class="font-bold text-xl mb-3 text-slate-800">Prospek Industri 4.0</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Rekomendasi yang diselaraskan langsung dengan kebutuhan *skill* industri dan peluang karir masa depan.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'components/footer.php'; ?>

</body>
</html>
