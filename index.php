<?php include 'includes/header.php'; ?>

<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-background-light dark:bg-background-dark text-slate-900 dark:text-text-light font-display antialiased">
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-border-dark bg-background-dark/80 backdrop-blur-md px-6 py-4 lg:px-10">
        <div class="flex items-center gap-3 text-white">
            <div class="flex size-10 items-center justify-center rounded-lg bg-primary/20 text-primary">
                <span class="material-symbols-outlined text-[24px]">local_florist</span>
            </div>
            <h2 class="text-white text-lg font-bold leading-tight tracking-[-0.015em]">Karya Jaya</h2>
        </div>
        <div class="hidden md:flex flex-1 justify-end gap-8 items-center">
            <nav class="flex items-center gap-8">
                <a class="text-text-light hover:text-primary transition-colors text-sm font-medium leading-normal" href="index.php">Beranda</a>
                <a class="text-text-light hover:text-primary transition-colors text-sm font-medium leading-normal" href="about.php">Tentang Kami</a>
                <a class="text-text-light hover:text-primary transition-colors text-sm font-medium leading-normal" href="catalog.php">Katalog</a>
                <a class="text-text-light hover:text-primary transition-colors text-sm font-medium leading-normal" href="education.php">Edukasi</a>
            </nav>
            <a href="diagnosis.php" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-5 bg-primary hover:bg-primary/90 transition-all text-[#111813] text-sm font-bold leading-normal tracking-[0.015em] shadow-[0_0_15px_rgba(23,207,84,0.3)]">
                <span class="truncate">Mulai Diagnosa</span>
            </a>
        </div>
    </header>
    <main class="flex-grow">
        <section class="relative overflow-hidden pt-10 pb-20 lg:pt-20 lg:pb-32 px-4">
            <div class="absolute top-0 right-0 -z-10 h-[600px] w-[600px] rounded-full bg-primary/5 blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 -z-10 h-[400px] w-[400px] rounded-full bg-primary/5 blur-[100px]"></div>
            <div class="container mx-auto max-w-7xl">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    <div class="flex-1 flex flex-col gap-6 lg:gap-8 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 rounded-full border border-primary/30 bg-primary/10 px-4 py-1.5 w-fit mx-auto lg:mx-0">
                            <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                            <span class="text-xs font-semibold text-primary uppercase tracking-wide">Sistem Pakar v1.0</span>
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-black leading-[1.1] tracking-tight text-white">
                            Lindungi Tanaman <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-[#86efac]">Kakao Anda</span> dengan Presisi Ahli
                        </h1>
                        <p class="text-text-muted text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Sistem pakar diagnosa penyakit kakao tercanggih menggunakan metode <span class="text-white font-medium">Certainty Factor</span>. Dapatkan hasil analisa akurat dan solusi penanganan terpercaya dalam hitungan detik.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mt-4">
                            <a href="diagnosis.php" class="h-12 px-8 rounded-lg bg-primary hover:bg-primary/90 text-[#111813] font-bold text-base transition-all shadow-[0_0_20px_rgba(23,207,84,0.4)] flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">stethoscope</span>
                                <span>Mulai Diagnosa</span>
                            </a>
                            <a href="about.php" class="h-12 px-8 rounded-lg border border-border-dark hover:border-primary/50 bg-surface-dark hover:bg-surface-dark/80 text-white font-medium text-base transition-all flex items-center justify-center gap-2">
                                <span>Pelajari Metode</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex-1 w-full relative group">
                        <div class="relative rounded-2xl overflow-hidden border border-border-dark shadow-2xl bg-surface-dark aspect-[4/3]">
                            <img alt="Close up of raw cocoa pods" class="object-cover w-full h-full transform transition-transform duration-700 hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuuz2ltlnjNx1iNH9AeQDVAGKyOi2UNN71Vw6B57wCoazQ42WSFpDj1x9y6T0dsxAv9rX14GFM41xBTpqVjZLO_HtyxzEu8vqxQJlFGfVsV_0k_h7pjSBSOkVhGxhh5AxIcNRiFlSgfPdt-jcuVWQRVXwKvYqlfQ8vC9d34H0u6a4BiGMgow96aITkbh9j3N1GDA0Oj6If51VBT7MEg1OlFQ-QXL6UrSBcHzUc98iT0g5uOEG8kH2-Y1t7gOZJ5dREBVyMiB2GaGs"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<?php include 'includes/footer.php'; ?>
