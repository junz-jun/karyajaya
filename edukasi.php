<?php include 'includes/header.php'; ?>

<?php
$education_topics = [
    [
        'title' => 'PHT (Pengendalian Hama Terpadu)',
        'short_desc' => 'Konsep pengendalian yang menggabungkan berbagai teknik secara kompatibel untuk menjaga populasi hama di bawah ambang ekonomi.',
        'full_content' => 'Konsep pengendalian yang menggabungkan berbagai teknik secara kompatibel untuk menjaga populasi hama di bawah ambang ekonomi. Strategi ini meliputi penggunaan varietas tahan, cara bercocok tanam yang tepat, pemanfaatan musuh alami, dan penggunaan pestisida sebagai langkah terakhir berdasarkan ambang ekonomi. Tujuannya adalah untuk meminimalkan dampak negatif terhadap lingkungan sambil tetap menjaga produktivitas tanaman kakao.'
    ],
    [
        'title' => 'Pemupukan Organik',
        'short_desc' => 'Cara membuat kompos dari kulit buah kakao untuk mengembalikan unsur hara ke tanah secara alami dan berkelanjutan.',
        'full_content' => 'Pemanfaatan limbah kulit buah kakao sebagai pupuk organik sangat efektif untuk meningkatkan kesuburan tanah. Prosesnya melibatkan pencacahan kulit buah, penambahan dekomposer (seperti EM4), dan fermentasi selama beberapa minggu. Hasilnya adalah kompos kaya hara yang dapat memperbaiki struktur tanah, meningkatkan kapasitas menahan air, dan menyediakan nutrisi esensial bagi tanaman kakao tanpa ketergantungan pada pupuk kimia.'
    ],
    [
        'title' => 'Pasca Panen',
        'short_desc' => 'Teknik fermentasi biji kakao yang benar untuk menghasilkan kualitas ekspor dan harga jual yang lebih tinggi.',
        'full_content' => 'Kualitas biji kakao ditentukan pada tahap pasca panen. Proses fermentasi yang benar dilakukan selama 5-6 hari dalam kotak kayu berlubang dengan pembalikan setiap 2 hari. Fermentasi yang sempurna menghasilkan aroma dan rasa cokelat yang khas. Setelah itu, biji harus dikeringkan hingga kadar air mencapai 7% menggunakan sinar matahari atau alat pengering untuk mencegah pertumbuhan jamur selama penyimpanan.'
    ]
];
?>

<div class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased min-h-screen flex flex-col">
    <?php include 'includes/navbar.php'; ?>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
         <section class="w-full bg-surface-light dark:bg-surface-dark rounded-xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-800">
            <div class="flex flex-col lg:flex-row gap-0 lg:gap-8">
                <div class="w-full lg:w-3/5 h-64 lg:h-auto relative bg-gray-200">
                    <img alt="Farmer pruning" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkuQrmWMmFklh71gN05Di_G4KrKX7Z8_7ZZPKxBcSfv91Or7l6GkkkYvD3MgiAbuv6NylTSIXJXr30tDNGWFDwwxCSSv-tROgS3EkEBHxjX8KYIovg_oGjBC_vlFGMN1w5BdkcWsVvMLOUTewO7dAiCN4DNYQvBLU6KA6WoD16X_BwkyqYEWZHoJVKqMBBQF3es9tepeBsIboRORBvatRBzb3dAuVnHwzFPxeTMEQXzch2GDoToagU3dV53W9-R7Ww46LFLX4vhDc"/>
                </div>
                <div class="flex flex-col justify-center p-6 lg:p-10 lg:w-2/5 gap-4">
                    <div class="flex items-center gap-2 text-xs font-semibold text-primary uppercase tracking-wider">
                        <span class="material-symbols-outlined text-sm">agriculture</span>
                        Perawatan Rutin
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white leading-tight">Pentingnya Pemangkasan Rutin</h1>
                    <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">Pelajari teknik pemangkasan yang tepat untuk menjaga kesehatan pohon dan memaksimalkan hasil panen Anda.</p>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($education_topics as $topic): ?>
            <div class="bg-surface-dark rounded-xl p-6 border border-border-dark flex flex-col">
                <h3 class="text-xl font-bold text-white mb-4"><?php echo $topic['title']; ?></h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4 flex-1"><?php echo $topic['short_desc']; ?></p>
                <button onclick='showEducationDetail(<?php echo htmlspecialchars(json_encode($topic), ENT_QUOTES, 'UTF-8'); ?>)' class="text-primary font-medium text-sm text-left hover:underline">Baca Selengkapnya &rarr;</button>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<!-- Education Detail Modal -->
<div id="educationModal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-background-dark/80 backdrop-blur-sm" onclick="closeEducationModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="bg-surface-dark border border-border-dark rounded-2xl w-full max-w-xl overflow-hidden shadow-2xl pointer-events-auto flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-border-dark bg-surface-dark">
                <h3 id="modalEducationTitle" class="text-xl font-bold text-white">Judul Edukasi</h3>
                <button onclick="closeEducationModal()" class="text-slate-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-8 overflow-y-auto">
                <p id="modalEducationContent" class="text-slate-300 text-base leading-relaxed"></p>
            </div>
            <div class="p-6 border-t border-border-dark flex justify-end">
                <button onclick="closeEducationModal()" class="px-6 py-2 rounded-lg bg-primary text-[#111813] font-bold hover:bg-primary/90 transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showEducationDetail(data) {
    document.getElementById('modalEducationTitle').textContent = data.title;
    document.getElementById('modalEducationContent').textContent = data.full_content;
    document.getElementById('educationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeEducationModal() {
    document.getElementById('educationModal').classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeEducationModal();
});
</script>

<?php include 'includes/footer.php'; ?>
