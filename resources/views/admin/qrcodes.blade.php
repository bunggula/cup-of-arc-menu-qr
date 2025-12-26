@extends('layouts.admin')

@section('title', 'QR Code Generator')
@section('header_title', 'Menu QR Code')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2 bg-slate-50 p-8 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-gray-200">
                <div class="bg-white p-4 rounded-2xl shadow-md border border-gray-100 mb-4" id="printableQR">
                    {!! QrCode::size(250)->backgroundColor(255, 255, 255)->color(234, 88, 12)->margin(2)->generate('https://ebony-unpropagable-amal.ngrok-free.dev/menu') !!}
                </div>
                <p class="text-xs text-gray-400 font-mono">Scan to view digital menu</p>
            </div>

            <div class="md:w-1/2 p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 text-orange-600 italic">CupOfArc Digital Menu</h3>
                    <p class="text-sm text-gray-500 italic text-balance">I-print ito at ilagay sa mga table para mabilis ma-scan ng mga customer.</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Target URL (Public)</label>
                        <div class="flex items-center px-4 py-3 bg-orange-50 rounded-xl border border-orange-100 text-orange-700 text-xs font-mono break-all">
                            https://ebony-unpropagable-amal.ngrok-free.dev/menu
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                    <a href="/admin/qrcodes/print" target="_blank" class="flex items-center justify-center space-x-2 bg-orange-600 text-white py-3 rounded-xl font-bold hover:bg-orange-700 transition shadow-md">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
    <span>Print QR</span>
</a>
                        
                        <a href="data:image/svg+xml;base64, {!! base64_encode(QrCode::size(500)->color(234, 88, 12)->generate('https://ebony-unpropagable-amal.ngrok-free.dev/menu')) !!}" 
                           download="cupofarc-menu-qr.svg" 
                           class="flex items-center justify-center space-x-2 bg-slate-800 text-white py-3 rounded-xl font-bold hover:bg-slate-900 transition shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span>Download</span>
                        </a>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                    <div class="flex space-x-3 text-blue-800">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <p class="text-xs italic leading-relaxed">
                            <strong>Testing Tip:</strong> After scanning, click <strong>"Visit Site"</strong> on the ngrok landing page to view your menu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection