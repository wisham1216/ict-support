<?php

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $statusCounts = Ticket::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();


    // Fetch ticket trends for the past 7 days
    $ticketTrends = Ticket::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Format data for the chart
    $dates = $ticketTrends->pluck('date')->map(function ($date) {
        return Carbon::parse($date)->format('M d');
    });
    $counts = $ticketTrends->pluck('count');
    return view('dashboard', compact('statusCounts', 'dates', 'counts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::resource('tickets', TicketController::class);

    // access request routes
    Route::get('access-requests', [AccessController::class, 'index'])->name('access-requests.index');
    Route::get('access-requests/create', [AccessController::class, 'create'])->name('access-requests.create');
    Route::post('access-requests', [AccessController::class, 'store'])->name('access-requests.store');
    Route::get('access-requests/{id}', [AccessController::class, 'show'])->name('access-requests.show');
    Route::post('access-requests/{id}/status', [AccessController::class, 'updateStatus'])->name('access-requests.updateStatus');
    Route::resource('access-requests', AccessController::class);

    // Access Request Permission Management
    Route::post('access-requests/{access}/grant', [AccessController::class, 'grantPermission'])->name('access-requests.grant');
    Route::post('access-requests/{access}/modify', [AccessController::class, 'modifyPermission'])->name('access-requests.modify');
    Route::post('access-requests/{access}/revoke', [AccessController::class, 'revokePermission'])->name('access-requests.revoke');

    // user management routes
    Route::resource('users', UserController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::post('tickets/{ticketId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('tickets/{ticketId}/comments', [CommentController::class, 'index'])->name('comments.index');
});
require __DIR__ . '/auth.php';
