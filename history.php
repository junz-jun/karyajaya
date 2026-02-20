<?php
include 'includes/functions.php';
$history = getHistory($conn, 20);
include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark font-display antialiased min-h-screen flex flex-col">
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 lg:px-10 py-3 shadow-sm">
        <div class="flex items-center gap-4 text-slate-900 dark:text-white">
             <div class="size-8 text-primary flex items-center justify-center bg-primary/10 rounded-lg p-1">
                <span class="material-symbols-outlined text-2xl">spa</span>
            </div>
            <h2 class="text-slate-900 dark:text-white text-lg font-bold leading-tight">Sistem Pakar Kakao</h2>
        </div>
        <nav class="hidden md:flex items-center gap-9">
            <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="index.php">Beranda</a>
            <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="diagnosis.php">Diagnosa</a>
            <a class="text-primary text-sm font-bold leading-normal" href="history.php">Riwayat</a>
        </nav>
    </header>
    <main class="flex-1 w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col gap-6 mb-8">
             <div class="flex flex-wrap justify-between items-end gap-4">
                <div class="flex flex-col gap-2 max-w-2xl">
                    <h1 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black leading-tight">Riwayat Diagnosa</h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base md:text-lg">Daftar lengkap hasil diagnosa penyakit tanaman kakao Anda.</p>
                </div>
                <a href="diagnosis.php" class="flex items-center gap-2 bg-primary hover:bg-green-600 text-white px-5 py-3 rounded-lg font-bold shadow-lg shadow-green-500/20 transition-all transform hover:scale-[1.02]">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span>Diagnosa Baru</span>
                </a>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold">
                            <th class="p-4 w-16 text-center">No</th>
                            <th class="p-4 min-w-[120px]">Tanggal</th>
                            <th class="p-4">User</th>
                            <th class="p-4 min-w-[200px]">Penyakit Terdeteksi</th>
                            <th class="p-4 min-w-[180px]">Nilai CF (Kepastian)</th>
                            <th class="p-4 min-w-[120px]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <?php if (empty($history)): ?>
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-500">Belum ada riwayat diagnosa.</td>
                        </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($history as $h): ?>
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="p-4 text-center text-slate-500 dark:text-slate-400 font-medium"><?php echo $no++; ?></td>
                                <td class="p-4 text-slate-900 dark:text-white font-medium"><?php echo date('d M Y, H:i', strtotime($h['created_at'])); ?></td>
                                <td class="p-4 text-slate-400"><?php echo htmlspecialchars($h['user_name']); ?></td>
                                <td class="p-4"><div class="font-semibold text-slate-900 dark:text-white"><?php echo $h['disease_name']; ?></div></td>
                                <td class="p-4"><span class="font-bold text-slate-900 dark:text-white"><?php echo number_format($h['cf_percentage'], 1); ?>%</span></td>
                                <td class="p-4">
                                    <?php if ($h['cf_percentage'] >= 80): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">Tinggi</span>
                                    <?php elseif ($h['cf_percentage'] >= 50): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">Sedang</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">Rendah</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include 'includes/footer.php'; ?>
