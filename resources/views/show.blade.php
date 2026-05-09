<x-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="{{Storage::url($book->img)}}" class="img-fluid rounded shadow" alt="immagine libro" style="max-height: 250px" object-fit="cover">
            </div>
            <div class="col-md-8">
                <h1>{{ $book['titolo'] }}</h1>
                <h3>Autore : {{ $book['autore'] }}</h3>
                <p>ID libro : {{$book['id'] }}</p>
            </div>
            <div class="row">
                <form action="{{route('book.destroy', $book->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancella Libro</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>