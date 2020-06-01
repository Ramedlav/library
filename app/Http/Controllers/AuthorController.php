<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;
use Phalcon\Mvc\View;

class AuthorController extends Controller
{
    public function ShowAllAuthors(){
        $authors = Author::all();
        return view('Authors',['authors' => $authors]);
    }

    public function GetSortNameAuthors(){
        $authors = Author::orderBy('surname')->get();
        return view('Authors',['authors' => $authors]);
    }

    public function Search(Request $request){
        $authors = Author::where('name','LIKE','%'.$request->name.'%')->orWhere('surname','LIKE','%'.$request->name.'%')->get();
//        var_dump($authors);
//        exit();
        return view('Authors',['authors' => $authors]);
    }

    public function Delete(Author $id){
        $id->delete();
        return redirect('/Authors');
    }
    public function Update(Request $request){
        $this->validate($request,[
            'name'=>'required|max:50',
            'surname'=>'required|max:50'
        ]);

        Author::where('id', $request->author_id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'second_name' => $request->second_name,
        ]);
        return redirect('/Authors');

    }
    public function Add(Request $request){
        $this->validate($request,[
            'name'=>'required|max:50',
            'surname'=>'required|max:50'
        ]);

        $data = $request->all();
        $Author = new Author;
        $Author->fill($data);
        $Author->save();

        return redirect('/Authors');
    }

}
