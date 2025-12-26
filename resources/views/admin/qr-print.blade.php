<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print QR Code - CupOfArc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-12 rounded-lg shadow-lg text-center border-2 border-dashed border-gray-200" id="printArea">
        <h1 class="text-4xl font-black text-orange-600 mb-2">CupOfArc</h1>
        <p class="text-gray-500 mb-8 italic">Scan to View Our Digital Menu</p>
        
        <div class="inline-block border-8 border-orange-600 p-4 rounded-3xl mb-8">
            {!! QrCode::size(400)->margin(2)->generate('https://ebony-unpropagable-amal.ngrok-free.dev/menu') !!}
        </div>

        <p class="text-lg font-bold text-gray-800">Please scan with your phone camera</p>
        <p class="text-sm text-gray-400 mt-2 font-mono">https://ebony-unpropagable-amal.ngrok-free.dev/menu</p>
    </div>

    <div class="fixed bottom-8 right-8 space-x-4 no-print">
        <button onclick="window.print()" class="bg-orange-600 text-white px-6 py-3 rounded-full font-bold shadow-xl hover:bg-orange-700 transition">
            Print Now
        </button>
        <button onclick="window.close()" class="bg-gray-800 text-white px-6 py-3 rounded-full font-bold shadow-xl hover:bg-gray-900 transition">
            Close Page
        </button>
    </div>

</body>
</html>