@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Root</h1>
    <p>Halo, {{ auth()->user()->name }} (Root)!</p>

    <h3>Kelola Admin</h3>
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }} - {{ $user->role }}
                @if($user->role === 'user')
                    <form action="{{ route('users.makeAdmin', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Jadikan Admin</button>
                    </form>
                @elseif($user->role === 'admin')
                    <form action="{{ route('users.removeAdmin', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Cabut Admin</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
