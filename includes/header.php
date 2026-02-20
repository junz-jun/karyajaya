<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Karya Jaya - Sistem Pakar Diagnosa Penyakit Kakao</title>
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
                        "background-light": "#f6f8f6",
                        "background-dark": "#111813",
                        "surface-dark": "#1c261f",
                        "border-dark": "#29382e",
                        "text-light": "#e2e8f0",
                        "text-muted": "#9db8a6",
                        "card-dark": "#1a2c20",
                        "surface-light": "#ffffff",
                        "surface-highlight": "#233329",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #111813; }
        ::-webkit-scrollbar-thumb { background: #29382e; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #3c5344; }
        body { background-color: #111813; color: #e2e8f0; }
    </style>
</head>
<body class="bg-background-dark text-text-light font-display">
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
