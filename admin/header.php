<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Karya Jaya - Sistem Pakar Kakao</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#17cf54",
                        "primary-dark": "#12a342",
                        "background-dark": "#111813",
                        "surface-dark": "#1c261f",
                        "border-dark": "#29382e",
                        "surface-highlight": "#233329",
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background-dark text-slate-100 font-display flex h-screen overflow-hidden">
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit;
}
include_once __DIR__ . '/../includes/functions.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-64 flex-shrink-0 flex flex-col justify-between border-r border-[#29382e] bg-background-dark h-full">
    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center justify-center bg-surface-highlight rounded-lg size-10 border border-[#29382e] text-primary">
                <span class="material-symbols-outlined">shield_person</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-white text-base font-bold leading-tight">Admin KJ</h1>
                <p class="text-[#9db8a6] text-xs font-normal">Sistem Pakar</p>
            </div>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'index.php' ? 'bg-primary/20 text-primary border border-primary/10' : 'text-slate-400 hover:bg-surface-highlight hover:text-white'; ?> transition-colors" href="index.php">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'diseases.php' ? 'bg-primary/20 text-primary border border-primary/10' : 'text-slate-400 hover:bg-surface-highlight hover:text-white'; ?> transition-colors" href="diseases.php">
                <span class="material-symbols-outlined">medical_services</span>
                <span class="text-sm font-medium">Penyakit</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'symptoms.php' ? 'bg-primary/20 text-primary border border-primary/10' : 'text-slate-400 hover:bg-surface-highlight hover:text-white'; ?> transition-colors" href="symptoms.php">
                <span class="material-symbols-outlined">thermometer</span>
                <span class="text-sm font-medium">Gejala</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'rules.php' ? 'bg-primary/20 text-primary border border-primary/10' : 'text-slate-400 hover:bg-surface-highlight hover:text-white'; ?> transition-colors" href="rules.php">
                <span class="material-symbols-outlined">rule</span>
                <span class="text-sm font-medium">Basis Pengetahuan</span>
            </a>
        </nav>
    </div>
    <div class="p-4 border-t border-[#29382e]">
        <a href="logout.php" class="flex w-full cursor-pointer items-center justify-center gap-2 rounded-lg h-10 bg-[#233329] hover:bg-[#2d4235] text-white text-sm font-bold transition-colors">
            <span class="material-symbols-outlined text-[18px]">logout</span>
            <span>Keluar</span>
        </a>
    </div>
</aside>
<main class="flex-1 flex flex-col h-full overflow-hidden relative">
