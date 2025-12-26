<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CupOfArc | Menu</title>
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
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-pattern text-stone-900" x-data="{ faqOpen: false }">

@php
    // Dito mo pwedeng i-customize ang mga kulay na iikot sa categories mo
    $colorPalette = [
        ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-200', 'btn' => 'hover:bg-orange-600', 'tag' => 'bg-orange-100'],
        ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'btn' => 'hover:bg-blue-600', 'tag' => 'bg-blue-100'],
        ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200', 'btn' => 'hover:bg-emerald-600', 'tag' => 'bg-emerald-100'],
        ['bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'border-purple-200', 'btn' => 'hover:bg-purple-600', 'tag' => 'bg-purple-100'],
        ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-200', 'btn' => 'hover:bg-rose-600', 'tag' => 'bg-rose-100'],
    ];
@endphp

<header class="bg-white/90 backdrop-blur-xl sticky top-0 z-50 border-b border-stone-100 shadow-sm">
    <div class="pt-8 pb-4 px-6 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-black text-orange-600 tracking-tighter uppercase italic">
                Cup <span class="text-orange-600">Of</span> Arc
            </h1>
            <p class="text-stone-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-1">Specialty Coffee & Brews</p>
        </div>
    </div>
    
    <div class="flex space-x-2 overflow-x-auto px-6 pb-4 pt-2 no-scrollbar">
        @foreach($categories as $index => $category)
            @php $c = $colorPalette[$index % count($colorPalette)]; @endphp
            <a href="#cat-{{ $category->id }}" 
               class="whitespace-nowrap px-6 py-2.5 {{ $c['bg'] }} border {{ $c['border'] }} rounded-2xl text-[11px] font-extrabold {{ $c['text'] }} uppercase tracking-wider
                      {{ $c['btn'] }} hover:text-white active:scale-95 transition-all shadow-sm">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</header>

<main class="p-6 space-y-16">
    @foreach($categories as $index => $category)
        @php $c = $colorPalette[$index % count($colorPalette)]; @endphp
        
        <section id="cat-{{ $category->id }}" class="scroll-mt-40">
            <div class="flex items-center space-x-4 mb-8">
                <h2 class="text-2xl font-black {{ $c['text'] }} tracking-tight">{{ $category->name }}</h2>
                <div class="h-[1px] flex-1 bg-stone-200"></div>
            </div>

            <div class="grid gap-4">
                @foreach($category->items as $item)
                    <div class="group bg-white/70 hover:bg-white p-5 rounded-[2rem] border border-stone-100 hover:{{ $c['border'] }} hover:shadow-xl hover:shadow-orange-900/5 transition-all duration-500">
                        <div class="flex justify-between items-start">
                            <div class="flex-1 pr-4">
                                <div class="flex items-center flex-wrap gap-2 mb-1.5">
                                    <h3 class="font-bold text-lg text-stone-900 group-hover:{{ $c['text'] }} transition-colors">
                                        {{ $item->name }}
                                    </h3>
                                    @if($item->is_best_seller)
                                        <span class="text-[10px] {{ $c['tag'] }} {{ $c['text'] }} px-2 py-0.5 rounded-md uppercase font-black italic shadow-sm">🔥 Best Seller</span>
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
</main>

<section class="mt-12 px-6 pb-12">
    <div class="bg-white border border-stone-200 rounded-[2.5rem] p-8 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -z-0"></div>
        <div class="relative z-10">
            <h2 class="text-xl font-black text-stone-800 mb-1">How was your coffee?</h2>
            <p class="text-stone-400 text-[11px] mb-8 italic">Help us improve your Cup Of Arc experience.</p>

            <form action="/feedback" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest ml-1">Your Order</label>
                    <input type="text" name="order_item" placeholder="e.g. Iced Latte" 
                           class="w-full px-5 py-3.5 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:border-orange-200 focus:bg-white transition-all text-sm placeholder:text-stone-300 text-stone-700">
                </div>

                <div class="space-y-1">
                    <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest ml-1">Message</label>
                    <textarea name="message" rows="3" required placeholder="Share your thoughts..." 
                              class="w-full px-5 py-3.5 bg-stone-50 border border-stone-100 rounded-2xl focus:outline-none focus:border-orange-200 focus:bg-white transition-all text-sm placeholder:text-stone-300 text-stone-700"></textarea>
                </div>

                <button type="submit" class="w-full bg-stone-800 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl active:scale-[0.98] transition-all duration-300 shadow-md text-xs uppercase tracking-widest">
                    Send Feedback
                </button>
            </form>
        </div>
    </div>
</section>

<footer class="py-16 px-6 text-center">
    <div class="h-px w-12 bg-stone-300 mx-auto mb-8"></div>
    <p class="text-stone-400 text-[10px] font-black uppercase tracking-[0.4em] mb-2">CupOfArc Coffee Co.</p>
    <p class="text-stone-400 text-[10px] italic">Brewed with passion since 2025</p>
</footer>

@include('components.faq-modal')

</body>
</html>