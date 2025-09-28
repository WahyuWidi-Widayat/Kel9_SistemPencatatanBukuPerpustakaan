@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <p><strong>Genre:</strong> {{ $book->genre }}</p>
    <p>{{ $book->synopsis }}</p>

    <hr>

    <h3>Review</h3>
    @foreach($book->reviews as $review)
        <div class="mb-3 border p-3 rounded">
            <strong>{{ $review->user->name }}</strong> 
            <span>⭐ {{ $review->rating }}/5</span>
            <p>{{ $review->comment }}</p>
        </div>
    @endforeach

    @auth
    <hr>
    <h4>Tulis Review</h4>
    <form action="{{ route('reviews.store', $book->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating">Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label for="comment">Komentar</label>
            <textarea name="comment" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Review</button>
    </form>
    @endauth
</div>
@endsection
