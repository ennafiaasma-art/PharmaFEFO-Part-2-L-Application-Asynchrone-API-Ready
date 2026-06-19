<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gestion Pharma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white font-bold">
                        P
                    </div>
                    <span class="font-bold text-white tracking-wide">PharmaSuite</span>
                </div>
            </div>
            
            <div class="px-6 py-4 border-b border-slate-800 bg-slate-900/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-sm font-semibold text-white">
                        AD
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Dr. Amine</h4>
                        <span class="text-xs px-2 py-0.5 bg-rose-500/20 text-rose-400 font-medium rounded border border-rose-500/30">Administrateur</span>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <button onclick="switchTab('losses')" id="tab-btn-losses" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition bg-slate-800 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Gestion des Pertes (US 4.1)
                </button>

                <button onclick="switchTab('reports')" id="tab-btn-reports" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-slate-400 hover:bg-slate-800 hover:text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                    </svg>
                    Rapports Financiers (US 4.2)
                </button>

                <button onclick="switchTab('users')" id="tab-btn-users" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-slate-400 hover:bg-slate-800 hover:text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Gestion Utilisateurs
                </button>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800">
            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-slate-400 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold text-slate-800">Panneau d'Administration</h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-medium border border-emerald-200">Session active</span>
            </div>
        </header>

        <div class="p-6 max-w-7xl w-full mx-auto space-y-6 flex-1">
            
            <div id="view-losses" class="space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">US 4.1 : Lots Obsolètes</h2>
                        <p class="text-sm text-slate-500">Mettre à jour le statut instantanément sans rafraîchir la page.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    <th class="px-6 py-4">ID / Num Lot</th>
                                    <th class="px-6 py-4">Désignation Produit</th>
                                    <th class="px-6 py-4 text-center">Quantité</th>
                                    <th class="px-6 py-4">Date de Péremption</th>
                                    <th class="px-6 py-4">Statut</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                <tr id="lot-row-1" class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4 font-mono font-medium text-xs text-slate-500">#LOT-2026-04A</td>
                                    <td class="px-6 py-4 font-medium text-slate-900">Doliprane 1000mg (Boîte de 8)</td>
                                    <td id="qty-1" class="px-6 py-4 text-center font-semibold text-amber-700 bg-amber-50/50">42</td>
                                    <td class="px-6 py-4 text-slate-500">30/04/2026</td>
                                    <td class="px-6 py-4">
                                        <span id="status-1" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                            OBSOLETE
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button onclick="destroyLot(1)" id="btn-destroy-1" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg shadow-sm shadow-rose-100 transition-all active:scale-95">
                                            Périmé / À détruire
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="view-reports" class="space-y-6 hidden">
                <div class="bg-gradient-to-r from-slate-900 to-indigo-950 p-6 rounded-2xl text-white shadow-md relative overflow-hidden border border-slate-800">
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-indigo-400 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Route: /admin/reports
                        </div>
                        <h2 class="text-xl font-bold">Rapport Financier des Pertes</h2>
                        <p class="text-xs text-slate-400 mt-1">Accès strictement réservé à l'Administrateur.</p>
                    </div>
                </div>
            </div>

            <div id="view-users" class="space-y-6 hidden">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Gestion des Utilisateurs</h2>
                        <p class="text-sm text-slate-500 mt-0.5">Créez, modifiez ou supprimez les comptes de l'équipe officinale.</p>
                    </div>
                    <div>
                        <button onclick="toggleUserModal(true)" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md shadow-emerald-100 hover:shadow-emerald-200 transition-all duration-200 transform active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/xl" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Ajouter un utilisateur
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    <th class="px-6 py-4">Nom complet</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Rôle</th>
                                    <th class="px-6 py-4">Statut</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">KH</div>
                                            <span class="font-semibold text-slate-900">Dr. Khalid Hassani</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">k.hassani@pharma.ma</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">Pharmacien Titulaire</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Actif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Modifier">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2a2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </button>
                                            <button class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div id="user-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
        <div onclick="toggleUserModal(false)" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
        
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl border border-slate-200 relative z-10 overflow-hidden transform transition-all">
            <div class="px-6 py-4 border-b border-slate-150 bg-slate-50 flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-900">Ajouter un nouvel utilisateur</h3>
                <button onclick="toggleUserModal(false)" class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-200/60 rounded-xl transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <form action="" id="adduser" method="POST" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Nom Complet</label>
                    <input type="text" name="fullname" placeholder="Ex: Dr. Anass El Amrani" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Adresse Email</label>
                    <input type="email"  name="email"placeholder="Ex: a.elamrani@pharma.ma" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Rôle de l'utilisateur</label>
                    <select name="role" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all">
                        <option value="pharmacien_titulaire">Pharmacien Titulaire</option>
                        <option value="preparateur" selected>Préparateur</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100 mt-6">
                    <button type="button" onclick="toggleUserModal(false)" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-xl border border-slate-200 transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-md shadow-emerald-100 transition-colors">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../../../public/js/dashboard.js"></script>
    <script>
        // Fonction pour afficher / masquer le Modal
        function toggleUserModal(show) {
            const modal = document.getElementById('user-modal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        function destroyLot(id) {
            const qtyEl = document.getElementById(`qty-${id}`);
            const statusEl = document.getElementById(`status-${id}`);
            const btnEl = document.getElementById(`btn-destroy-${id}`);
            const rowEl = document.getElementById(`lot-row-${id}`);

            qtyEl.innerText = "0";
            qtyEl.className = "px-6 py-4 text-center font-bold text-slate-400 bg-slate-100/50 line-through";
            statusEl.innerText = "STATUS::EXPIRED";
            statusEl.className = "inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200";
            btnEl.disabled = true;
            btnEl.innerText = "Détruit";
            btnEl.className = "inline-flex items-center px-3 py-1.5 bg-slate-200 text-slate-400 text-xs font-medium rounded-lg cursor-not-allowed";
            rowEl.classList.add('bg-rose-50/30');
        }

        function switchTab(tab) {
            const views = {
                losses: document.getElementById('view-losses'),
                reports: document.getElementById('view-reports'),
                users: document.getElementById('view-users')
            };
            const btns = {
                losses: document.getElementById('tab-btn-losses'),
                reports: document.getElementById('tab-btn-reports'),
                users: document.getElementById('tab-btn-users')
            };

            Object.keys(views).forEach(key => {
                if(key === tab) {
                    views[key].classList.remove('hidden');
                    btns[key].className = "w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition bg-slate-800 text-white";
                } else {
                    views[key].classList.add('hidden');
                    btns[key].className = "w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-slate-400 hover:bg-slate-800 hover:text-slate-200";
                }
            });
        }
    </script>
</body>
</html>