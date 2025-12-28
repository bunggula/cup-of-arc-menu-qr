<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CupOfArc | Specialty Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .bg-pattern {
            background-color: #faf9f6;
            background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-pattern text-stone-900" x-data="{ 
    showLanding: true, 
    selectedMother: 'all', 
    faqOpen: false 
}">

    <template x-if="showLanding">
        <div x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-full"
             class="fixed inset-0 z-[100] bg-stone-900 flex flex-col items-center justify-center p-8 text-center">
            
            <div class="mb-8 animate-float">
                <div class="w-28 h-28 bg-gradient-to-tr from-orange-700 to-orange-500 rounded-[2.5rem] flex items-center justify-center shadow-2xl shadow-orange-900/40 rotate-3">
                    <svg class="w-14 h-14 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 8h1a4 4 0 1 1 0 8h-1"></path>
                        <path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"></path>
                        <line x1="6" y1="2" x2="6" y2="4"></line>
                        <line x1="10" y1="2" x2="10" y2="4"></line>
                        <line x1="14" y1="2" x2="14" y2="4"></line>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic mb-2">
                Cup <span class="text-orange-600">Of</span> Arc
            </h1>
            <p class="text-stone-400 text-[10px] font-bold uppercase tracking-[0.4em] mb-12">Specialty Coffee & Pastries</p>

            <button @click="showLanding = false" 
                    class="group relative px-12 py-4 bg-orange-600 rounded-full overflow-hidden transition-all active:scale-95">
                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                <span class="relative text-white font-black uppercase tracking-widest text-xs">Enter Menu</span>
            </button>

            <div class="absolute bottom-10 text-stone-600 text-[10px] uppercase tracking-widest">
                Urdaneta City, Ilocos Region
            </div>
        </div>
    </template>

    <div x-show="!showLanding && selectedMother === 'all'" 
         x-cloak 
         x-transition:enter="transition ease-out duration-500 delay-300"
         x-transition:enter-start="opacity-0 translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="min-h-screen flex flex-col p-6 max-w-lg mx-auto">
        
        <div class="mt-12 mb-10">
            <h2 class="text-4xl font-black text-stone-800 tracking-tight leading-none">What are you <br><span class="text-orange-600 italic">craving?</span></h2>
            <p class="text-stone-400 text-[10px] mt-4 uppercase tracking-[0.3em] font-bold">Choose a category to explore</p>

            <div class="mt-6 p-4 bg-orange-50 border-l-4 border-orange-500 rounded-r-2xl shadow-sm">
                <p class="text-[11px] font-black text-orange-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="flex h-2 w-2 rounded-full bg-orange-500"></span>
                    Ordering Guide
                </p>
                <p class="text-[10px] text-orange-700 leading-tight mt-1 italic font-medium">
                    This is a digital menu only. Please proceed to the cashier to place and pay for your order.
                </p>
            </div>
        </div>

        <div class="grid gap-4">
            @foreach($categories as $parentType => $group)
                <button @click="selectedMother = '{{ Str::slug($parentType) }}'" 
                    class="relative overflow-hidden bg-white border border-stone-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl active:scale-[0.98] transition-all text-left group">
                    
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-orange-600 uppercase tracking-[0.3em]">Specialty</span>
                        <h3 class="text-2xl font-black text-stone-800 mt-1">{{ $parentType }}</h3>
                        <p class="text-stone-400 text-xs italic mt-1">Discover our best-sellers</p>
                    </div>

                    <div class="absolute -right-6 -bottom-6 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity">
                        <svg class="w-40 h-40 text-stone-900" fill="currentColor" viewBox="0 0 24 24"><path d="M18.52 7H4.48L3.06 17h17.88l-1.42-10zM5.31 9h13.38l1.14 8H4.17l1.14-8zM12 2C8.13 2 5 5.13 5 9h2c0-2.76 2.24-5 5-5s5 2.24 5 5h2c0-3.87-3.13-7-7-7z"/></svg>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <div x-show="!showLanding && selectedMother !== 'all'" x-cloak>
        
        <header class="bg-white/90 backdrop-blur-xl sticky top-0 z-50 border-b border-stone-100 shadow-sm">
            <div class="pt-8 pb-4 px-6 flex justify-between items-center">
                <button @click="selectedMother = 'all'" class="p-2 -ml-2 text-stone-800 hover:text-orange-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div class="text-center">
                    <h1 class="text-xl font-black text-orange-600 tracking-tighter uppercase italic">Cup Of Arc</h1>
                    <p class="text-[9px] font-black text-stone-400 uppercase tracking-widest" x-text="selectedMother.replace('-', ' ')"></p>
                </div>
                <div class="w-10"></div> </div>
            
            <div class="flex space-x-3 overflow-x-auto px-6 pb-4 pt-2 no-scrollbar">
                @foreach($categories as $parentType => $group)
                    <template x-if="selectedMother === '{{ Str::slug($parentType) }}'">
                        <div class="flex space-x-3">
                            @foreach($group as $category)
                                <a href="#cat-{{ $category->id }}" 
                                   class="whitespace-nowrap px-6 py-2.5 bg-orange-100 border border-orange-200 rounded-2xl text-[11px] font-black text-orange-700 uppercase tracking-wider shadow-sm hover:bg-orange-600 hover:text-white hover:border-orange-600 active:scale-95 transition-all duration-200">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </template>
                @endforeach
            </div>
        </header>

        <main class="p-6 space-y-12 max-w-lg mx-auto">
            @foreach($categories as $parentType => $group)
                <div x-show="selectedMother === '{{ Str::slug($parentType) }}'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    
                    @foreach($group as $category)
                        <section id="cat-{{ $category->id }}" class="mb-16 scroll-mt-44">
                            <div class="flex items-center space-x-4 mb-8">
                                <h2 class="text-2xl font-black text-stone-800 tracking-tight">{{ $category->name }}</h2>
                                <div class="h-[1px] flex-1 bg-stone-200"></div>
                            </div>

                            <div class="grid gap-4">
                                @foreach($category->items as $item)
                                    <div class="group bg-white/70 p-5 rounded-[2rem] border border-stone-100 hover:border-orange-200 hover:shadow-xl hover:shadow-orange-900/5 transition-all duration-500">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1 pr-4">
                                                <div class="flex items-center flex-wrap gap-2 mb-1.5">
                                                    <h3 class="font-bold text-lg text-stone-900 group-hover:text-orange-600 transition-colors">
                                                        {{ $item->name }}
                                                    </h3>
                                                    @if($item->is_best_seller)
                                                        <span class="text-[10px] bg-orange-100 text-orange-600 px-2 py-0.5 rounded-md uppercase font-black italic shadow-sm">🔥 Best Seller</span>
                                                    @endif
                                                </div>
                                                @if($item->description)
                                                    <p class="text-sm text-stone-500 leading-relaxed italic font-medium">
                                                        {{ $item->description }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <span class="font-black text-stone-900 text-xl italic tabular-nums">₱{{ number_format($item->price, 0) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            @endforeach
        </main>

  

        <section class="mt-12 px-6 pb-20">
            <div class="bg-white border border-stone-200 rounded-[2.5rem] p-8 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -z-0"></div>
                <div class="relative z-10">
                    <h2 class="text-xl font-black text-stone-800 mb-1">How was your coffee?</h2>
                    <p class="text-stone-400 text-[11px] mb-8 italic">Help us improve your Cup Of Arc experience.</p>
                    <form action="/feedback" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="order_item" placeholder="Your Order (e.g. Iced Latte)" 
                               class="w-full px-5 py-3.5 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:border-orange-200 focus:bg-white transition-all text-sm">
                        <textarea name="message" rows="3" required placeholder="Share your thoughts..." 
                                  class="w-full px-5 py-3.5 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:border-orange-200 focus:bg-white transition-all text-sm"></textarea>
                        <button type="submit" class="w-full bg-stone-800 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl active:scale-[0.98] transition-all duration-300 shadow-md text-xs uppercase tracking-widest">
                            Send Feedback
                        </button>
                    </form>
                </div>
            </div>
            
            <footer class="mt-16 text-center">
                <div class="h-px w-12 bg-stone-300 mx-auto mb-8"></div>
                <p class="text-stone-400 text-[10px] font-black uppercase tracking-[0.4em] mb-2">CupOfArc Coffee Co.</p>
                <p class="text-stone-400 text-[10px] italic">Brewed with passion since 2025</p>
            </footer>
        </section>
    </div>
@include('components.faq-modal')
</body>
</html>