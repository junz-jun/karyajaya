<?php
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['symptoms'])) {
    header('Location: diagnosis.php');
    exit;
}

$userName = $_POST['user_name'] ?? 'Petani Anonim';
$selectedSymptomIds = $_POST['symptoms'];
$cfUserValues = $_POST['cf_user'];

$selectedSymptoms = [];
foreach ($selectedSymptomIds as $id) {
    $selectedSymptoms[$id] = floatval($cfUserValues[$id]);
}

$results = calculateDiagnosis($conn, $selectedSymptoms);
$topResult = !empty($results) ? reset($results) : null;

if ($topResult) {
    saveHistory($conn, $userName, $topResult['name'], $topResult['cf'] * 100, json_encode($selectedSymptoms));
}

include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark min-h-screen font-display flex flex-col text-slate-900 dark:text-slate-100 overflow-x-hidden">
    <nav class="sticky top-0 z-50 border-b border-[#29382e] bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm px-4 md:px-10 py-3">
        <div class="max-w-[1280px] mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="size-8 text-primary">
                    <span class="material-symbols-outlined text-3xl">local_florist</span>
                </div>
                <h2 class="text-slate-900 dark:text-white text-lg font-bold tracking-tight">Hasil Diagnosa</h2>
            </div>
             <div class="hidden md:flex items-center gap-8">
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="index.php">Beranda</a>
                <a class="text-primary font-bold text-sm leading-normal border-b-2 border-primary" href="diagnosis.php">Diagnosa Ulang</a>
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="history.php">Riwayat</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow w-full max-w-[1280px] mx-auto p-4 md:p-8 lg:p-12">
        <?php if ($topResult): ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 flex flex-col gap-6">
                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] overflow-hidden shadow-lg">
                    <div class="p-6 md:p-8 relative">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                            <div>
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                                    <span class="material-symbols-outlined text-sm">verified</span>
                                    Hasil Teridentifikasi
                                </div>
                                <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white leading-tight tracking-tight">
                                    <?php echo $topResult['name']; ?>
                                </h1>
                                <p class="text-slate-500 dark:text-slate-400 mt-2 text-lg">
                                    Halo, <strong><?php echo htmlspecialchars($userName); ?></strong>. Berdasarkan gejala yang dipilih, sistem mendeteksi penyakit ini dengan tingkat keyakinan berikut:
                                </p>
                            </div>
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div class="relative size-32 flex items-center justify-center">
                                    <svg class="size-full -rotate-90 transform" viewBox="0 0 36 36">
                                        <path class="text-[#29382e]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"></path>
                                        <path class="text-primary drop-shadow-[0_0_10px_rgba(23,207,84,0.4)]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="<?php echo $topResult['cf'] * 100; ?>, 100" stroke-linecap="round" stroke-width="3"></path>
                                    </svg>
                                    <div class="absolute flex flex-col items-center">
                                        <span class="text-3xl font-bold text-slate-900 dark:text-white"><?php echo number_format($topResult['cf'] * 100, 1); ?><span class="text-lg">%</span></span>
                                        <span class="text-[10px] uppercase font-bold text-slate-500 dark:text-slate-400 tracking-wider">Akurat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prose prose-invert max-w-none">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">description</span>
                                Deskripsi Penyakit
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm md:text-base">
                                <?php echo nl2br($topResult['description']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] p-6 md:p-8">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">medical_services</span>
                        Solusi Penanganan
                    </h3>
                    <div class="space-y-6">
                        <div class="text-slate-600 dark:text-slate-300 text-base leading-relaxed whitespace-pre-line">
                            <?php echo $topResult['solution']; ?>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] p-6 md:p-8">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">verified_user</span>
                        Tips Pencegahan
                    </h3>
                    <div class="space-y-6">
                        <div class="text-slate-600 dark:text-slate-300 text-base leading-relaxed whitespace-pre-line">
                            <?php echo $topResult['prevention']; ?>
                        </div>
                    </div>
                </div>

                <?php if (count($results) > 1): ?>
                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] p-6 md:p-8">
                    <h3 class="text-lg font-bold text-white mb-4">Kemungkinan Lain</h3>
                    <div class="space-y-4">
                        <?php
                        $others = array_slice($results, 1);
                        foreach ($others as $other):
                        ?>
                        <div class="flex justify-between items-center p-4 rounded-lg bg-background-dark/50 border border-border-dark">
                            <span class="text-white font-medium"><?php echo $other['name']; ?></span>
                            <span class="text-primary font-bold"><?php echo number_format($other['cf'] * 100, 1); ?>%</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="lg:col-span-4 flex flex-col gap-6">
                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] p-6 sticky top-24">
                    <h3 class="text-sm uppercase font-bold text-slate-500 dark:text-slate-400 tracking-wider mb-4">Tindakan</h3>
                    <div class="flex flex-col gap-3">
                        <a href="diagnosis.php" class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-[#14b047] text-slate-900 font-bold py-3 px-4 rounded-lg transition-all shadow-[0_0_15px_rgba(23,207,84,0.2)]">
                            <span class="material-symbols-outlined">restart_alt</span>
                            Diagnosa Ulang
                        </a>
                        <a href="catalog.php" class="w-full flex items-center justify-center gap-2 bg-transparent hover:bg-slate-100 dark:hover:bg-[#29382e] text-slate-600 dark:text-slate-400 font-medium py-3 px-4 rounded-lg transition-colors border border-border-dark">
                            <span class="material-symbols-outlined">menu_book</span>
                            Lihat Katalog
                        </a>
                        <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 bg-surface-highlight text-white font-medium py-3 px-4 rounded-lg hover:bg-opacity-80 transition-all border border-border-dark">
                            <span class="material-symbols-outlined">print</span>
                            Cetak Hasil
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <span class="material-symbols-outlined text-6xl text-slate-500 mb-4">sentiment_dissatisfied</span>
            <h2 class="text-2xl font-bold text-white mb-2">Maaf, Tidak Ada Hasil</h2>
            <p class="text-slate-400 mb-8">Sistem tidak menemukan penyakit yang cocok dengan gejala yang Anda pilih.</p>
            <a href="diagnosis.php" class="bg-primary text-black font-bold py-3 px-8 rounded-lg">Coba Lagi</a>
        </div>
        <?php endif; ?>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
