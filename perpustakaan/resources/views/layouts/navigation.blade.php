<nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('books.index') }}" class="font-bold text-lg">📚 Perpustakaan</a>

        <div class="flex space-x-4">
            @auth
                @if(auth()->user()->role === 'root')
                    <a href="{{ route('dashboard.root') }}">Root Dashboard</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}">Admin Dashboard</a>
                @else
                    <a href="{{ route('dashboard.user') }}">User Dashboard</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>
</nav>
