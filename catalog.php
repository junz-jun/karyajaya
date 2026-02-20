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
                        <button class="text-primary text-sm font-bold flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Lihat Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php include 'includes/footer.php'; ?>
