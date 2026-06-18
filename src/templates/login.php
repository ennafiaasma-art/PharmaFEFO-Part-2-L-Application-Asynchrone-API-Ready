<!DOCTYPE html>
<html lang="co">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacie Login - MaPharma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-emerald-50 transition-all duration-300 hover:shadow-2xl">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-500 text-white mb-4 shadow-lg shadow-emerald-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Espace Pharmacie</h2>
            <p class="text-sm text-gray-500 mt-1">Marhaban bika, rja3 l-hssab dialk</p>
        </div>

        <form action="../controller/web/AuthController.php" method="POST" class="space-y-5">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">L-brigh l-iliktroni (Email)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" id="email" name="email" required
                        class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-gray-800 placeholder-gray-400 text-sm"
                        placeholder="pharmacien@example.com">
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-sm font-medium text-gray-700">Klimat l-mourour (Password)</label>
                    <a href="#" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition">Nsitiha?</a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all text-gray-800 placeholder-gray-400 text-sm"
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between pt-1">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">remember-me</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button name="submit" type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200 transition-all duration-200 transform active:scale-[0.98]">
                     Connexion
                </button>
            </div>
        </form>

        <!-- Footer Card -->
        <div class="mt-8 text-center border-t border-gray-100 pt-4">
            <p class="text-xs text-gray-400">
                &copy; 2026 Système de Gestion de Pharmacie. Kull l-huquq mahfouda.
            </p>
        </div>

    </div>

</body>
</html>