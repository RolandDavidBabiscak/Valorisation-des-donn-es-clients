<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recherche d'Entreprises</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-black dark:text-white/50">
        <div class="h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-zinc-900 shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Recherche d'Entreprises
                        </h1>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="search()">
                <!-- Search Section -->
                <div class="max-w-3xl mx-auto mb-12">
                    <h2 class="text-2xl font-semibold text-center mb-8 text-gray-900 dark:text-white">
                        Trouvez toutes les informations sur les entreprises françaises
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <input 
                                    type="text" 
                                    x-model="query"
                                    @input.debounce.300ms="searchCompanies()"
                                    placeholder="Nom de l'entreprise, SIREN, SIRET..." 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                >
                            </div>
                            <button 
                                @click="searchCompanies()"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                            >
                                Rechercher
                            </button>
                        </div>

                        <!-- Results Section -->
                        <div x-show="query.length > 0" class="mt-8">
                            <!-- Loading indicator -->
                            <div x-show="loading" class="flex justify-center py-4">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                            </div>

                            <!-- Results -->
                            <div x-show="results.length > 0" class="space-y-4">
                                <template x-for="company in results" :key="company.siren">
                                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg">
                                        <h3 x-text="company.name" class="text-xl font-semibold text-gray-900 dark:text-white mb-4"></h3>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <span class="text-gray-500">SIREN:</span>
                                                <span x-text="company.siren" class="ml-2"></span>
                                            </div>
                                            <div>
                                                <span class="text-gray-500">SIRET:</span>
                                                <span x-text="company.siret" class="ml-2"></span>
                                            </div>
                                            <div class="col-span-2">
                                                <span class="text-gray-500">Adresse:</span>
                                                <span x-text="company.address" class="ml-2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- No results -->
                            <div x-show="!loading && results.length === 0" class="text-center py-8 text-gray-500">
                                Aucun résultat trouvé pour votre recherche
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12" x-show="!results.length">
                    <!-- Feature 1 -->
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg p-6">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Recherche Complète</h3>
                        <p class="text-gray-600 dark:text-gray-400">Accédez à toutes les informations légales des entreprises.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg p-6">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Données Fiables</h3>
                        <p class="text-gray-600 dark:text-gray-400">Information mise à jour quotidiennement depuis societe.com.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg p-6">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">API Performante</h3>
                        <p class="text-gray-600 dark:text-gray-400">Interface rapide et intuitive pour accéder aux données des entreprises.</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-zinc-900 border-t border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="text-center text-gray-600 dark:text-gray-400">
                        <p>© {{ date('Y') }} Recherche d'Entreprises. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function search() {
                return {
                    query: '',
                    results: [],
                    loading: false,

                    async searchCompanies() {
                        if (this.query.length < 2) {
                            this.results = [];
                            return;
                        }

                        this.loading = true;
                        try {
                            const response = await fetch(`/api/companies/search?query=${encodeURIComponent(this.query)}`);
                            const data = await response.json();
                            this.results = data;
                        } catch (error) {
                            console.error('Erreur lors de la recherche:', error);
                            this.results = [];
                        } finally {
                            this.loading = false;
                        }
                    }
                }
            }
        </script>
    </body>
</html>