<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function ShowAllBooks(){
       $author_book = DB::table('author_book')->select('id','book_id','author_id')->get();
       $authors = Author::all();
       //получаем все данные из таблицы книг
        $books = Book::all();
        return view('Books',['books' => $books, 'authors' => $authors, 'author_book' => $author_book]);
    }

    public function GetSortNameBooks(){
        //передаем данные так же как и в предыдущеи и последующим методе дляобработки в виде
        $author_book = DB::table('author_book')->select('id','book_id','author_id')->get();
        $authors = Author::all();
        //получаем отсортированные по имени данные
        $books = Book::orderBy('name')->get();
        return view('Books',['books' => $books, 'authors' => $authors, 'author_book' => $author_book]);
    }

    public function Search(Request $request){
        //получаем все данные промежуточной таблицы
        $author_book = DB::table('author_book')->select('id','book_id','author_id')->get();
        //получаем все данные таблицы авторов
        $authors = Author::all();
        //осуществляем поиск в базе по имени книги и автора
        $name = $request->name;
        $books = Book::whereHas('authors',function ($query) use($name){
            $query->where('name','LIKE','%'.$name.'%');
        })->orWhere('name','LIKE','%'.$request->name.'%')->get();

        return view('Books',['books' => $books,'authors' => $authors, 'author_book' => $author_book]);
    }

    public function Delete(Book $id){
        $id->delete();//думаю понятно))
        return redirect('/Books');
    }

    public function Update(Request $request){
        //проверка на заполнение имени
       // dump($request);
        $this->validate($request,[
            'name'=>'required|max:150'
        ]);

        //обновляем данные книги в таблице
        Book::where('id', $request->book_id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'public_date' => $request->public_date,
        ]);

        $authors = explode(" " , $request->author_id);//делаем вид ийдишников авторов удобнее преобразовав его из строки в массив
        $authors = array_unique($authors);//убераем повторяющихся авторов
        //удаляем старые связис с авторамииз промежуточной таблицы
        DB::table('author_book')->where('book_id', '=' , "$request->book_id")->delete();
        //добавляем новые
        foreach($authors as $author){
            DB::table('author_book')
                ->INSERT(['book_id' => "$request->book_id",
                    'author_id' => $author,
                    ]);
        }

        return redirect('/books');
    }
    //добавляем картинку
    public function AddImg(Request $request){
        $this->validate($request,[
            'img' => 'mimes:jpg,png|max:2048'//фильтр в соответствии с условиями
        ]);
        $path = $request->file('img')->store('uploads','public');
        Book::where('id',$request->id)->update([
            'img' => $path,
        ]);
        return redirect('/Books');
    }

    public function Add(Request $request){
        //проверка данных на обяязательное заполнение
        $this->validate($request,[
            'name'=>'required|max:150'
        ]);

//
//        $data['img'] = $path;
        //сохранение книги
        $data = $request->all();
        $Book = new Book;
        $Book->fill($data);
        $Book->save();
//получение ИД добавленной книги
        $Book = Book::where('name', $request->name)->first();
//добавление id авторов в промежуточную таблицу
        $authors = explode(" ",$request->author_id);//преображения полученной строки в массив
        foreach($authors as $author){
            DB::table('author_book')
                ->INSERT(['book_id' => "$Book->id",
                    'author_id' => $author,
                ]);
        }
        return redirect('/Books');
    }

}
