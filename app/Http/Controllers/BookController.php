<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
   /* public $books = [
        
        ['id' =>1, 'titolo' => 'Il grande Gatsby', 'autore' => 'F. Scott Fitzgerald', 'img'=> 'https://m.media-amazon.com/images/I/818gYdgYmsL.jpg'],
         ['id' =>2, 'titolo' => '1984', 'autore' => 'George Orwell', 'img'=> 'https://giunti.it/cdn/shop/files/20260303_574c3db7cc734a82bd80ddab07c6d2ff.jpg?v=1772504486'],
        ['id' =>3, 'titolo' => 'Il piccolo Principe', 'autore' => 'Antoine de Saint-Exupery', 'img'=> 'https://www.feltrinellieditore.it/media/copertina/quarta/90/9788807901690_quarta.jpg.800x800_q75.jpg'],
       ['id' =>4, 'titolo' => 'Lo Hobbit', 'autore' => 'J.R.R. Tolkien', 'img'=> 'https://m.media-amazon.com/images/I/91VtuX46+nL._UF1000,1000_QL80_.jpg'],
    ]; */

public function index(){

$books = Book::all();
    return view('index' , ['books' => $books]);
}

public function show($id){
    $book = Book::find($id);
    if($book){
        return view('show', ['book' => $book]);
    }
    return redirect(route('home'))->with('error', 'Libro non trovato');
}

 public function contact_us () {
    return view('contact_us');
}

public function contact_us_send(Request $request){
    $user = $request->input('user');
    $email = $request->input('email');
    $message = $request->input('message');

    Mail::to($email)->send(new ContactMail($user, $email, $message));
  //  dd('email inviata con successo');
    return redirect(route('home'))->with('emailSent', 'Email inviata con successo');
}

public function create(){
    return view('book.create');

}

public function store(BookRequest $request){
    
    $book = Book::create([
        'titolo' => $request->input('titolo'),
        'autore' => $request->input('autore'),
        'published_year' => $request->input('published_year'),
        'img' => $request->file('img')->store('images', 'public'),
    ]);
        




    return redirect(route('home'))->with('success', 'Libro inserito con successo');

}

public function destroy($id){
    $book = Book::find($id);
    if($book){
        $book->delete();
        return redirect(route('home'))->with('success', 'Libro cancellato con successo');
    }
    return redirect(route('home'))->with('error', 'Libro non trovato');

}

public function edit($id){
    $book = Book::find($id);
    if($book){
        return view('book.edit', ['book' => $book]);
    }
    return redirect(route('home'))->with('error', 'Libro non trovato');
}

public function update(BookRequest $request, $id){
    $book = Book::find($id);
    if($book){
        $data = [
            'titolo'         => $request->input('titolo'),
            'autore'         => $request->input('autore'),
            'published_year' => $request->input('published_year'),
        ];

        if($request->hasFile('img')){
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        $book->update($data);
        return redirect(route('home'))->with('success', 'Libro modificato con successo');
    }
    return redirect(route('home'))->with('error', 'Libro non trovato');
}

}


