@extends('layouts.admin')

@section('title', 'Menu Preview | CupOfArc')
@section('header_title', 'Live Menu Overview')

@section('content')
<div class="max-w-6xl mx-auto space-y-10 pb-12">

    {{-- 1. Unang Loop para sa Mother Category (Coffee Based / Non-Coffee) --}}
    @forelse($categories as $parentType => $group)
        
        <div class="space-y-10 pt-6">
            {{-- Mother Category Header --}}
            <div class="flex items-center space-x-2">
                <div class="h-1 w-6 bg-orange-600 rounded-full"></div>
                <h2 class="text-sm font-black text-orange-600 uppercase tracking-[0.3em]">{{ $parentType }}</h2>
            </div>

            {{-- 2. Pangalawang Loop para sa mga Categories sa ilalim nun --}}
            @foreach($group as $category)
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
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse mr-1"></span>
                                            Available
                                        </span>
                                    @else
                                        <span class="text-[9px] font-bold text-red-400 uppercase italic text-center">Sold Out</span>
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
            @endforeach
        </div>

    @empty
        {{-- Kapag walang data --}}
        <div class="bg-white rounded-3xl p-20 text-center border border-gray-100 shadow-sm">
            <h3 class="text-2xl font-bold text-gray-800 mb-2 uppercase">No Menu Found</h3>
            <a href="/admin/categories" class="mt-4 inline-block bg-orange-600 text-white px-8 py-3 rounded-xl font-bold">Add Categories</a>
        </div>
    @endforelse

</div>
@endsection