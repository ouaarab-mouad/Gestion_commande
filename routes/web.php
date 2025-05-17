<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\RechercheController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\CategorieController;
    use App\Http\Controllers\ProduitController;
    use App\Http\Controllers\CommandeController;
    use App\Http\Controllers\LigneCommandeController;
    use App\Http\Controllers\TestContlroller;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\RegisterController;

    // Home Route
    Route::get('/', function () {
        return view('home');
    })->name('home')->middleware('auth');

    // Auth Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Protected Routes
    Route::middleware('auth')->group(function () {
        Route::resource('clients', ClientController::class);
        Route::resource('categories', CategorieController::class)->parameters([
            'categories' => 'categorie'
        ]);
        Route::resource('produits', ProduitController::class);
        Route::resource('commandes', CommandeController::class);
        Route::resource('ligne-commandes', LigneCommandeController::class);

        // Search Routes
        Route::prefix('recherche')->name('recherche.')->group(function () {
            // php  par client
            Route::get('/commandes-par-client', [RechercheController::class, 'showCommandesParClientForm'])->name('commandes-par-client.form');
            Route::post('/commandes-par-client', [RechercheController::class, 'commandesParClient'])->name('commandes-par-client');
            
            // Montant par période
            Route::get('/montant-par-periode', [RechercheController::class, 'showMontantParPeriodeForm'])->name('montant-par-periode.form');
            Route::post('/montant-par-periode', [RechercheController::class, 'montantParPeriode'])->name('montant-par-periode');
            
            // Statistiques par produit
            Route::get('/statistiques-par-produit', [RechercheController::class, 'statistiquesParProduit'])->name('statistiques-par-produit');
        });

        // Test Routes
        Route::resource('task', TestContlroller::class);
    });
