<!-- resources/views/components/popup.blade.php -->

<!-- Fondo oscuro superpuesto (Overlay) -->
<div id="popup-overlay" class="fixed inset-0 bg-black/70 z-50 hidden flex items-center justify-center p-4 backdrop-blur-sm transition-opacity">
    
    <!-- Contenedor del Modal (Color Azul Bergara oscuro) -->
    <div class="bg-[#12243b] w-full max-w-md sm:max-w-lg rounded-lg shadow-2xl overflow-hidden relative transform transition-all">
        
        <!-- Botón de Cerrar -->
        <button onclick="closePopup()" class="absolute top-4 right-4 text-gray-300 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Cabecera -->
        <div class="px-8 pt-8 pb-4">
            <p class="text-[#8b2234] text-xs font-bold tracking-widest uppercase mb-1">Bergarako Antzoki Web</p>
            <h3 id="modal-title" class="text-2xl font-serif text-white">Hasi saioa</h3>
        </div>

        <!-- Pestañas de navegación -->
        <div class="flex border-b border-gray-600 px-8">
            <button onclick="switchTab('login')" id="tab-login" class="flex-1 py-3 text-sm font-bold border-b-2 border-[#8b2234] text-white transition">
                Saioa hasi
            </button>
            <button onclick="switchTab('register')" id="tab-register" class="flex-1 py-3 text-sm font-bold border-b-2 border-transparent text-gray-400 hover:text-gray-200 transition">
                Erregistratu
            </button>
        </div>

        <!-- Contenido del Formulario -->
        <div class="p-8">
            
            <!-- FORMULARIO DE LOGIN -->
            <form id="form-login" method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Emaila *</label>
                    <input type="email" name="email" required placeholder="zure@emaila.com" 
                        class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Pasahitza *</label>
                    <input type="password" name="password" required placeholder="Zure pasahitza" 
                        class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                </div>
                <button type="submit" class="w-full mt-6 bg-[#8b2234] hover:bg-[#701b2a] text-white font-bold py-3 rounded-md transition flex justify-center items-center gap-2">
                    Saioa hasi <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <!-- FORMULARIO DE REGISTRO -->
            <form id="form-register" method="POST" action="{{ route('register') }}" class="space-y-4 hidden">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Erabiltzaile izena *</label>
                    <input type="text" name="user_izena" required placeholder="Adib. maialen_g" 
                        class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-1">Izena *</label>
                        <input type="text" name="izena" required placeholder="Ane" 
                            class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-200 mb-1">Abizena *</label>
                        <input type="text" name="abizena" required placeholder="Aranburu" 
                            class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Emaila *</label>
                    <input type="email" name="email" required placeholder="ane@email.eus" 
                        class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Pasahitza *</label>
                    <input type="password" name="password" required placeholder="Gutxienez 8 karaktere" 
                        class="w-full px-4 py-2 bg-white text-gray-900 rounded-md focus:ring-2 focus:ring-[#8b2234] focus:outline-none">
                </div>
                <button type="submit" class="w-full mt-4 bg-[#8b2234] hover:bg-[#701b2a] text-white font-bold py-3 rounded-md transition flex justify-center items-center gap-2">
                    Kontua sortu <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</div>