<?php include 'includes/header.php'; ?>

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
            <div class="bg-surface-dark rounded-xl p-6 border border-border-dark">
                <h3 class="text-xl font-bold text-white mb-4">PHT (Pengendalian Hama Terpadu)</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">Konsep pengendalian yang menggabungkan berbagai teknik secara kompatibel untuk menjaga populasi hama di bawah ambang ekonomi.</p>
                <a href="#" class="text-primary font-medium text-sm">Baca Selengkapnya &rarr;</a>
            </div>
            <div class="bg-surface-dark rounded-xl p-6 border border-border-dark">
                <h3 class="text-xl font-bold text-white mb-4">Pemupukan Organik</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">Cara membuat kompos dari kulit buah kakao untuk mengembalikan unsur hara ke tanah secara alami dan berkelanjutan.</p>
                <a href="#" class="text-primary font-medium text-sm">Baca Selengkapnya &rarr;</a>
            </div>
            <div class="bg-surface-dark rounded-xl p-6 border border-border-dark">
                <h3 class="text-xl font-bold text-white mb-4">Pasca Panen</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">Teknik fermentasi biji kakao yang benar untuk menghasilkan kualitas ekspor dan harga jual yang lebih tinggi.</p>
                <a href="#" class="text-primary font-medium text-sm">Baca Selengkapnya &rarr;</a>
            </div>
        </div>
    </main>
</div>
<?php include 'includes/footer.php'; ?>
