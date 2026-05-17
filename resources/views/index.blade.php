<x-layout>
    <div class="container">
    <h1 class="my-4">I nostri Libri</h1>
    <div class="row">
        
        @foreach ($books as $book)
        <div class="col-12 col-md-4 card mb-4 h-100 shadow">
            <img src="{{Storage::url($book->img)}}" class="card-img-top" style="height: 300px" object-fit="cover" alt="Copertina di {{$book->titolo}}">
            <div class="card-body">
                <h3>{{$book['titolo']}}</h3>
                <p>{{$book['autore']}}</p>
                <p>Libro inserito da : {{ $book->user->name }}</p>
                <a href="{{ route('book.show', ['id' => $book['id']])}}" class="btn btn-primary">dettaglio</a>
                @auth
                    @if($book->user_id === Auth::id())
                 <a href="{{ route('book.edit', ['id' => $book['id']])}}" class="btn btn-primary">modifica</a>
                    @endif
            
                @endauth
            </div>
        </div>
        @endforeach

    </div>
    </div>
</x-layout>