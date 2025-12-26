<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cafe QR Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans" x-data="{ 
    sidebarOpen: false,
    showToast: {{ session('success') ? 'true' : 'false' }}, 
    toastMessage: '{{ session('success') }}' 
}">

    <div x-init="if(showToast) { setTimeout(() => showToast = false, 3000) }"
         x-show="showToast"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed bottom-5 right-5 z-[110]"
         style="display: none;">
        
        <div class="bg-slate-900 text-white px-6 py-3 rounded-xl shadow-2xl border-l-4 border-orange-500 flex items-center space-x-3">
            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium" x-text="toastMessage"></span>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        
        @include('layouts.partials.sidebar')

        <main class="flex-1 flex flex-col overflow-y-auto min-w-0">
            @include('layouts.partials.header')

            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>