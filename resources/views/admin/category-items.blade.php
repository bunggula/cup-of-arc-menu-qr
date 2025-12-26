@extends('layouts.admin')

@section('title', 'Manage Items | ' . $category->name)
@section('header_title', 'Items under ' . $category->name)

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ 
search: '',
    openEdit: false, 
    openDelete: false, 
    itemId: null, 
    itemName: '',
    itemPrice: '',
    itemDesc: '',
    itemBestSeller: false
}">
    <div class="mb-6">
        <a href="/admin/categories" class="flex items-center text-orange-600 font-bold hover:text-orange-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Categories
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 sticky top-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800 text-center">Add New Item</h3>
                <form action="/admin/categories/{{ $category->id }}/items" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Item Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Price (₱)</label>
                            <input type="number" name="price" step="0.01" required class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="2" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none"></textarea>
                        </div>
                        <div class="flex items-center p-3 bg-orange-50 rounded-xl border border-orange-100">
                            <input type="checkbox" name="is_best_seller" id="is_best_seller" value="1" class="w-5 h-5 text-orange-600 border-gray-300 rounded focus:ring-orange-500 cursor-pointer">
                            <label for="is_best_seller" class="ml-3 text-sm font-bold text-orange-800 cursor-pointer">🔥 Mark as Best Seller</label>
                        </div>
                        <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-xl font-bold hover:bg-orange-700 transition shadow-md">Save Item</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-model="search" 
                    placeholder="Search by name or description..." 
                    class="w-full pl-10 pr-4 py-3 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition shadow-sm"
                >
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
    <thead class="bg-gray-50 border-b">
        <tr>
            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase italic">Item Details</th>
            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center italic">Price</th>
            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right italic">Action</th>
            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center italic">Availability</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @forelse($items as $item)
            <tr class="hover:bg-gray-50 transition" 
            x-show="'{{ strtolower($item->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($item->description) }}'.includes(search.toLowerCase())">
                <td class="px-6 py-4">
                    <div class="font-bold text-gray-900">{{ $item->name }}</div>
                    <div class="text-xs text-gray-500">{{ $item->description }}</div>
                    @if($item->is_best_seller)
                        <span class="mt-1 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-orange-100 text-orange-800 uppercase italic">
                            🔥 Best Seller
                        </span>
                    @endif
                </td>

                <td class="px-6 py-4 text-center font-bold text-gray-700 italic">
                    ₱{{ number_format($item->price, 2) }}
                </td>

                <td class="px-6 py-4">
                    <div class="flex justify-end items-center space-x-4">
                        <button @click="openEdit = true; itemId = {{ $item->id }}; itemName = '{{ $item->name }}'; itemPrice = '{{ $item->price }}'; itemDesc = '{{ $item->description }}'; itemBestSeller = {{ $item->is_best_seller ? 'true' : 'false' }}" 
                                class="text-gray-500 hover:text-orange-600 transition" 
                                title="Edit Item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>

                        <button @click="openDelete = true; itemId = {{ $item->id }}; itemName = '{{ $item->name }}'" 
                                class="text-gray-400 hover:text-red-600 transition" 
                                title="Delete Item">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </td>

                <td class="px-6 py-4 text-center">
                    <form action="/admin/items/{{ $item->id }}/toggle-status" method="POST">
                        @csrf 
                        @method('PATCH')
                        <button type="submit" 
                                class="relative inline-flex h-5 w-10 items-center rounded-full transition-colors focus:outline-none {{ $item->is_available ? 'bg-orange-600' : 'bg-gray-300' }}">
                            <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform {{ $item->is_available ? 'translate-x-5' : 'translate-x-1' }}"></span>
                        </button>
                        <div class="text-[9px] mt-1 font-bold uppercase {{ $item->is_available ? 'text-green-600' : 'text-red-400 italic' }}">
                            {{ $item->is_available ? 'In Stock' : 'Sold Out' }}
                        </div>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">
                    No items found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
            </div>
        </div>
    </div>

    <div x-show="openEdit" class="fixed inset-0 z-[110] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="openEdit = false"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 italic text-orange-600">Edit Menu Item</h3>
                <form :action="'/admin/items/' + itemId" method="POST">
                    @csrf @method('PUT')
                    <div class="space-y-4">
                        <input type="text" name="name" x-model="itemName" class="w-full px-4 py-2 rounded-lg border border-gray-200">
                        <input type="number" name="price" x-model="itemPrice" step="0.01" class="w-full px-4 py-2 rounded-lg border border-gray-200">
                        <textarea name="description" x-model="itemDesc" class="w-full px-4 py-2 rounded-lg border border-gray-200"></textarea>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_best_seller" x-model="itemBestSeller" value="1" class="w-5 h-5 text-orange-600 rounded">
                            <label class="ml-2 text-sm font-bold text-gray-700 italic">Best Seller</label>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="openEdit = false" class="text-gray-500 font-bold italic">Cancel</button>
                        <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg font-bold shadow-md">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="openDelete" class="fixed inset-0 z-[110] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="openDelete = false"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full p-6 text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">!</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Item?</h3>
                <p class="text-gray-500 text-sm mb-6 italic">Are you sure you want to remove <span class="font-bold text-gray-800" x-text="itemName"></span>?</p>
                <div class="flex space-x-3">
                    <button @click="openDelete = false" class="flex-1 text-gray-500 font-bold italic">No</button>
                    <form :action="'/admin/items/' + itemId" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-bold shadow-md">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection