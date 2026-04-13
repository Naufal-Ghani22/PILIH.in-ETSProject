<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - PILIH.in</title>
    <meta name="description"
        content="Kenali tim di balik PILIH.in — platform rekomendasi jurusan berbasis minat bakat terbaik untuk mahasiswa baru Indonesia.">
    <link href="./src/output.css" rel="stylesheet">
    <link href="./src/tentang.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <main>

        <!-- ════════════════════════════════════════════ -->
        <!--  HERO SECTION                                -->
        <!-- ════════════════════════════════════════════ -->
        <section class="hero-section">
            <div class="hero-bg">
                <div class="orb o1"></div>
                <div class="orb orb-delay o2"></div>
                <div class="o3"></div>
            </div>

            <div class="t-container">
                <!-- Badge -->
                <div class="reveal hero-badge">
                    <div class="dot-wrap" style="position:relative;width:10px;height:10px;flex-shrink:0;">
                        <span class="ping dot-ping"
                            style="position:absolute;inset:0;border-radius:50%;background:rgba(168,85,247,0.65);"></span>
                        <span class="dot-solid"
                            style="position:absolute;inset:2px;border-radius:50%;background:#9333ea;"></span>
                    </div>
                    <span>Tim Pengembang PILIH.in</span>
                </div>

                <!-- Title -->
                <h1 class="reveal hero-title" style="transition-delay:80ms">
                    Dibuat dengan ❤️ <span class="grad">Passion</span><br>& Dedikasi
                </h1>

                <!-- Subtitle -->
                <p class="reveal hero-sub" style="transition-delay:160ms">
                    Kami adalah tiga mahasiswa yang percaya bahwa setiap siswa berhak mendapat panduan karir yang
                    cerdas, personal, dan gratis.
                </p>

                <!-- Stats -->
                <div class="reveal stats-grid" style="transition-delay:240ms">
                    <div class="stat-card">
                        <div class="stat-num">3</div>
                        <div class="stat-label">Developer</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num">95%</div>
                        <div class="stat-label">Akurasi AI</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-num">∞</div>
                        <div class="stat-label">Semangat</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ════════════════════════════════════════════ -->
        <!--  TIM PENGEMBANG                              -->
        <!-- ════════════════════════════════════════════ -->
        <section class="team-section">
            <div class="team-section-bg"></div>

            <div class="t-container">
                <!-- Header -->
                <div class="section-header reveal">
                    <div class="section-line"></div>
                    <div class="section-badge">Meet The Team</div>
                    <h2 class="section-title">
                        Orang-Orang di Balik <span class="grad">PILIH.in</span>
                    </h2>
                    <p class="section-sub">Mahasiswa penuh tekad yang membangun platform ini dari nol dengan cinta
                        terhadap teknologi dan pendidikan.</p>
                </div>

                <!-- Cards -->
                <div class="team-grid">

                    <!-- ── Naufal Ghani Bekti ── -->
                    <div class="reveal team-card card-pm" style="transition-delay:80ms">
                        <div class="photo-wrap">
                            <div style="position:relative;">
                                <label for="photo_naufal" style="cursor:pointer;display:block;">
                                    <div class="photo-placeholder pm" id="placeholder_naufal">
                                        <svg class="ph-icon" viewBox="0 0 24 24" fill="none" stroke="#d97706"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span class="ph-text pm">Upload Foto</span>
                                        <div class="upload-overlay">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                            <span>Ganti Foto</span>
                                        </div>
                                    </div>
                                </label>
                                <input type="file" id="photo_naufal" accept="image/*" style="display:none;"
                                    onchange="previewPhoto(this,'placeholder_naufal','#d97706')">
                                <span class="role-badge badge-pm">Project Manager</span>
                            </div>
                        </div>

                        <h3 class="member-name">Naufal Ghani Bekti</h3>
                        <p class="member-nim">NIM: 24082010162</p>

                        <div class="card-divider divider-pm"></div>

                        <p class="job-label label-pm">Tanggung Jawab</p>
                        <ul class="job-list">
                            <li>Merancang arsitektur sistem dan alur kerja proyek secara menyeluruh</li>
                            <li>Koordinasi antar anggota tim dan manajemen jadwal pengerjaan</li>
                            <li>Mendesain konsep fitur dan user experience aplikasi</li>
                            <li>Mengembangkan algoritma rekomendasi minat bakat berbasis kategori</li>
                            <li>Quality assurance dan integrasi semua modul aplikasi</li>
                        </ul>

                        <div class="skill-tags">
                            <span class="skill-tag tag-pm">PHP</span>
                            <span class="skill-tag tag-pm">MySQL</span>
                            <span class="skill-tag tag-pm">UI/UX</span>
                            <span class="skill-tag tag-pm">Agile</span>
                            <span class="skill-tag tag-pm">Git</span>
                        </div>
                    </div>

                    <!-- ── Faiz Ihda Husni Husodo ── -->
                    <div class="reveal team-card card-be" style="transition-delay:180ms">
                        <div class="photo-wrap">
                            <div style="position:relative;">
                                <label for="photo_faiz" style="cursor:pointer;display:block;">
                                    <div class="photo-placeholder be" id="placeholder_faiz">
                                        <svg class="ph-icon" viewBox="0 0 24 24" fill="none" stroke="#3b82f6"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span class="ph-text be">Upload Foto</span>
                                        <div class="upload-overlay">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                            <span>Ganti Foto</span>
                                        </div>
                                    </div>
                                </label>
                                <input type="file" id="photo_faiz" accept="image/*" style="display:none;"
                                    onchange="previewPhoto(this,'placeholder_faiz','#3b82f6')">
                                <span class="role-badge badge-be">BackEnd Developer</span>
                            </div>
                        </div>

                        <h3 class="member-name">Faiz Ihda Husni Husodo</h3>
                        <p class="member-nim">NIM: 24082010138</p>

                        <div class="card-divider divider-be"></div>

                        <p class="job-label label-be">Tanggung Jawab</p>
                        <ul class="job-list">
                            <li>Merancang dan membangun database relasional dengan MySQL</li>
                            <li>Mengimplementasikan autentikasi pengguna dengan enkripsi bcrypt</li>
                            <li>Membangun logika pemrosesan dan penilaian hasil tes minat bakat</li>
                            <li>Mengelola session management dan keamanan data pengguna</li>
                            <li>Integrasi data dinamis dari DIKTI ke dalam sistem rekomendasi</li>
                        </ul>

                        <div class="skill-tags">
                            <span class="skill-tag tag-be">PHP</span>
                            <span class="skill-tag tag-be">MySQL</span>
                            <span class="skill-tag tag-be">SQL Query</span>
                            <span class="skill-tag tag-be">XAMPP</span>
                            <span class="skill-tag tag-be">API</span>
                        </div>
                    </div>

                    <!-- ── Nicholas Napitupulu ── -->
                    <div class="reveal team-card card-fe" style="transition-delay:280ms">
                        <div class="photo-wrap">
                            <div style="position:relative;">
                                <label for="photo_nicholas" style="cursor:pointer;display:block;">
                                    <div class="photo-placeholder fe" id="placeholder_nicholas">
                                        <svg class="ph-icon" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span class="ph-text fe">Upload Foto</span>
                                        <div class="upload-overlay">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                            <span>Ganti Foto</span>
                                        </div>
                                    </div>
                                </label>
                                <input type="file" id="photo_nicholas" accept="image/*" style="display:none;"
                                    onchange="previewPhoto(this,'placeholder_nicholas','#8b5cf6')">
                                <span class="role-badge badge-fe">FrontEnd Developer</span>
                            </div>
                        </div>

                        <h3 class="member-name">Nicholas Napitupulu</h3>
                        <p class="member-nim">NIM: 24082010158</p>

                        <div class="card-divider divider-fe"></div>

                        <p class="job-label label-fe">Tanggung Jawab</p>
                        <ul class="job-list">
                            <li>Membangun tampilan antarmuka yang responsif dan interaktif</li>
                            <li>Implementasi desain UI/UX dengan Tailwind CSS &amp; CSS custom</li>
                            <li>Membuat animasi, transisi, dan micro-interaction yang halus</li>
                            <li>Optimasi performa halaman dan pengalaman pengguna mobile</li>
                            <li>Memastikan konsistensi visual di seluruh halaman aplikasi</li>
                        </ul>

                        <div class="skill-tags">
                            <span class="skill-tag tag-fe">HTML</span>
                            <span class="skill-tag tag-fe">CSS</span>
                            <span class="skill-tag tag-fe">JavaScript</span>
                            <span class="skill-tag tag-fe">Tailwind</span>
                            <span class="skill-tag tag-fe">Figma</span>
                        </div>
                    </div>

                </div><!-- /team-grid -->

                <p class="reveal photo-hint" style="transition-delay:350ms">
                    💡 Klik foto profil di atas untuk mengunggah foto pribadi masing-masing anggota
                </p>
            </div>
        </section>

        <!-- ════════════════════════════════════════════ -->
        <!--  VISI & MISI                                 -->
        <!-- ════════════════════════════════════════════ -->
        <section class="vm-section">
            <div class="vm-bg">
                <div class="vb1"></div>
                <div class="vb2"></div>
                <div class="grid-pattern"></div>
            </div>

            <div class="t-container" style="position:relative;z-index:1;">
                <!-- Header -->
                <div class="reveal section-header" style="margin-bottom:3rem;">
                    <div class="vm-badge">Tentang PILIH.in</div>
                    <h2 class="vm-title">
                        Visi &amp; Misi <span class="grad">PILIH.in</span>
                    </h2>
                    <p class="vm-sub">Pondasi filosofis yang menggerakkan setiap baris kode yang kami tulis.</p>
                </div>

                <!-- VISI -->
                <div class="reveal vm-card" style="transition-delay:80ms;">
                    <div class="vm-card-inner">
                        <div class="vm-icon icon-visi">
                            <svg viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="vm-content">
                            <div class="vm-label-row">
                                <span class="vm-label visi">Visi</span>
                                <div class="vm-label-line"></div>
                            </div>
                            <h3 class="vm-heading">Menjadi Platform Navigasi Pendidikan Nomor Satu di Indonesia</h3>
                            <p class="vm-desc">
                                PILIH.in bercita-cita menjadi ekosistem rekomendasi pendidikan tinggi terpercaya yang
                                menjangkau seluruh pelosok Indonesia — memastikan setiap siswa, tanpa memandang latar
                                belakang, dapat mengakses panduan karir berbasis data yang cerdas, personal, dan akurat
                                untuk memaksimalkan potensi mereka.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- MISI -->
                <div class="reveal vm-card" style="transition-delay:160ms;">
                    <div class="vm-card-inner">
                        <div class="vm-icon icon-misi">
                            <svg viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                        </div>
                        <div class="vm-content">
                            <div class="vm-label-row">
                                <span class="vm-label misi">Misi</span>
                                <div class="vm-label-line" style="background:rgba(129,140,248,0.2);"></div>
                            </div>
                            <h3 class="vm-heading">Langkah Nyata Menuju Cita-Cita</h3>

                            <div class="misi-grid">
                                <?php
                                $missions = [
                                    ['icon' => '🎯', 'title' => 'Rekomendasi Berbasis Data', 'desc' => 'Menghadirkan rekomendasi jurusan yang presisi menggunakan algoritma berbasis data DIKTI dan psikologi minat bakat.'],
                                    ['icon' => '🌍', 'title' => 'Akses Gratis & Merata', 'desc' => 'Menyediakan layanan 100% gratis sehingga setiap siswa dari daerah manapun bisa merencanakan masa depannya.'],
                                    ['icon' => '🗺️', 'title' => 'Roadmap Karir Lengkap', 'desc' => 'Membantu mahasiswa memahami perjalanan akademis semester demi semester hingga siap memasuki dunia kerja.'],
                                    ['icon' => '🏛️', 'title' => 'Eksplorasi Kampus Terbaik', 'desc' => 'Menyajikan informasi kampus terlengkap dan terpercaya agar siswa bisa memilih universitas dengan penuh keyakinan.'],
                                    ['icon' => '🔒', 'title' => 'Privasi & Keamanan Data', 'desc' => 'Menjaga kepercayaan pengguna dengan standar keamanan data tinggi dan tidak pernah menjual data pribadi.'],
                                    ['icon' => '📈', 'title' => 'Inovasi Berkelanjutan', 'desc' => 'Terus berinovasi dengan menambah fitur, jurusan, dan kampus baru seiring berkembangnya kebutuhan pendidikan.'],
                                ];
                                foreach ($missions as $m): ?>
                                    <div class="misi-item">
                                        <span class="misi-emoji"><?= $m['icon'] ?></span>
                                        <div>
                                            <p class="misi-text-title"><?= $m['title'] ?></p>
                                            <p class="misi-text-desc"><?= $m['desc'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ════════════════════════════════════════════ -->
        <!--  CTA                                         -->
        <!-- ════════════════════════════════════════════ -->
        <section class="cta-section">
            <div class="t-container" style="position:relative;z-index:1;">
                <h2 class="reveal cta-title">Siap Mulai Perjalananmu?</h2>
                <p class="reveal cta-sub" style="transition-delay:100ms;">
                    Bergabunglah dengan ribuan siswa yang sudah menemukan jalur akademik terbaik mereka bersama
                    PILIH.in.
                </p>
                <div class="reveal cta-btns" style="transition-delay:200ms;">
                    <a href="tes.php" class="cta-btn-white">🚀 Mulai Tes Gratis</a>
                    <a href="kampus.php" class="cta-btn-outline">🏛️ Eksplorasi Kampus</a>
                </div>
            </div>
        </section>

    </main>

    <?php include 'components/footer.php'; ?>

    <script>
        // ── Scroll Reveal ──────────────────────────
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    revealObserver.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        // ── Photo Preview ──────────────────────────
        function previewPhoto(input, placeholderId, borderColor) {
            const placeholder = document.getElementById(placeholderId);
            const file = input.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                placeholder.innerHTML = `
                    <img class="preview-img photo-revealed" src="${e.target.result}" alt="Foto Profil">
                    <div class="upload-overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                        </svg>
                        <span>Ganti Foto</span>
                    </div>
                `;
                placeholder.style.border = `3px solid ${borderColor}`;
                placeholder.style.boxShadow = `0 0 0 5px ${borderColor}25`;
                placeholder.style.background = 'transparent';
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>

</html>