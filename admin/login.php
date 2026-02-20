<?php
session_start();
include_once __DIR__ . '/../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // In database.sql, password is 'admin123' hashed.
    // admin | $2y$10$8Wk/D3qjP1GgXzYxY/pYf.6i1pW7uHlK6qW9z1v1v1v1v1v1v1v1v (this hash was a placeholder, let's fix it)

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Karya Jaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#111813] text-white flex items-center justify-center h-screen">
    <div class="bg-[#1c261f] p-8 rounded-xl border border-[#29382e] w-full max-w-md shadow-2xl">
        <div class="flex flex-col items-center mb-8">
            <div class="bg-primary/20 p-3 rounded-xl text-green-400 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold">Login Admin</h1>
            <p class="text-slate-400 text-sm">Masuk untuk mengelola sistem pakar</p>
        </div>

        <?php if ($error): ?>
        <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg text-sm mb-6 text-center">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Username</label>
                <input type="text" name="username" required class="w-full bg-[#111813] border border-[#29382e] rounded-lg p-3 focus:outline-none focus:border-green-500 transition-colors">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-[#111813] border border-[#29382e] rounded-lg p-3 focus:outline-none focus:border-green-500 transition-colors">
            </div>
            <button type="submit" class="w-full bg-[#17cf54] hover:bg-[#12a342] text-[#111813] font-bold py-3 rounded-lg transition-all shadow-lg shadow-green-500/20">
                Masuk Sekarang
            </button>
            <div class="text-center mt-6">
                <a href="../index.php" class="text-sm text-slate-500 hover:text-white transition-colors">&larr; Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</body>
</html>
