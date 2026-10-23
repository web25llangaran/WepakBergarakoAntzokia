<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergarako Antzoki Web - Admin</title>
    <!-- Incluye Tailwind CSS (Asegúrate de tenerlo compilado con Vite/Mix o usa CDN para pruebas) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex h-screen font-sans antialiased overflow-hidden">

    <!-- Menú Lateral (Sidebar) -->
    <aside class="w-64 bg-[#1e242b] text-gray-300 flex flex-col justify-between">
        <!-- Top Menu -->
        <div>
            <!-- Logo y Título -->
            <div class="flex items-center gap-3 px-6 py-8 border-b border-gray-700">
                <div class="w-10 h-10 rounded-full border border-white flex items-center justify-center text-white font-bold text-sm">
                    BA
                </div>
                <div>
                    <h1 class="text-white font-serif font-bold text-lg leading-tight">Bergarako Antzoki Web</h1>
                    <span class="text-[#d4af37] text-xs font-semibold tracking-wider">ADMIN</span>
                </div>
            </div>

            <!-- Enlaces de Navegación -->
            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#8b2234] text-white rounded-md">
                    <i class="fa-solid fa-house w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-gray-800 rounded-md transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-calendar w-5 text-center"></i>
                        <span>Ekitaldiak</span>
                    </div>
                    <span class="bg-gray-600 text-xs text-white px-2 py-0.5 rounded-full">4</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-800 rounded-md transition">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span>Erabiltzaileak</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-800 rounded-md transition">
                    <i class="fa-solid fa-ticket w-5 text-center"></i>
                    <span>Sarrerak</span>
                </a>
            </nav>
        </div>

        <!-- Enlace Inferior -->
        <div class="p-4 border-t border-gray-700">
            <a href="{{ url('/') }}" class="flex items-center justify-between px-4 py-2 hover:bg-gray-800 rounded-md transition">
                <div class="flex items-center gap-3 text-blue-400">
                    <i class="fa-solid fa-globe w-5 text-center"></i>
                    <span>Publikora joan</span>
                </div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- Header Dinámico -->
        <header class="h-24 bg-white border-b border-gray-200 flex items-center justify-between px-10 shrink-0">
            <!-- Saludo -->
            <div>
                <p class="text-[#8b2234] text-xs font-bold tracking-widest uppercase mb-1">Administrazioa</p>
                <h2 class="text-3xl font-serif text-gray-900">
                    Egun on, {{ auth()->user()->user_izena }}
                </h2>
            </div>

            <!-- Perfil Usuario -->
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900">
                        {{ auth()->user()->user_izena }}
                    </p>
                    <p class="text-xs text-gray-500 capitalize">
                        {{ auth()->user()->rola === 'admin' ? 'Administratzailea' : 'Erabiltzailea' }}
                    </p>
                </div>
                <!-- Avatar dinámico -->
                <div class="w-12 h-12 rounded-full bg-[#8b2234] flex items-center justify-center text-white font-bold text-lg uppercase">
                    {{ substr(auth()->user()->user_izena, 0, 2) }}
                </div>
            </div>
        </header>

        <!-- Área de Contenido Dinámico -->
        <main class="flex-1 overflow-y-auto p-10">
            @yield('contentAdmin')
        </main>
        
    </div>
</body>
</html>