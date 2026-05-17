<x-layout>
    <div class="container-fluid align-items-center">
        <h1>Profilo di: {{ Auth::user()->name }}</h1>
        <p>Email: {{ Auth::user()->email }}</p>
        @forelse (Auth::user()->books as $book)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->titolo }}</h5>
                    <p class="card-text">Autore: {{ $book->autore }}</p>
                </div>
            </div>
        @empty
            <p>Non hai ancora aggiunto libri al tuo profilo.</p>
            <a href="{{ route('book.create') }}" class="btn btn-primary">Inserisci il tuo primo libro</a>
        @endforelse
    </div>  
</x-layout>