 <header class="fixed top-0 left-0 w-full h-16 bg-white z-50 shadow">

     <div class="max-w-7x1 mx-auto px-3 py-0 flex flex-col md:flex-row items-center justify-between gap-4">

         <!-- Centro: logos + título y subtítulo -->
         <div class="flex items-center justify-center gap-2 md:gap-3 flex-wrap">
             <a href="{{ route('inicio') }}" class="inline-block no-underline">
                 <img src="{{ asset('assets/img/logo-san-felipe.png') }}" alt="Hospital San Felipe" title="Inicio"
                     class="h-16 w-auto"></a>
             <div class="text-center">
                 <h1
                     class="text-4xl md:text-2xl font-bold bg-gradient-to-r from-[#1B7D8F] via-[#2BA8A0] to-[#245360] text-transparent bg-clip-text drop-shadow-md tracking-widest whitespace-nowrap">
                     Hospital San Felipe
                 </h1>
                 <p class="text-[10px] text-[#4B6C73] tracking-wider uppercase mt-0 ">
                     Sistema de Gestión Institucional
                 </p>
             </div>


         </div>
         <!-- Acciones del usuario -->
         <div class="flex items-center gap-3 flex-shrink-0">
             <!-- Usuario -->
             <div class="hidden md:flex items-center gap-2 text-sm text-gray-600">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#1B7D8F]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="M5.121 17.804A9 9 0 1118.88 6.195A9 9 0 015.12 17.804z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                 </svg>
                 {{-- @lang('Usuario Conectado') --}}
                         @if (Auth::check())
                     <span>{{ Auth::user()->name }}</span>
                         @else
                     <span>Invitado</span>
                         @endif
                     </div>


             <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <button type="submit" class="boton-sin-borde">
                     <img src="{{ asset('assets/img/salir.jpeg') }}" alt="cerrar sesion" class="h-8 w-auto">
                 </button>

             </form>
             {{-- <a href="" class="inline-block no-underline" title="Cerrar Sesión">
                 <img src="{{ asset('assets/img/salir.jpeg') }}" alt="cerrar sesion" class="h-8 w-auto">
                 
              </a> --}}


         </div>
     </div>
 </header>

 <style>
     .boton-sin-borde {
         border: none;
         background: none;
         padding: 0;
         cursor: pointer;
         outline: none;
     }

     .boton-sin-borde:focus,
     .boton-sin-borde:active {
         outline: none;
         box-shadow: none;
         border: none;
     }
 </style>
