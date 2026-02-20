<?php
include 'includes/functions.php';
$symptomsByCategory = getSymptomsByCategory($conn);
include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased min-h-screen flex">
    <aside class="w-64 bg-[#111813] border-r border-border-dark flex-shrink-0 flex flex-col justify-between h-full hidden md:flex sticky top-0">
        <div class="flex flex-col p-4 gap-6">
            <div class="flex items-center gap-3 px-2">
                <div class="bg-primary/20 p-2 rounded-lg text-primary">
                    <span class="material-symbols-outlined">eco</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-white text-lg font-bold leading-none">Karya Jaya</h1>
                    <p class="text-slate-400 text-xs font-normal mt-1">Sistem Pakar Kakao</p>
                </div>
            </div>
            <nav class="flex flex-col gap-1">
                <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">home</span>
                    <span class="text-sm font-medium">Beranda</span>
                </a>
                <a href="diagnosis.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors">
                    <span class="material-symbols-outlined fill-1">stethoscope</span>
                    <span class="text-sm font-medium">Diagnosa</span>
                </a>
                <a href="history.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">history</span>
                    <span class="text-sm font-medium">Riwayat</span>
                </a>
                <a href="catalog.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">pest_control</span>
                    <span class="text-sm font-medium">Penyakit</span>
                </a>
                <a href="about.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">info</span>
                    <span class="text-sm font-medium">Tentang</span>
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen relative">
        <header class="h-16 border-b border-border-dark flex items-center justify-between px-6 bg-[#111813] z-10 sticky top-0">
            <div class="flex items-center gap-4">
                <div class="flex items-center text-sm text-slate-400">
                    <span>Aplikasi</span>
                    <span class="material-symbols-outlined text-[16px] mx-2">chevron_right</span>
                    <span class="text-white font-medium">Diagnosa Baru</span>
                </div>
            </div>
        </header>

        <div class="flex-1 bg-background-dark p-6 md:p-10">
            <div class="max-w-5xl mx-auto flex flex-col gap-8 pb-32">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-3xl font-bold text-white tracking-tight">Diagnosa Penyakit</h2>
                        <p class="text-slate-400 max-w-2xl">Pilih gejala yang terlihat pada tanaman kakao Anda. Untuk hasil yang lebih akurat, tentukan tingkat keyakinan Anda pada setiap gejala yang dipilih.</p>
                    </div>
                </div>

                <form action="results.php" method="POST" id="diagnosisForm">
                    <div class="mb-6">
                        <label class="block text-white text-sm font-bold mb-2">Nama Petani / User</label>
                        <input type="text" name="user_name" required class="w-full bg-[#0d1610] border border-border-dark text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-3 placeholder-slate-500" placeholder="Masukkan nama Anda...">
                    </div>

                    <div class="bg-card-dark rounded-xl border border-border-dark shadow-xl overflow-hidden">
                        <div class="divide-y divide-border-dark">
                            <?php foreach ($symptomsByCategory as $category => $symptoms): ?>
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-6">
                                    <span class="p-2 rounded-lg bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined"><?php
                                            echo ($category == 'Daun') ? 'eco' : (($category == 'Buah') ? 'nutrition' : 'forest');
                                        ?></span>
                                    </span>
                                    <h3 class="text-lg font-semibold text-white">Gejala pada <?php echo $category; ?></h3>
                                </div>
                                <div class="space-y-4">
                                    <?php foreach ($symptoms as $s): ?>
                                    <div class="group flex flex-col md:flex-row md:items-center justify-between gap-4 p-4 rounded-lg hover:bg-white/5 border border-transparent hover:border-border-dark transition-all">
                                        <label class="flex items-start gap-4 cursor-pointer flex-1">
                                            <input type="checkbox" name="symptoms[]" value="<?php echo $s['id']; ?>" class="mt-1 w-5 h-5 text-primary bg-slate-800 border-slate-600 rounded focus:ring-primary focus:ring-offset-gray-900">
                                            <div class="flex flex-col">
                                                <span class="text-white font-medium text-base"><?php echo $s['name']; ?></span>
                                                <span class="text-slate-500 text-sm"><?php echo $s['code']; ?></span>
                                            </div>
                                        </label>
                                        <div class="w-full md:w-48">
                                            <select name="cf_user[<?php echo $s['id']; ?>]" class="w-full bg-[#112116] border border-border-dark text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                                                <option value="1.0">Sangat Yakin (1.0)</option>
                                                <option value="0.8">Yakin (0.8)</option>
                                                <option value="0.6">Cukup Yakin (0.6)</option>
                                                <option value="0.4">Sedikit Yakin (0.4)</option>
                                                <option value="0.2">Tidak Tahu (0.2)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="fixed bottom-0 left-0 md:left-64 right-0 bg-[#111813]/90 backdrop-blur-md border-t border-border-dark p-4 md:px-10 z-20">
                        <div class="max-w-5xl mx-auto flex justify-between items-center">
                            <button type="reset" class="px-5 py-2.5 text-sm font-medium text-slate-300 hover:text-white transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined">restart_alt</span>
                                Reset Form
                            </button>
                            <button type="submit" class="text-black bg-primary hover:bg-green-400 font-bold rounded-lg text-sm px-6 py-3 transition-all shadow-[0_0_15px_rgba(23,207,84,0.4)] flex items-center gap-2">
                                <span class="material-symbols-outlined">analytics</span>
                                Analisa Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
