<?php
include 'includes/functions.php';
$diseases = getDiseases($conn);
include 'includes/header.php';
?>

<div class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">
    <?php include 'includes/navbar.php'; ?>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-10 py-8">
        <div class="flex flex-col gap-6 mb-10">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-slate-900 dark:text-white">Daftar Penyakit & Hama</h1>
            <p class="text-base md:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">Database lengkap penyakit dan hama tanaman kakao Indonesia.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($diseases as $d): ?>
            <div class="group relative flex flex-col bg-white dark:bg-surface-dark rounded-xl overflow-hidden border border-gray-200 dark:border-white/5 hover:border-primary/50 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-primary/10">
                <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100 dark:bg-gray-800 relative flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/30">eco</span>
                    <?php if ($d['image']): ?>
                        <img src="assets/img/<?php echo $d['image']; ?>" alt="<?php echo $d['name']; ?>" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                    <?php endif; ?>
                </div>
                <div class="flex flex-col flex-1 p-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 line-clamp-1 group-hover:text-primary transition-colors"><?php echo $d['name']; ?></h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 line-clamp-3 leading-relaxed flex-1">
                        <?php echo $d['description']; ?>
                    </p>
                    <div class="pt-4 border-t border-border-dark mt-auto">
                        <button onclick='showDiseaseDetail(<?php echo htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8'); ?>)' class="text-primary text-sm font-bold flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Lihat Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<!-- Disease Detail Modal -->
<div id="diseaseModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-sm" onclick="closeDiseaseModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="bg-surface-dark border border-border-dark rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl pointer-events-auto flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-border-dark bg-surface-dark sticky top-0">
                <h3 id="modalDiseaseName" class="text-2xl font-bold text-white">Detail Penyakit</h3>
                <button onclick="closeDiseaseModal()" class="text-slate-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 overflow-y-auto space-y-6">
                <div id="modalDiseaseImageContainer" class="w-full aspect-video rounded-xl overflow-hidden bg-gray-800 hidden">
                    <img id="modalDiseaseImage" src="" alt="" class="w-full h-full object-cover">
                </div>

                <div class="space-y-2">
                    <h4 class="text-primary font-bold text-sm uppercase tracking-wider">Deskripsi</h4>
                    <p id="modalDiseaseDescription" class="text-slate-300 leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3 p-4 rounded-xl bg-primary/5 border border-primary/10">
                        <div class="flex items-center gap-2 text-primary">
                            <span class="material-symbols-outlined">lightbulb</span>
                            <h4 class="font-bold">Solusi Pengobatan</h4>
                        </div>
                        <p id="modalDiseaseSolution" class="text-slate-300 text-sm leading-relaxed whitespace-pre-line"></p>
                    </div>
                    <div class="space-y-3 p-4 rounded-xl bg-blue-500/5 border border-blue-500/10">
                        <div class="flex items-center gap-2 text-blue-400">
                            <span class="material-symbols-outlined">verified_user</span>
                            <h4 class="font-bold">Langkah Pencegahan</h4>
                        </div>
                        <p id="modalDiseasePrevention" class="text-slate-300 text-sm leading-relaxed whitespace-pre-line"></p>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-border-dark flex justify-end">
                <button onclick="closeDiseaseModal()" class="px-6 py-2 rounded-lg bg-primary text-[#111813] font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showDiseaseDetail(data) {
    document.getElementById('modalDiseaseName').textContent = data.name;
    document.getElementById('modalDiseaseDescription').textContent = data.description;
    document.getElementById('modalDiseaseSolution').textContent = data.solution || 'Informasi solusi tidak tersedia.';
    document.getElementById('modalDiseasePrevention').textContent = data.prevention || 'Informasi pencegahan tidak tersedia.';

    const imgContainer = document.getElementById('modalDiseaseImageContainer');
    const img = document.getElementById('modalDiseaseImage');

    if (data.image) {
        img.src = 'assets/img/' + data.image;
        img.alt = data.name;
        imgContainer.classList.remove('hidden');
    } else {
        imgContainer.classList.add('hidden');
    }

    document.getElementById('diseaseModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDiseaseModal() {
    document.getElementById('diseaseModal').classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDiseaseModal();
});
</script>

<?php include 'includes/footer.php'; ?>
