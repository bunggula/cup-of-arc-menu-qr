<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform md:relative md:translate-x-0 transition duration-300 ease-in-out md:flex flex-col flex-shrink-0">
    
    <div class="p-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-orange-500">CupOfArc<span class="text-white"> Menu</span></h1>
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-4">
        <a href="/admin/dashboard" 
           class="flex items-center p-3 rounded-lg transition {{ request()->is('admin/dashboard*') ? 'bg-orange-600 text-white font-medium' : 'hover:bg-slate-800 text-slate-300' }}">
            <span>Menu Items</span>
        </a>

        <a href="/admin/categories" 
           class="flex items-center p-3 rounded-lg transition {{ request()->is('admin/categories*') ? 'bg-orange-600 text-white font-medium' : 'hover:bg-slate-800 text-slate-300' }}">
            <span>Categories</span>
        </a>

        <a href="/admin/qrcodes" 
   class="flex items-center p-3 rounded-lg transition {{ request()->is('admin/qrcodes*') ? 'bg-orange-600 text-white font-medium' : 'hover:bg-slate-800 text-slate-300' }}">
   <span>QR Codes</span>
</a>
<a href="/admin/feedbacks" 
   class="flex items-center p-3 rounded-lg transition {{ request()->is('admin/feedbacks*') ? 'bg-orange-600 text-white font-medium' : 'hover:bg-slate-800 text-slate-300' }}">
    <span>Customer Feedbacks</span>
</a>
<a href="/admin/faqs" 
   class="flex items-center p-3 rounded-lg transition {{ request()->is('admin/faqs*') ? 'bg-orange-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
    <span>Manage FAQs</span>
</a>
    </nav>

    <div class="p-4 border-t border-slate-800">
        <form action="/logout" method="POST">
            @csrf
            <button class="w-full text-left p-2 text-slate-400 hover:text-white transition">Logout</button>
        </form>
    </div>
</aside>

<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false" 
    class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
</div>