<div class="bg-white shadow-md p-4 flex justify-between items-center">
    <button class="md:hidden" onclick="document.getElementById('sidebar').classList.toggle('hidden')">
        ☰
    </button>
    <h1 class="text-lg font-bold" style="color: var(--primary-color);">@yield('title', 'MailWave')</h1>
    <div>
        {{-- <a href="{{ route('logout') }}" class="text-red-500">Logout</a> --}}
    </div>
</div>