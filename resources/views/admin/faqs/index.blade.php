@extends('layouts.admin')

@section('title', 'Manage FAQs')
@section('header_title', 'Frequently Asked Questions')

@section('content')
<div class="max-w-4xl mx-auto" x-data="{ 
    openEdit: false, 
    openDelete: false, 
    faqId: null, 
    faqQuestion: '',
    faqAnswer: ''
}">

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800">Add New FAQ</h3>
        <form action="/admin/faqs" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="question" placeholder="Question" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition">
                <input type="text" name="answer" placeholder="Answer" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none transition">
            </div>
            <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-orange-700 transition shadow-sm w-full md:w-auto">
                Save FAQ
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Question & Answer</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($faqs as $faq)
                <tr class="hover:bg-gray-50 transition text-sm">
                    <td class="px-6 py-4">
                        <p class="font-bold text-gray-900">{{ $faq->question }}</p>
                        <p class="text-gray-500 italic">{{ $faq->answer }}</p>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end items-center space-x-4">
                        <button @click="openEdit = true; faqId = {{ $faq->id }}; faqQuestion = '{{ addslashes($faq->question) }}'; faqAnswer = '{{ addslashes($faq->answer) }}'" 
                            class="text-gray-500 hover:text-orange-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>

                        <button @click="openDelete = true; faqId = {{ $faq->id }}; faqQuestion = '{{ addslashes($faq->question) }}'" 
                            class="text-gray-400 hover:text-red-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="openEdit" class="fixed inset-0 z-[110] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openEdit = false"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 transition-all">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Edit FAQ</h3>
                <form :action="'/admin/faqs/' + faqId" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                            <input type="text" name="question" x-model="faqQuestion" required
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
                            <textarea name="answer" x-model="faqAnswer" required rows="3"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-orange-500 outline-none"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="openEdit = false" class="px-4 py-2 text-gray-600 font-medium">Cancel</button>
                        <button type="submit" class="bg-orange-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-orange-700">Update FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div x-show="openDelete" class="fixed inset-0 z-[110] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="openDelete = false"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full p-6 text-center">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Are you sure?</h3>
                <p class="text-gray-500 mb-6 text-sm">Do you really want to delete this FAQ? <br> <span class="font-bold italic text-gray-800" x-text="faqQuestion"></span></p>
                <div class="flex justify-center space-x-3">
                    <button type="button" @click="openDelete = false" class="px-4 py-2 text-gray-600 font-medium flex-1">Cancel</button>
                    <form :action="'/admin/faqs/' + faqId" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 w-full transition">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection