<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<nav id="navbar" class="sticky top-0 z-50 w-full border-b border-border-dark bg-background-dark/80 backdrop-blur-md">
    <div class="px-6 md:px-10 py-4 flex items-center justify-between mx-auto max-w-7xl">
        <a href="index.php" class="flex items-center gap-3 text-white">
            <div class="flex size-10 items-center justify-center rounded-lg bg-primary/20 text-primary">
                <span class="material-symbols-outlined text-[24px]">local_florist</span>
            </div>
            <h2 class="text-white text-lg font-bold leading-tight tracking-tight">Karya Jaya</h2>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8">
            <nav class="flex items-center gap-8">
                <a class="<?php echo $current_page == 'index.php' ? 'text-primary' : 'text-text-light hover:text-primary'; ?> transition-colors text-sm font-medium" href="index.php">Beranda</a>
                <a class="<?php echo $current_page == 'about.php' ? 'text-primary' : 'text-text-light hover:text-primary'; ?> transition-colors text-sm font-medium" href="about.php">Tentang Kami</a>
                <a class="<?php echo $current_page == 'catalog.php' ? 'text-primary' : 'text-text-light hover:text-primary'; ?> transition-colors text-sm font-medium" href="catalog.php">Katalog</a>
                <a class="<?php echo $current_page == 'education.php' ? 'text-primary' : 'text-text-light hover:text-primary'; ?> transition-colors text-sm font-medium" href="education.php">Edukasi</a>
                <a class="<?php echo $current_page == 'history.php' ? 'text-primary' : 'text-text-light hover:text-primary'; ?> transition-colors text-sm font-medium" href="history.php">Riwayat</a>
            </nav>
            <div class="flex items-center gap-4">
                <a href="admin/index.php" class="text-text-light hover:text-primary transition-colors text-sm font-medium">Login Admin</a>
                <a href="diagnosis.php" class="flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-5 bg-primary hover:bg-primary/90 transition-all text-[#111813] text-sm font-bold shadow-[0_0_15px_rgba(23,207_84,0.3)]">
                    Mulai Diagnosa
                </a>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-text-light focus:outline-none p-2 rounded-lg hover:bg-white/10 transition-colors">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-border-dark bg-background-dark/95 backdrop-blur-md px-6 py-4">
        <div class="flex flex-col gap-4">
            <a class="<?php echo $current_page == 'index.php' ? 'text-primary' : 'text-text-light'; ?> py-2 text-base font-medium" href="index.php">Beranda</a>
            <a class="<?php echo $current_page == 'about.php' ? 'text-primary' : 'text-text-light'; ?> py-2 text-base font-medium" href="about.php">Tentang Kami</a>
            <a class="<?php echo $current_page == 'catalog.php' ? 'text-primary' : 'text-text-light'; ?> py-2 text-base font-medium" href="catalog.php">Katalog</a>
            <a class="<?php echo $current_page == 'education.php' ? 'text-primary' : 'text-text-light'; ?> py-2 text-base font-medium" href="education.php">Edukasi</a>
            <a class="<?php echo $current_page == 'history.php' ? 'text-primary' : 'text-text-light'; ?> py-2 text-base font-medium" href="history.php">Riwayat</a>
            <a class="text-text-light py-2 text-base font-medium" href="admin/index.php">Login Admin</a>
            <a href="diagnosis.php" class="mt-2 flex items-center justify-center rounded-lg h-12 bg-primary text-[#111813] font-bold shadow-lg">
                Mulai Diagnosa
            </a>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            const icon = this.querySelector('.material-symbols-outlined');
            if (mobileMenu.classList.contains('hidden')) {
                icon.textContent = 'menu';
            } else {
                icon.textContent = 'close';
            }
        });
    }
});
</script>
