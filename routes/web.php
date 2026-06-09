<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CamaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\OcupacionCamaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfesionController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\TipoAnestesiaController;
use App\Http\Controllers\UsuarioPerfilController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CirugiaController;
use App\Http\Controllers\QuirofanoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::get('/', function () {return view('index');})->middleware('auth')->name('inicio');
Route::get('/', [InicioController::class, 'index'])->middleware('auth')->name('inicio');


// Live search para el buscador del modal (DEBE QUEDAR AFUERA DEL MIDDLEWARE)
Route::get('/pacientes/live-search', [PacienteController::class, 'liveSearch'])->name('pacientes.liveSearch');

//Buscador
Route::middleware(['auth', 'roles:admin,pacientes,cirugias,camas,estadisticas'])->group(function () {
    Route::get('/buscar', [PersonaController::class, 'buscar'])->name('buscar');
    Route::get('/buscar/ajax', [PersonaController::class, 'buscarAjax'])->name('buscar.ajax');
    Route::get('/persona/{id}', [PersonaController::class, 'ver'])->name('persona.ver');
});


// configuracion
Route::view('/ajustes', 'ajustes')->middleware('auth')->name('ajustes');


//vista estadistica
Route::middleware(['auth', 'roles:estadisticas'])->group(function () {
    Route::get('/cirugias/estadisticas', [CirugiaController::class, 'estadisticas'])->name('cirugias.estadisticas');
    Route::get('/stocks/estadisticasstock', [StockController::class, 'estadisticas'])->name('stocks.estadisticasstock');
});

// Route::get('/prueba', function (){
//     return view('prueba');
// });

//Usuario perfiles
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/perfiles', [UsuarioPerfilController::class, 'index'])->name('UsuarioPerfil.index');
    Route::get('/perfiles/create', [UsuarioPerfilController::class, 'create'])->name('UsuarioPerfil.create');
    Route::post('/perfiles', [UsuarioPerfilController::class, 'store'])->name('UsuarioPerfil.store');
    Route::get('/perfiles/{perfil}/edit', [UsuarioPerfilController::class, 'edit'])->name('UsuarioPerfil.edit');
    Route::put('/perfiles/{perfil}', [UsuarioPerfilController::class, 'update'])->name('UsuarioPerfil.update');
    Route::delete('/perfiles/{perfil}', [UsuarioPerfilController::class, 'destroy'])->name('UsuarioPerfil.destroy');
});


//Profesiones
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/profesiones', [ProfesionController::class, 'index'])->name('profesion.index');
    Route::get('/profesiones/create', [ProfesionController::class, 'create'])->name('profesion.create');
    Route::post('/profesiones', [ProfesionController::class, 'store'])->name('profesion.store');
    Route::get('/profesiones/{profesion}/edit', [ProfesionController::class, 'edit'])->name('profesion.edit');
    Route::get('/profesiones/{profesion}/show', [ProfesionController::class, 'show'])->name('profesion.show');
    Route::put('/profesiones/{profesion}', [ProfesionController::class, 'update'])->name('profesion.update');
    Route::delete('/profesiones/{profesion}', [ProfesionController::class, 'destroy'])->name('profesion.destroy');
});

//Empleados
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados/{empleado}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    Route::get('/empleados/{empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
    Route::put('/empleados/{empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
    Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
});



// Pacientes
Route::middleware(['auth', 'roles:pacientes'])->group(function () {
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/{paciente}/edit', [PacienteController::class, 'edit'])->name('pacientes.edit');
    Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])->name('pacientes.show');
    Route::put('/pacientes/{paciente}', [PacienteController::class, 'update'])->name('pacientes.update');
    Route::delete('/pacientes/{paciente}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

    // --- RUTAS VULNERABLES CORREGIDAS ---
    // Asignación desde vista detallada
    Route::get('/pacientes/{paciente}/asignar', [PacienteController::class, 'asignar'])->name('pacientes.asignar');
    Route::post('/pacientes/{paciente}/asignar', [PacienteController::class, 'guardarAsignacion'])->name('pacientes.asignar.guardar');

    // Asignación directa (con ID del paciente)
    Route::post('/pacientes/{paciente}/asignar-directa', [PacienteController::class, 'asignarDirecta'])->name('pacientes.asignarDirecta');

    // // Live search para el buscador del modal
    // Route::get('/pacientes/live-search', [PacienteController::class, 'liveSearch'])->name('pacientes.liveSearch');

    // Alta de paciente (Ya estaba protegida, se mantiene)
    Route::post('/pacientes/{paciente}/dar-de-alta', [PacienteController::class, 'darDeAlta'])
        ->middleware(['auth', 'roles:admin'])->name('pacientes.darDeAlta');
});




//Procedimientos
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/procedimientos', [ProcedimientoController::class, 'index'])->name('procedimientos.index');
    Route::get('/procedimientos/create', [ProcedimientoController::class, 'create'])->name('procedimientos.create');
    Route::post('/procedimientos', [ProcedimientoController::class, 'store'])->name('procedimientos.store');
    Route::get('/procedimientos/{procedimiento}/edit', [ProcedimientoController::class, 'edit'])->name('procedimientos.edit');
    Route::get('/procedimientos/{procedimiento}/show', [ProcedimientoController::class, 'show'])->name('procedimientos.show');
    Route::put('/procedimientos/{procedimiento}', [ProcedimientoController::class, 'update'])->name('procedimientos.update');
    Route::delete('/procedimientos/{procedimiento}', [ProcedimientoController::class, 'destroy'])->name('procedimientos.destroy');
    Route::post('/pacientes/{paciente}/asignar-directa', [PacienteController::class, 'asignarDirecta'])
        ->name('pacientes.asignar.directa');
});


//Tipo Anestesia
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/tipoAnestesias', [TipoAnestesiaController::class, 'index'])->name('tipoAnestesias.index');
    Route::get('/tipoAnestesias/create', [TipoAnestesiaController::class, 'create'])->name('tipoAnestesias.create');
    Route::post('/tipoAnestesias', [TipoAnestesiaController::class, 'store'])->name('tipoAnestesias.store');
    Route::get('/tipoAnestesias/{anestesia}/edit', [TipoAnestesiaController::class, 'edit'])->name('tipoAnestesias.edit');
    Route::put('/tipoAnestesias/{anestesia}', [TipoAnestesiaController::class, 'update'])->name('tipoAnestesias.update');
    Route::delete('/tipoAnestesias/{anestesia}', [TipoAnestesiaController::class, 'destroy'])->name('tipoAnestesias.destroy');
});


//Salas
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');
    Route::get('/salas/create', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/salas', [SalaController::class, 'store'])->name('salas.store');
    Route::get('/salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit');
    Route::put('/salas/{sala}', [SalaController::class, 'update'])->name('salas.update');
    Route::delete('/salas/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');
});

//Habitaciones
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/habitaciones', [HabitacionController::class, 'index'])->name('habitaciones.index');
    Route::get('/habitaciones/create', [HabitacionController::class, 'create'])->name('habitaciones.create');
    Route::post('/habitaciones', [HabitacionController::class, 'store'])->name('habitaciones.store');
    Route::get('/habitaciones/{habitacion}/edit', [HabitacionController::class, 'edit'])->name('habitaciones.edit');
    Route::put('/habitaciones/{habitacion}', [HabitacionController::class, 'update'])->name('habitaciones.update');
    Route::delete('/habitaciones/{habitacion}', [HabitacionController::class, 'destroy'])->name('habitaciones.destroy');
    //Se agrega la gestion de camas para el admin, no las ocupaciones
    Route::get('/camas/listar', [CamaController::class, 'index'])->name('camas.listar');
    Route::get('/camas/create', [CamaController::class, 'create'])->name('camas.create');
    Route::get('/camas/{cama}/edit', [CamaController::class, 'edit'])->name('camas.edit');
    Route::post('/camas', [CamaController::class, 'store'])->name('camas.store');
    Route::put('/camas/{cama}', [CamaController::class, 'update'])->name('camas.update');
    Route::delete('/camas/{cama}', [CamaController::class, 'destroy'])->name('camas.destroy');
});

//Camas
Route::middleware(['auth', 'roles:camas'])->group(function () {
    Route::get('/camas', [CamaController::class, 'index'])->name('camas.index');

    // // Live search para el buscador del modal 

});


//Ocupación Camas
Route::middleware(['auth', 'roles:camas'])->group(function () {
    Route::get('/ocupacionCamas', [OcupacionCamaController::class, 'index'])->name('ocupacionCamas.index');
    Route::get('/ocupacionCamas/create', [OcupacionCamaController::class, 'create'])->name('ocupacionCamas.create');
    Route::post('/ocupacionCamas', [OcupacionCamaController::class, 'store'])->name('ocupacionCamas.store');
    Route::get('/ocupacionCamas/{oc_cama}/edit', [OcupacionCamaController::class, 'edit'])->name('ocupacionCamas.edit');
    Route::get('/ocupacionCamas/{oc_cama}/show', [OcupacionCamaController::class, 'show'])->name('ocupacionCamas.show');
    Route::put('/ocupacionCamas/{oc_cama}', [OcupacionCamaController::class, 'update'])->name('ocupacionCamas.update');
    Route::get('/ocupacionCamas/{oc_cama}/darAlta', [OcupacionCamaController::class, 'darAlta'])->name('ocupacionCamas.darAlta');
});

//Medicamentos
Route::middleware(['auth', 'roles:admin,insumos'])->group(function () {
    Route::get('/medicamentos', [MedicamentoController::class, 'index'])->name('medicamentos.index');
    Route::get('/medicamentos/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
    Route::post('/medicamentos', [MedicamentoController::class, 'store'])->name('medicamentos.store');
    Route::get('/medicamentos/{medicamento}/edit', [MedicamentoController::class, 'edit'])->name('medicamentos.edit');
    Route::put('/medicamentos/{medicamento}', [MedicamentoController::class, 'update'])->name('medicamentos.update');
    Route::delete('/medicamentos/{medicamento}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');
});

//Stock
Route::middleware(['auth', 'roles:insumos'])->group(function () {
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::get('/stocks/{stock}', [StockController::class, 'show'])->name('stocks.show');
    Route::put('/stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
    //Route::delete('/stocks/{}', [StockController::class, 'destroy'])->name('stocks.destroy');
});

//Cirugias
Route::middleware(['auth', 'roles:cirugias'])->group(function () {
    Route::get('/cirugias', [CirugiaController::class, 'index'])->name('cirugias.index');
    Route::get('/cirugias/create', [CirugiaController::class, 'create'])->name('cirugias.create');
    Route::post('/cirugias', [CirugiaController::class, 'store'])->name('cirugias.store');
    Route::get('/cirugias/{cirugia}/edit', [CirugiaController::class, 'edit'])->name('cirugias.edit');
    Route::get('/cirugias/{cirugia}', [CirugiaController::class, 'show'])->name('cirugias.show');
    Route::put('/cirugias/{cirugia}', [CirugiaController::class, 'update'])->name('cirugias.update');
    
    // Surgery medications
    Route::get('/cirugias/{cirugia}/medicamentos', [CirugiaController::class, 'medicamentos'])->name('cirugias.medicamentos');
    Route::post('/cirugias/{cirugia}/medicamentos', [CirugiaController::class, 'guardarMedicamentos'])->name('cirugias.medicamentos.store');
    Route::delete('/cirugias/{cirugia}/medicamentos/{historial}', [CirugiaController::class, 'eliminarMedicamento'])->name('cirugias.medicamentos.destroy');
});

//Quirofanos
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/quirofanos', [QuirofanoController::class, 'index'])->name('quirofanos.index');
    Route::get('/quirofanos/create', [QuirofanoController::class, 'create'])->name('quirofanos.create');
    Route::post('/quirofanos', [QuirofanoController::class, 'store'])->name('quirofanos.store');
    Route::get('/quirofanos/{quirofano}/edit', [QuirofanoController::class, 'edit'])->name('quirofanos.edit');
    Route::get('/quirofanos/{quirofano}/show', [QuirofanoController::class, 'show'])->name('quirofanos.show');
    Route::put('/quirofanos/{quirofano}', [QuirofanoController::class, 'update'])->name('quirofanos.update');
    Route::delete('/quirofanos/{quirofano}', [QuirofanoController::class, 'destroy'])->name('quirofanos.destroy');
});

//Especialidades
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
    Route::get('/especialidades/create', [EspecialidadController::class, 'create'])->name('especialidades.create');
    Route::post('/especialidades', [EspecialidadController::class, 'store'])->name('especialidades.store');
    Route::get('/especialidades/{especialidad}/edit', [EspecialidadController::class, 'edit'])->name('especialidades.edit');
    Route::put('/especialidades/{especialidad}', [EspecialidadController::class, 'update'])->name('especialidades.update');
    Route::delete('/especialidades/{especialidad}', [EspecialidadController::class, 'destroy'])->name('especialidades.destroy');
});

//Servicios
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::resource('servicios', ServicioController::class);
    Route::resource('paises', App\Http\Controllers\PaisController::class)->except(['show']);
    Route::resource('provincias', App\Http\Controllers\ProvinciaController::class)->except(['show']);
    Route::resource('codigos_postales', App\Http\Controllers\CodigoPostalController::class)->except(['show']);
});

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::post('/usuarios/{id}/actualizar-rol', [App\Http\Controllers\UsuarioPerfilController::class, 'actualizarRol'])->name('usuarios.actualizarRol');
    Route::put('/usuarios/{id}/actualizar-rol', [UsuarioPerfilController::class, 'actualizarRol'])->name('usuarios.actualizarRol');
    
    // Rutas para gestión de usuarios
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [App\Http\Controllers\UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [App\Http\Controllers\UserController::class, 'destroy'])->name('usuarios.destroy');
});

// 👇 Debe ir fuera de cualquier grupo con 'auth' o 'roles'
require __DIR__ . '/auth.php';
