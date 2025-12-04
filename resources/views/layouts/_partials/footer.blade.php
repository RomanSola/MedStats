<footer id="footer" class="bg-[#F5FAFA] border-t border-[#C9E4E7] mt-12 text-sm text-[#245360] select-none">
  <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between gap-4">

    <!-- Institucional Info & Logo -->
    <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
      <img src="{{ asset('assets/img/isft38.png') }}" alt="ISFT 38" class="h-12 w-auto">
      <div>
        <p class="font-semibold">Medical Stats © 2025</p>
        <p>Hospital San Felipe · San Nicolás de los Arroyos</p>
        <p class="text-xs">medicalstats2025@gmail.com</p>
      </div>
    </div>

    <!-- Acciones -->
    <div class="flex flex-col md:flex-row gap-2">
      <button type="button" data-toggle="modal" data-target="#aboutModal"
        class="bg-[#1B7D8F] hover:bg-[#176d7b] text-white text-sm px-4 py-2 rounded-md shadow-md transition focus:outline-none">
        ℹ️ Acerca de Medical Stats
      </button>

      <a href="{{ asset('assets/files/Manual_Usuario_MedStats.pdf') }}"
        class="bg-[#1B7D8F] hover:bg-[#176d7b] text-white text-sm px-4 py-2 rounded-md shadow-md transition text-decoration-none">
        📘 Manual de usuario
      </a>
    </div>

  </div>
</footer>

<!-- Modal Acerca de -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-[#1B7D8F] text-white">
        <h5 class="modal-title font-semibold" id="aboutModalLabel">Acerca de Medical Stats</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-gray-700">
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/isft38.png') }}" alt="ISFT 38" class="h-16 w-auto mx-auto mb-2">
            <h4 class="font-bold text-[#1B7D8F]">Medical Stats</h4>
            <p class="text-sm text-gray-500">Versión 1.0</p>
        </div>
        
        <p class="mb-4 text-center">
            <strong>Medical Stats</strong> es un sistema integral para la gestión y visualización de estadísticas médicas, desarrollado para optimizar el análisis de datos en el <strong>Hospital San Felipe</strong>.
        </p>

        <!-- Materias -->
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border border-gray-100">
            <p class="text-center text-xs font-bold text-[#1B7D8F] mb-3 uppercase tracking-wider">
                Tecnicatura Superior en Análisis de Sistemas RM: 6790/19 ISFT N°38
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center border-b md:border-b-0 md:border-r border-gray-200 pb-2 md:pb-0 md:pr-2">
                    <h6 class="font-bold text-gray-800 mb-1">Prácticas Profesionalizantes III</h6>
                    <p class="text-xs text-gray-600">
                        Desarrollo de proyecto real integrando conocimientos tecnicos y competencias profesionales.
                    </p>
                </div>
                <div class="text-center pt-2 md:pt-0 md:pl-2">
                    <h6 class="font-bold text-gray-800 mb-1">Ingeniería de Software II</h6>
                    <p class="text-xs text-gray-600">
                        Aplicacion de metodologias de desarrollo de software, gestión de proyectos, metodologías ágiles y aseguramiento de la calidad del software.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-sm bg-white p-3 rounded border border-gray-100">
            <p class="mb-1"><strong>Equipo de Desarrollo:</strong></p>
            <p class="mb-1"><strong>Alumnos:</strong></p>
            <p class="text-xs text-gray-600 mb-2">
                Araujo Yonel, Cuevas Ariel, Fernandez Lucas, Meis Salvador, Metz Maximo, Ramirez Yeison, Sola Roman, Villoldo Fernando.
            </p>
            <p class="mb-1"><strong>Docentes:</strong></p>
            <p class="text-xs text-gray-600">
                Agusti Gisela, Valles Roberto.
            </p>
        </div>
        
        <hr class="my-4">
        
        <h6 class="font-semibold text-[#1B7D8F] mb-2">Licencia</h6>
        <p class="text-xs text-justify text-gray-500">
            Este proyecto es software libre; usted puede redistribuirlo y/o modificarlo bajo los términos de la <strong>Licencia Pública General GNU (GPL)</strong> publicada por la Free Software Foundation.
        </p>
      </div>
      <div class="modal-footer bg-gray-50">
        <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>