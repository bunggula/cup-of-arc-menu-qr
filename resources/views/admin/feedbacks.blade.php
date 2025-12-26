@extends('layouts.admin')

@section('title', 'Customer Feedbacks')
@section('header_title', 'Feedbacks & Comments')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Date</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Ordered Item</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Feedback</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($feedbacks as $feedback)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-500">{{ $feedback->created_at->format('M d, h:i A') }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-bold">
                        {{ $feedback->order_item ?? 'N/A' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-700 leading-relaxed">{{ $feedback->message }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No feedbacks yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection