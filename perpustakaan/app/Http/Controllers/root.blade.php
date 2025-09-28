use App\Models\User;

Route::middleware(['auth', 'checkRole:root'])->group(function () {
    Route::get('/root/dashboard', function () {
        $users = User::all();
        return view('dashboard.root', compact('users'));
    })->name('dashboard.root');
});
