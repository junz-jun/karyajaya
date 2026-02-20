<?php include 'header.php'; ?>

<header class="flex items-center justify-between border-b border-[#29382e] bg-background-dark/95 backdrop-blur px-8 py-4 z-10">
    <h2 class="text-white text-xl font-bold tracking-tight">Manajemen Penyakit</h2>
    <button class="bg-primary text-black font-bold text-sm px-4 py-2 rounded-lg hover:bg-green-400 transition-all">+ Tambah Penyakit</button>
</header>

<div class="flex-1 overflow-y-auto p-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface-dark rounded-xl border border-[#29382e] overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#233329] text-[#9db8a6] text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">Nama Penyakit</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#29382e] text-sm text-white">
                    <?php
                    $diseases = $conn->query("SELECT * FROM diseases ORDER BY name ASC");
                    while ($d = $diseases->fetch_assoc()):
                    ?>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-bold text-primary"><?php echo $d['name']; ?></td>
                        <td class="px-6 py-4"><p class="line-clamp-2 text-slate-400"><?php echo htmlspecialchars($d['description']); ?></p></td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="text-blue-400 hover:text-blue-300"><span class="material-symbols-outlined text-lg">edit</span></button>
                                <button class="text-red-400 hover:text-red-300"><span class="material-symbols-outlined text-lg">delete</span></button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
