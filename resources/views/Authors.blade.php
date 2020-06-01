@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Authors</div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th><a href="{{route('ShowSortAuthors')}}">Authors&emsp;&emsp;</a></th>
                                <th><form name="search" action="{{route('SearchAuthors')}}">Search:<input name="name" required><button type="submit"><img src="images/search.png"></button></form></th>
                            </tr>
                            @forelse($authors as $author)
                                <tr>

                                    <td><a href="" id="{{$author->id}}" data-toggle="modal" data-target="#changeModal">{{$author->name}}&nbsp;{{$author->surname}}</a>&emsp;</td>
                                    <script type="text/javascript">
                                        $('document').ready(function () {
                                           $("#{{$author->id}}").on('click', function () {//при клике по ссылке с ид книги
                                               $('#author_id').val({{$author->id}}); //добавляем в форму ид текущей книги
                                           });
                                        });
                                    </script>
                                            <td>
                                        <form action="{{route('AuthorDelete',['id' => $author->id])}}" method="post">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            {{method_field('DELETE')}}
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                                <a class="btn btn-secondary" href="" data-toggle="modal" data-target="#addModal">Add author</a>&emsp;&emsp;

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel" >Add Author</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{route('AddAuthor')}}">
                    <div class="modal-body">
                        <label>Name*:</label>
                        <input name="name" required><br>
                        <label>Surname*:</label>
                        <input name="surname" required><br>
                        <label>Second name:</label>
                        <input name="second_name">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeModalLabel" >Update Author</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="{{route("UpdateAuthor")}}">
                    <div class="modal-body">
                        <label>Name*:</label>
                        <input name="name" required><br>
                        <label>Surname*:</label>
                        <input name="surname" required><br>
                        <label>Second name:</label>
                        <input name="second_name">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                    <input id="author_id" name="author_id" type="">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
