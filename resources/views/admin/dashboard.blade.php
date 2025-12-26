@extends('layouts.admin')

@section('title', 'Menu Preview | CupOfArc')
@section('header_title', 'Live Menu Overview')

@section('content')
<div class="max-w-6xl mx-auto space-y-10 pb-12">

    @forelse($categories as $category)
        <section>
            <div class="flex items-center justify-between mb-4 border-b-2 border-orange-100 pb-2">
                <div class="flex items-center space-x-3">
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight">{{ $category->name }}</h2>
                    <span class="bg-orange-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold uppercase">
                        {{ $category->items->count() }} Items
                    </span>
                </div>
                <a href="/admin/categories/{{ $category->id }}/items" class="text-xs font-bold text-orange-600 hover:underline italic">
                    Edit Category Content →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($category->items as $item)
                    <div class="bg-white p-3.5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition duration-300 relative overflow-hidden group min-h-[140px]">
                        
                        @if($item->is_best_seller)
                            <div class="absolute -right-14 top-3 bg-orange-500 text-white text-[7px] font-black py-0.5 w-40 transform rotate-45 text-center uppercase tracking-tighter shadow-sm">
                                Best Seller
                            </div>
                        @endif

                        <div>
                            <h3 class="font-bold text-gray-900 text-sm leading-tight group-hover:text-orange-600 transition mb-1">{{ $item->name }}</h3>
                            <p class="text-gray-500 text-[10px] line-clamp-2 italic mb-2 leading-relaxed">
                                {{ $item->description ?: 'No description available.' }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-2 border-t border-gray-50">
                            <span class="text-md font-black text-gray-800 tracking-tighter">₱{{ number_format($item->price, 2) }}</span>
                            
                            @if($item->is_available)
                                <span class="flex items-center text-[9px] font-bold text-green-600 uppercase">
                                    <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse mr-1"></span>
                                    Available
                                </span>
                            @else
                                <span class="text-[9px] font-bold text-red-400 uppercase italic">Sold Out</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-gray-400 text-sm italic text-center">Empty category. No items to display.</p>
                    </div>
                @endforelse
            </div>
        </section>
    @empty
        <div class="bg-white rounded-3xl p-20 text-center border border-gray-100 shadow-sm">
            <div class="mb-6 opacity-20">
                <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Menu Found</h3>
            <p class="text-gray-500 mb-8 max-w-xs mx-auto text-sm">You haven't added any categories or items yet. Let's start building your digital menu.</p>
            <a href="/admin/categories" class="inline-flex items-center justify-center px-8 py-3 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition shadow-lg shadow-orange-200">
                Create First Category
            </a>
        </div>
    @endforelse

</div>
@endsection