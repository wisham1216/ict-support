<?php

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemAccessController;
use App\Http\Controllers\AccessCommentController;

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
    Route::controller(TicketController::class)->group(function () {
        Route::get('tickets', 'index')

            ->name('tickets.index');

        Route::get('tickets/create', 'create')

            ->name('tickets.create');

        Route::post('tickets', 'store')

            ->name('tickets.store');

        Route::get('tickets/{id}', 'show')

            ->name('tickets.show');

        Route::get('tickets/{ticket}/edit', 'edit')

            ->name('tickets.edit');

        Route::put('tickets/{ticket}', 'update')

            ->name('tickets.update');

        Route::delete('tickets/{ticket}', 'destroy')

            ->name('tickets.destroy');

        Route::post('tickets/{id}/status', 'updateStatus')

            ->name('tickets.updateStatus');

        Route::post('tickets/{ticket}/assign', 'assign')

            ->name('tickets.assign');

        Route::post('tickets/{ticket}/priority', 'updatePriority')

            ->name('tickets.updatePriority');
    });

    // access request routes
    Route::controller(AccessController::class)->group(function () {
        Route::get('access-requests', 'index')

            ->name('access-requests.index');

        Route::get('access-requests/create', 'create')

            ->name('access-requests.create');

        Route::post('access-requests', 'store')

            ->name('access-requests.store');

        Route::get('access-requests/{id}', 'show')

            ->name('access-requests.show');

        Route::get('access-requests/{id}/edit', 'edit')

            ->name('access-requests.edit');

        Route::put('access-requests/{id}', 'update')

            ->name('access-requests.update');

        Route::delete('access-requests/{id}', 'destroy')

            ->name('access-requests.destroy');

        Route::post('access-requests/{id}/update-status', 'updateStatus')

            ->name('access-requests.updateStatus');

        Route::post('access-requests/{access}/grant', 'grantPermission')

            ->name('access-requests.grant');

        Route::post('access-requests/{access}/modify', 'modifyPermission')

            ->name('access-requests.modify');

        Route::post('access-requests/{access}/revoke', 'revokePermission')

            ->name('access-requests.revoke');
    });

    // user management routes
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/roles', [UserRoleController::class, 'edit'])->name('users.roles');
    Route::put('/users/{user}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');
});
Route::middleware(['auth'])->group(function () {
    Route::post('tickets/{ticketId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('tickets/{ticketId}/comments', [CommentController::class, 'index'])->name('comments.index');
});

// Roles and Permissions Management Routes
//'can:manage roles'
Route::middleware(['auth'])->group(function () {
    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');

    // Roles routes
    Route::resource('roles', RoleController::class);

    // Permissions routes
    Route::resource('permissions', PermissionController::class);

    Route::resource('systems', SystemController::class);
    Route::resource('system-accesses', SystemAccessController::class);
    Route::get('/api/systems/{system}/accesses', [SystemController::class, 'getAccesses'])->name('api.systems.accesses');
});

Route::post('/tickets/{ticket}/priority', [TicketController::class, 'updatePriority'])->name('tickets.updatePriority');

Route::post('access-requests/{access}/comments', [AccessCommentController::class, 'store'])
    ->name('access-requests.comments.store');

require __DIR__ . '/auth.php';
