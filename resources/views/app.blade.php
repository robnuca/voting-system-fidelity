<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIDELITY FULFILMENT - Voting system</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen justify-between bg-gray-100">
    <header class="bg-fidelityPurple text-white text-center py-4">
        <img src="https://fidelityfulfilment.com/hs-fs/hubfs/FidelityFulfilmet_October2023/images/Site-Logo_Retina-Logo-Wht%20(1).webp?width=459&height=121&name=Site-Logo_Retina-Logo-Wht%20(1).webp" alt="Logo" class="mx-auto w-48 mb-4">
    </header>
    <div class="flex flex-col items-center justify-center flex-grow">
        <div id="app" class="w-full max-w-md p-6 bg-white shadow-md rounded-lg"></div>
    </div>
    <footer class="bg-fidelityPurple text-white text-center py-2">
        &copy; 2024 FIDELITY FULFILMENT. All rights reserved.
    </footer>
    @vite('resources/js/app.js')
</body>
</html>