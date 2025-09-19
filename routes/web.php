<?php
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserShow;

use App\Livewire\Roles\RoleCreate;
use App\Livewire\Roles\RoleEdit;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Roles\RoleShow;

use App\Livewire\Products\ProductCreate;
use App\Livewire\Products\ProductEdit;
use App\Livewire\Products\ProductIndex;
use App\Livewire\Products\ProductShow;

use App\Livewire\Categorias\CategoriaCreate;
use App\Livewire\Categorias\CategoriaEdit;
use App\Livewire\Categorias\CategoriaIndex;
use App\Livewire\Categorias\CategoriaShow;

use App\Livewire\Presupuestos\PresupuestoCreate;
use App\Livewire\Presupuestos\PresupuestoEdit;
use App\Livewire\Presupuestos\PresupuestoIndex;
use App\Livewire\Presupuestos\PresupuestoShow;

use App\Livewire\Transacciones\TransaccionCreate;
use App\Livewire\Transacciones\TransaccionEdit;
use App\Livewire\Transacciones\TransaccionIndex;
use App\Livewire\Transacciones\TransaccionShow;

use App\Livewire\Reportes\ReporteCreate;
use App\Livewire\Reportes\ReporteEdit;
use App\Livewire\Reportes\ReporteIndex;
use App\Livewire\Reportes\ReporteShow;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('users', UserIndex::class)->name('users.index')->middleware('permission:user.view|user.create|user.edit|user.delete');
    Route::get('users/create', UserCreate::class)->name('users.create')->middleware('permission:user.create');
    Route::get('users/{id}/edit', UserEdit::class)->name('users.edit')->middleware('permission:user.edit');
    Route::get('users/{id}', UserShow::class)->name('users.show')->middleware('permission:user.view');

    Route::get('products', ProductIndex::class)->name('products.index')->middleware('permission:product.view|product.create|product.edit|product.delete');
    Route::get('products/create', ProductCreate::class)->name('products.create')->middleware('permission:product.create');
    Route::get('products/{id}/edit', ProductEdit::class)->name('products.edit')->middleware('permission:product.edit');
    Route::get('products/{id}', ProductShow::class)->name('products.show')->middleware('permission:product.view');
    
    Route::get('roles', RoleIndex::class)->name('roles.index')->middleware('permission:role.view|role.create|role.edit|role.delete');
    Route::get('roles/create', RoleCreate::class)->name('roles.create')->middleware('permission:role.create');
    Route::get('roles/{id}/edit', RoleEdit::class)->name('roles.edit')->middleware('permission:role.edit');
    Route::get('roles/{id}', RoleShow::class)->name('roles.show')->middleware('permission:role.view');
    
    Route::get('categorias', CategoriaIndex::class)->name('categorias.index')->middleware('permission:categoria.view|categoria.create|categoria.edit|categoria.delete');
    Route::get('categorias/create', CategoriaCreate::class)->name('categorias.create')->middleware('permission:categoria.create');
    Route::get('categorias/{id}/edit', CategoriaEdit::class)->name('categorias.edit')->middleware('permission:categoria.edit');
    Route::get('categorias/{id}', CategoriaShow::class)->name('categorias.show')->middleware('permission:categoria.view');

    Route::get('presupuestos', PresupuestoIndex::class)->name('presupuestos.index')->middleware('permission:presupuesto.view|presupuesto.create|presupuesto.edit|presupuesto.delete');
    Route::get('presupuestos/create', PresupuestoCreate::class)->name('presupuestos.create')->middleware('permission:presupuesto.create');
    Route::get('presupuestos/{id}/edit', PresupuestoEdit::class)->name('presupuestos.edit')->middleware('permission:presupuesto.edit');
    Route::get('presupuestos/{id}', PresupuestoShow::class)->name('presupuestos.show')->middleware('permission:presupuesto.view');

    Route::get('transacciones', TransaccionIndex::class)->name('transacciones.index')->middleware('permission:transaccion.view|transaccion.create|transaccion.edit|transaccion.delete');
    Route::get('transacciones/create', TransaccionCreate::class)->name('transacciones.create')->middleware('permission:transaccion.create');
    Route::get('transacciones/{id}/edit', TransaccionEdit::class)->name('transacciones.edit')->middleware('permission:transaccion.edit');
    Route::get('transacciones/{id}', TransaccionShow::class)->name('transacciones.show')->middleware('permission:transaccion.view');

    Route::get('reportes', ReporteIndex::class)->name('reportes.index')->middleware('permission:reporte.view|reporte.create|reporte.edit|reporte.delete');
    Route::get('reportes/create', ReporteCreate::class)->name('reportes.create')->middleware('permission:reporte.create');
    Route::get('reportes/{id}/edit', ReporteEdit::class)->name('reportes.edit')->middleware('permission:reporte.edit');
    Route::get('reportes/{id}', ReporteShow::class)->name('reportes.show')->middleware('permission:reporte.view');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/language', 'settings.language')->name('settings.language');
});

require __DIR__.'/auth.php';
