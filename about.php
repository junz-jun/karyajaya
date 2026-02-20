<?php include 'includes/header.php'; ?>

<div class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display min-h-screen flex flex-col overflow-x-hidden">
     <header class="sticky top-0 z-50 w-full border-b border-gray-200 dark:border-[#29382e] bg-background-light/80 dark:bg-[#111813]/90 backdrop-blur-md">
        <div class="px-4 md:px-10 py-3 max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3 text-primary">
                <div class="size-6">
                    <span class="material-symbols-outlined text-3xl">eco</span>
                </div>
                <h2 class="text-slate-900 dark:text-white text-lg font-bold tracking-tight">Karya Jaya</h2>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="index.php">Beranda</a>
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary transition-colors text-sm font-medium" href="diagnosis.php">Diagnosa</a>
                <a class="text-primary font-bold text-sm leading-normal" href="about.php">Tentang & Kontak</a>
            </nav>
        </div>
    </header>
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 md:px-10 py-8 flex flex-col gap-16">
        <section class="relative rounded-2xl overflow-hidden min-h-[400px] flex items-center justify-center bg-surface-dark border border-border-dark">
            <div class="relative z-20 max-w-3xl text-center px-6 flex flex-col items-center gap-6">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/20 border border-primary/30 text-primary text-xs font-bold uppercase tracking-wider">Misi Kami</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight">Melindungi Emas Cokelat <span class="text-primary">Indonesia</span></h1>
                <p class="text-lg text-slate-200 font-medium max-w-2xl leading-relaxed">Karya Jaya hadir sebagai jembatan antara petani kakao dan teknologi pakar untuk mendeteksi penyakit secara dini dan akurat.</p>
            </div>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             <div class="bg-surface-dark p-8 rounded-xl border border-white/5 flex flex-col gap-4">
                <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-2"><span class="material-symbols-outlined text-3xl">agriculture</span></div>
                <h3 class="text-xl font-bold text-white">Komoditas Utama</h3>
                <p class="text-slate-400 leading-relaxed">Indonesia adalah salah satu penghasil kakao terbesar di dunia. Kami ingin menjaga kualitas hasil panen petani.</p>
            </div>
            <div class="bg-surface-dark p-8 rounded-xl border border-white/5 flex flex-col gap-4">
                <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-2"><span class="material-symbols-outlined text-3xl">science</span></div>
                <h3 class="text-xl font-bold text-white">Metode Pakar</h3>
                <p class="text-slate-400 leading-relaxed">Sistem kami menggunakan metode Certainty Factor (CF) yang diadopsi dari pengetahuan para ahli patologi tanaman.</p>
            </div>
            <div class="bg-surface-dark p-8 rounded-xl border border-white/5 flex flex-col gap-4 md:col-span-2 lg:col-span-1">
                <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-2"><span class="material-symbols-outlined text-3xl">trending_up</span></div>
                <h3 class="text-xl font-bold text-white">Peningkatan Hasil</h3>
                <p class="text-slate-400 leading-relaxed">Deteksi dini berarti penanganan yang lebih cepat, mengurangi resiko gagal panen secara signifikan.</p>
            </div>
        </section>
         <section class="flex flex-col lg:flex-row gap-8 pb-12">
            <div class="w-full lg:w-5/12 bg-surface-dark p-8 rounded-xl border border-white/5">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-white mb-2">Hubungi Kami</h2>
                    <p class="text-slate-400 text-sm">Punya pertanyaan seputar hama kakao atau sistem pakar kami?</p>
                </div>
                <form class="flex flex-col gap-5">
                    <input class="w-full bg-background-dark/50 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-slate-600 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="Masukan nama anda" type="text"/>
                    <input class="w-full bg-background-dark/50 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-slate-600 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="contoh@email.com" type="email"/>
                    <textarea class="w-full bg-background-dark/50 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-slate-600 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none" placeholder="Tuliskan pesan anda disini..." rows="4"></textarea>
                    <button class="mt-2 w-full bg-primary hover:bg-primary/90 text-background-dark font-bold py-3.5 rounded-lg transition-all flex items-center justify-center gap-2" type="button">
                        <span>Kirim Pesan</span>
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<?php include 'includes/footer.php'; ?>
