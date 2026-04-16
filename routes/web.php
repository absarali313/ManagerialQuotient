<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::get('dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    
    if ($user->role === 'admin') {
        // Ensure admin has a company
        $company = $user->myCompany;
        if (!$company) {
            $company = \App\Models\Company::create(['name' => $user->name . ' Organization', 'admin_id' => $user->id]);
            $user->update(['company_id' => $company->id]);
        }
        // Fetch only employees of this company
        $users = \App\Models\User::where('company_id', $company->id)
            ->where('role', 'employee')
            ->with('assessments')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact('users', 'company'));
    } else {
        return view('employee.dashboard', compact('user'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('add-employee', function (\Illuminate\Http\Request $request) {
    $admin = \Illuminate\Support\Facades\Auth::user();
    if ($admin->role !== 'admin') abort(403);
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'employee',
        'company_id' => $admin->company_id ?? $admin->myCompany->id,
    ]);

    return redirect()->back()->with('status', 'Employee added successfully!');
})->middleware(['auth', 'verified'])->name('add-employee');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('assessment', 'assessment-room')
    ->middleware(['auth', 'verified'])
    ->name('assessment');

Route::get('hub', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    return view('hub', compact('user'));
})->middleware(['auth', 'verified'])->name('hub');

Route::get('cycles', function () {
    $users = \App\Models\User::with('assessments')->get();
    return view('cycles', compact('users'));
})->middleware(['auth', 'verified'])->name('cycles');

Route::view('goals', 'goals')
    ->middleware(['auth', 'verified'])
    ->name('goals');

require __DIR__.'/auth.php';
