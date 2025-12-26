<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Cafe QR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-lg border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-orange-600 tracking-tight">CAFE<span class="text-slate-800">QR</span></h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Administrator Access</p>
        </div>
        <form action="/login" method="POST" class="space-y-6">
    @csrf <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
        <input type="email" name="email" placeholder="admin@cafe.com" required
            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
        <input type="password" name="password" placeholder="••••••••" required
            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all">
    </div>

    <button type="submit" 
        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-200 transition-all active:scale-95">
        Sign In
    </button>
</form>
        <div class="mt-8 text-center">
            <p class="text-slate-400 text-xs tracking-wide uppercase">Powered by Laravel 11 & Tailwind</p>
        </div>
    </div>

</body>
</html>