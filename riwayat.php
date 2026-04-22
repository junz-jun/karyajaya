<?php
include 'includes/functions.php';
$search = $_GET['search'] ?? '';
$history = getHistory($conn, 50, $search);
include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased min-h-screen flex">
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden md:hidden backdrop-blur-sm transition-opacity"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#111813] border-r border-border-dark flex-shrink-0 flex flex-col justify-between h-full transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
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
                <a href="diagnosa.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">stethoscope</span>
                    <span class="text-sm font-medium">Diagnosa</span>
                </a>
                <a href="riwayat.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors">
                    <span class="material-symbols-outlined fill-1">history</span>
                    <span class="text-sm font-medium">Riwayat</span>
                </a>
                <a href="katalog.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">pest_control</span>
                    <span class="text-sm font-medium">Penyakit</span>
                </a>
                <a href="tentang.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">info</span>
                    <span class="text-sm font-medium">Tentang</span>
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen relative overflow-x-hidden">
        <header class="h-16 border-b border-border-dark flex items-center justify-between px-4 md:px-6 bg-[#111813] z-30 sticky top-0">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="md:hidden text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="flex items-center text-sm text-slate-400">
                    <span class="hidden xs:inline">Aplikasi</span>
                    <span class="material-symbols-outlined text-[16px] mx-2">chevron_right</span>
                    <span class="text-white font-medium">Riwayat Diagnosa</span>
                </div>
            </div>
        </header>

        <div class="flex-1 bg-background-dark p-6 md:p-10">
            <div class="max-w-7xl mx-auto flex flex-col gap-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">Riwayat Diagnosa</h1>
                        <p class="text-slate-400 text-base">Daftar lengkap hasil diagnosa penyakit tanaman kakao Anda.</p>
                    </div>
                    <div class="flex flex-col md:flex-row gap-4">
                        <form action="" method="GET" class="relative group flex items-center">
                            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari nama atau penyakit..." class="bg-[#1a2e23] border border-border-dark text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full md:w-64 pl-10 p-3 transition-all">
                            <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">search</span>
                            </button>
                            <?php if($search): ?>
                                <a href="riwayat.php" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </a>
                            <?php endif; ?>
                        </form>
                        <a href="diagnosa.php" class="w-fit flex items-center gap-2 bg-primary hover:bg-green-600 text-[#111813] px-5 py-3 rounded-lg font-bold shadow-lg shadow-green-500/20 transition-all transform hover:scale-[1.02]">
                            <span class="material-symbols-outlined">add_circle</span>
                            <span>Diagnosa Baru</span>
                        </a>
                    </div>
                </div>

                <div class="bg-card-dark rounded-xl border border-border-dark shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-black/20 border-b border-border-dark text-xs uppercase tracking-wider text-slate-400 font-semibold">
                                    <th class="p-4 w-16 text-center">No</th>
                                    <th class="p-4 min-w-[120px]">Tanggal</th>
                                    <th class="p-4">User</th>
                                    <th class="p-4 min-w-[200px]">Penyakit Terdeteksi</th>
                                    <th class="p-4 min-w-[180px]">Nilai CF (Kepastian)</th>
                                    <th class="p-4 min-w-[120px]">Status</th>
                                    <th class="p-4 w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-dark">
                                <?php if (empty($history)): ?>
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-slate-500">Belum ada riwayat diagnosa.</td>
                                </tr>
                                <?php else: ?>
                                    <?php $no = 1; foreach ($history as $h): ?>
                                    <tr class="group hover:bg-white/5 transition-colors cursor-pointer" onclick="window.location.href='detail_riwayat.php?id=<?php echo $h['id']; ?>'">
                                        <td class="p-4 text-center text-slate-500 font-medium"><?php echo $no++; ?></td>
                                        <td class="p-4 text-white font-medium"><?php echo date('d M Y, H:i', strtotime($h['dibuat_pada'])); ?></td>
                                        <td class="p-4 text-slate-400"><?php echo htmlspecialchars($h['nama_pengguna']); ?></td>
                                        <td class="p-4"><div class="font-semibold text-white"><?php echo $h['nama_penyakit']; ?></div></td>
                                        <td class="p-4"><span class="font-bold text-white"><?php echo number_format($h['persentase_cf'], 1); ?>%</span></td>
                                        <td class="p-4">
                                            <?php if ($h['persentase_cf'] >= 80): ?>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-900/30 text-green-400 border border-green-800">Tinggi</span>
                                            <?php elseif ($h['persentase_cf'] >= 50): ?>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-900/30 text-amber-400 border border-amber-800">Sedang</span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-900/30 text-red-400 border border-red-800">Rendah</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="p-4">
                                            <a href="detail_riwayat.php?id=<?php echo $h['id']; ?>" class="text-primary hover:text-green-400 transition-colors">
                                                <span class="material-symbols-outlined">visibility</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (sidebarToggle && sidebar && overlay) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        };

        sidebarToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    }
});
</script>
<?php include 'includes/footer.php'; ?>
