<?php include 'header.php'; ?>

<header class="flex items-center justify-between border-b border-[#29382e] bg-background-dark/95 backdrop-blur px-8 py-4 z-10">
    <h2 class="text-white text-xl font-bold tracking-tight">Dashboard Overview</h2>
</header>

<div class="flex-1 overflow-y-auto p-8 scroll-smooth">
    <div class="max-w-7xl mx-auto flex flex-col gap-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <?php
            $countDiseases = $conn->query("SELECT COUNT(*) as total FROM diseases")->fetch_assoc()['total'];
            $countSymptoms = $conn->query("SELECT COUNT(*) as total FROM symptoms")->fetch_assoc()['total'];
            $countRules = $conn->query("SELECT COUNT(*) as total FROM rules")->fetch_assoc()['total'];
            $countHistory = $conn->query("SELECT COUNT(*) as total FROM history")->fetch_assoc()['total'];
            ?>
            <div class="flex flex-col p-6 rounded-xl bg-surface-dark border border-[#29382e]">
                <p class="text-[#9db8a6] text-sm font-medium mb-1">Penyakit</p>
                <h3 class="text-3xl font-bold text-white"><?php echo $countDiseases; ?></h3>
            </div>
            <div class="flex flex-col p-6 rounded-xl bg-surface-dark border border-[#29382e]">
                <p class="text-[#9db8a6] text-sm font-medium mb-1">Gejala</p>
                <h3 class="text-3xl font-bold text-white"><?php echo $countSymptoms; ?></h3>
            </div>
            <div class="flex flex-col p-6 rounded-xl bg-surface-dark border border-[#29382e]">
                <p class="text-[#9db8a6] text-sm font-medium mb-1">Basis Pengetahuan</p>
                <h3 class="text-3xl font-bold text-white"><?php echo $countRules; ?></h3>
            </div>
            <div class="flex flex-col p-6 rounded-xl bg-surface-dark border border-[#29382e]">
                <p class="text-[#9db8a6] text-sm font-medium mb-1">Total Diagnosa</p>
                <h3 class="text-3xl font-bold text-white"><?php echo $countHistory; ?></h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-surface-dark rounded-xl border border-[#29382e] p-6">
                <h3 class="text-white font-bold mb-4">Riwayat Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-slate-500 uppercase text-xs font-bold border-b border-border-dark">
                            <tr>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">User</th>
                                <th class="py-3">Hasil</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-dark">
                            <?php
                            $recentHistory = $conn->query("SELECT * FROM history ORDER BY created_at DESC LIMIT 5");
                            while ($h = $recentHistory->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="py-3"><?php echo date('d/m/y', strtotime($h['created_at'])); ?></td>
                                <td class="py-3"><?php echo htmlspecialchars($h['user_name']); ?></td>
                                <td class="py-3 text-primary"><?php echo $h['disease_name']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-surface-dark rounded-xl border border-[#29382e] p-6">
                <h3 class="text-white font-bold mb-4">Statistik Penyakit</h3>
                <div class="space-y-4">
                    <?php
                    $stats = $conn->query("SELECT disease_name, COUNT(*) as count FROM history GROUP BY disease_name ORDER BY count DESC LIMIT 4");
                    while ($s = $stats->fetch_assoc()):
                        $percentage = ($countHistory > 0) ? ($s['count'] / $countHistory) * 100 : 0;
                    ?>
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-slate-300"><?php echo $s['disease_name']; ?></span>
                            <span class="text-primary"><?php echo $s['count']; ?> kali</span>
                        </div>
                        <div class="w-full bg-border-dark rounded-full h-1.5">
                            <div class="bg-primary h-1.5 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
