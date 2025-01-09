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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-black dark:text-white/50">
        <div class="h-screen flex flex-col">
            <header class="bg-white dark:bg-zinc-900 shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Recherche d'Entreprises
                        </h1>
                    </div>
                </div>
            </header>

            <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="search()">
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
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-purple-500 dark:focus:ring-blue-400"
                                >
                            </div>
                            <button 
                                @click="searchCompanies()"
                                class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors"
                            >
                                Rechercher
                            </button>
                        </div>

                        <div x-show="query.length > 0" class="mt-8 d-flex flex-column items-center">
                            <div x-show="loading" class="flex justify-center py-4">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                            </div>

                            <div x-show="results.length > 0" class="space-y-4">
                                <template x-for="company in results" :key="company.SIREN">
                                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg">
                                        <h3 x-text="company.NOM" class="text-xl font-semibold text-gray-900 dark:text-white mb-4"></h3>
                                        <div class="grid grid-cols-2 gap-4 m-2">
                                            <div>
                                                <span class="text-gray-500">SIREN:</span>
                                                <span x-text="company.SIREN" class="ml-2"></span>
                                            </div>
                                            <div>
                                                <span class="text-gray-500">SIRET:</span>
                                                <span x-text="company.SIRET_SIEGE" class="ml-2"></span>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center mt-5">
                                            <button @click="company.showComments = !company.showComments" class="text-blue-600 hover:underline">
                                                Voir les commentaires
                                            </button>
                                            <div id="rating-container" class="flex space-x-2">
                                                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                                    <span class="star" :class="{'text-yellow-500': star <= company.rating}" @click="rateCompany(company, star)">
                                                        &#9733;
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                        <div x-show="company.showComments" class="mt-4">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Commentaires:</h4>
                                            <ul>
                                                <template x-for="comment in company.comments" :key="comment.id">
                                                    <li class="border-b border-gray-200 dark:border-gray-700 py-2">
                                                        <p x-text="comment.text" class="text-gray-700 dark:text-gray-300"></p>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div x-show="!loading && results.length === 0" class="text-center py-8">
                                <div class="mb-6 text-gray-500">Aucun résultat trouvé pour votre recherche</div>
                                <h2 class="m-6">Voulez vous enregistrer cette entreprise ?</h2>
                                <div class="flex justify-center flex-column items-center">
                                    <form action="store" method="post" target="_blank" class="ms-4 flex gap-4">
                                        @csrf
                                        <input type="number" name="SIREN" x-model="query" class="px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400" placeholder="SIREN">
                                        <input type="text" name="NOM" class="px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400" placeholder="Nom de l'entreprise">
                                        <input type="number" name="SIRET_SIEGE" class="px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400" placeholder="SIRET">
                                        <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors">Enregistrer</button>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grille de fonctionnalités -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12" x-show="!results.length">
                    <!-- Exemple de fonctionnalité (Recherche complète) -->
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg p-6">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Recherche Complète</h3>
                        <p class="text-gray-600 dark:text-gray-400">Accédez à toutes les informations légales des entreprises.</p>
                    </div>
                    <!-- Exemple de fonctionnalité (Données Fiables) -->
                    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg p-6">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Données Fiables</h3>
                        <p class="text-gray-600 dark:text-gray-400">Information mise à jour quotidiennement depuis societe.com.</p>
                    </div>

                    <!-- Exemple de fonctionnalité (API Performante ) -->
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

            <footer class="bg-white dark:bg-zinc-900 border-t border-gray-200 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="text-center text-gray-600 dark:text-gray-400">
                        <p>© {{ date('Y') }} Recherche d'Entreprises. Tous droits réservés.</p>
                    </div>
                </div>
            </footer>
        </div>

        <script>

        document.addEventListener('alpine:init', () => {
            Alpine.data('companyData', () => ({
                rateCompany(company, rating) {
                    company.rating = rating;
                    // Envoyer la note au serveur
                    fetch(`/rate-company/${company.SIREN}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ rating })
                    }).then(response => response.json())
                      .then(data => {
                          console.log('Success:', data);
                      })
                      .catch((error) => {
                          console.error('Error:', error);
                      });
                }
            }));
        });
            
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
                            const response = await fetch(`/api/entreprises?query=${encodeURIComponent(this.query)}`);
                            if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
                            this.results = await response.json();
                            console.log(this.results);
                        } catch (error) {
                            console.error('Erreur:', error);
                            this.results = [];
                        } finally {
                            this.loading = false;
                        }
                    }
                };
            }

        </script>
    </body>
</html>