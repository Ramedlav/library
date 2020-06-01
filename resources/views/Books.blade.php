@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">books</div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th><a href="{{route('ShowSortBooks')}}">Books&emsp;&emsp;</a></th>
                                <th>
                                    <form name="search" action="{{route('SearchBooks')}}">
                                        Search:<input name="name" required>
                                        <button type="submit">
                                            <img src="images/search.png">
                                        </button>
                                        @csrf
                                    </form>
                                </th>
                            </tr>
                        @forelse($books as $book)
                                <tr>
                                    <td>
                                        @isset($book->img)
                                        <img src="{{ asset('/storage/'.$book->img) }}">
                                        @endisset
                                        <a href="" id="{{$book->id}}" data-toggle="modal" data-target="#changeModal">{{$book->name}}</a>
                                        <script type="text/javascript">
                                            $('document').ready(function () {
                                                $("#{{$book->id}}").on('click',function () {//при клике по ссылке с ид книги

                                                    $('#book_id').val({{$book->id}}); //добавляем в форму ид текущей книги

                                                    @forelse($author_book as $book_author)
                                                    if({{$book_author->book_id}} == {{$book->id}}){
                                                        $('#author_id').val($('#author_id').val()+' '+ "{{$book_author->author_id}}");
                                                    }
                                                    @endforeach

                                                });
                                                //очищаем скрытый инпут с ид авторов при закрытии модал.окна
                                                $("#changeModal").on('hidden.bs.modal',function () {
                                                    $("#author_id").val('');
                                                });
                                            });
                                        </script>
                                    </td>
                                    <td>
{{--                                        кнопка удаления книги--}}
                                        <form action="{{route('BookDelete',['id' => $book->id])}}" method="post">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route("AddImg")}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" name="img">
                                            </div>
                                            <input type="hidden" name="id" value="{{$book->id}}">
                                            <button class="btn btn-success" type="submit">send</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
{{--                                //кнопка вызова окна с формой добавления книги--}}
                                <a class="btn btn-secondary" href="" data-toggle="modal" data-target="#addModal">Add a new book</a>&emsp;&emsp;
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
{{--    //Окно обновления данных книги--}}
    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeModalLabel" >Update the book</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
{{--                //Форма обновления данных--}}
                <form id="updateForm" method="post" action="{{route("UpdateBook")}}">
                    <div class="modal-body">
                        {{csrf_field()}}
{{--                        //тут храним айди текущей книги--}}
                        <input type="hidden" name="book_id" id="book_id">
                        <label>Name*:</label>
{{--                        required--}}
                        <input name="name" id="name"><br>
                        <label>Description:</label>
                        <textarea name="description" ></textarea><br>
                        <label>publication date:</label>
                        <input name="public_date" type="date"><br>
                        <label>author:</label>
{{--                        //разварачиваем список авторов в селект--}}
                        <select id="author">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                        <a id="add_author" class="btn btn-success">add</a>
                        <table id="authors">
{{--                            //таблица авторов, для вида(её не отправляем с формой)--}}
                            <th>
                                Authors:
                            </th>
                        </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
            <input type="hidden" name="author_id" id="author_id">
            @csrf
            </form>
            </div>
        </div>
    </div>
{{--__________________________________________________________________________________________________--}}

{{--    окно добавления книги--}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" >Add a new book</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="addForm" method="post" action="{{route("AddBook")}}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label>Image:</label>
                        <input type="file" name="img"><br>
                        <label>Name*:</label>
                        <input name="name" required><br>
                        <label>Description:</label>
                        <textarea name="description" ></textarea><br>
                        <label>publication date:</label>
                        <input name="public_date"><br>
                        <label>author:</label>
                        <select id="a_author">
{{--___________________________________________________________________________________________________--}}
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                        <a id="a_add_author" class="btn btn-success">add</a>
                        <table id="a_authors">
                            <th>
                                Authors:
                            </th>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
{{--                    //тут храним ИД авторов книги--}}
                    <input type="hidden" name="author_id" id="a_author_id">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <script src="js/AddFormBook.js"></script>
    <script src="js/ChangeFormBook.js"></script>
@endsection
