<header class="bg-white border-b border-gray-200 p-4 flex justify-between items-center sticky top-0 z-10">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="md:hidden mr-4 text-gray-600 focus:outline-none hover:text-orange-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <h2 class="text-xl font-bold text-gray-800">@yield('header_title')</h2>
    </div>
</header>