<?php
include 'includes/functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: riwayat.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM riwayat WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$history = $stmt->get_result()->fetch_assoc();

if (!$history) {
    header('Location: riwayat.php');
    exit;
}

$userName = $history['nama_pengguna'];
$selectedSymptoms = json_decode($history['detail'], true);

$results = calculateDiagnosis($conn, $selectedSymptoms);
$topResult = !empty($results) ? reset($results) : null;

include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark min-h-screen font-display flex flex-col text-slate-900 dark:text-slate-100 overflow-x-hidden">
    <?php include 'includes/navbar.php'; ?>

    <main class="flex-grow w-full max-w-[1280px] mx-auto p-4 md:p-8 lg:p-12">
        <div class="mb-8">
            <a href="riwayat.php" class="inline-flex items-center gap-2 text-slate-500 hover:text-white transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Riwayat
            </a>
        </div>

        <?php if ($topResult): ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 flex flex-col gap-6">
                <div class="bg-white dark:bg-[#1a2e23] rounded-xl border border-[#29382e] overflow-hidden shadow-lg">
                    <div class="p-6 md:p-8 relative">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6">
                            <div>
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                                    <span class="material-symbols-outlined text-sm">history</span>
                                    Hasil Diagnosis Terdeteksi
                                </div>
                                <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white leading-tight tracking-tight">
                                    <?php echo $topResult['name']; ?>
                                </h1>
                                <p class="text-slate-500 dark:text-slate-400 mt-2 text-lg">
                                    Halo, <strong><?php echo htmlspecialchars($userName); ?></strong>. Berikut adalah detail diagnosis Anda pada tanggal <strong><?php echo date('d M Y, H:i', strtotime($history['dibuat_pada'])); ?></strong>.
                                </p>
                            </div>
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div class="relative size-32 flex items-center justify-center">
                                    <svg class="size-full -rotate-90 transform" viewBox="0 0 36 36">
                                        <path class="text-[#29382e]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"></path>
                                        <path class="text-primary drop-shadow-[0_0_10px_rgba(23,207_84,0.4)]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="<?php echo $topResult['cf'] * 100; ?>, 100" stroke-linecap="round" stroke-width="3"></path>
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
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Kemungkinan Lain</h3>
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
                    <h3 class="text-sm uppercase font-bold text-slate-500 dark:text-slate-400 tracking-wider mb-4">Gejala yang Dipilih</h3>
                    <div class="space-y-3">
                        <?php
                        // Fetch symptoms names for better display
                        $symptomIds = array_keys($selectedSymptoms);
                        $idStr = implode(',', array_map('intval', $symptomIds));
                        $symptomData = [];
                        if (!empty($idStr)) {
                            $res = $conn->query("SELECT id, nama, kode FROM gejala WHERE id IN ($idStr)");
                            while ($row = $res->fetch_assoc()) {
                                $symptomData[$row['id']] = $row;
                            }
                        }

                        foreach ($selectedSymptoms as $sid => $cf):
                            $sName = $symptomData[$sid]['nama'] ?? 'Gejala tidak diketahui';
                            $sCode = $symptomData[$sid]['kode'] ?? '';
                        ?>
                        <div class="p-3 rounded-lg bg-black/20 border border-border-dark">
                            <div class="text-xs text-slate-500 mb-1"><?php echo $sCode; ?></div>
                            <div class="text-sm text-white font-medium mb-2"><?php echo $sName; ?></div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">Keyakinan:</span>
                                <span class="text-primary font-bold"><?php echo $cf; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-6 pt-6 border-t border-border-dark">
                        <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 bg-primary text-slate-900 font-bold py-3 px-4 rounded-lg hover:bg-green-400 transition-all">
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
            <p class="text-slate-400 mb-8">Sistem tidak menemukan penyakit yang cocok dengan gejala yang disimpan.</p>
        </div>
        <?php endif; ?>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
