@extends('adminlte::page')

@section('title', '種別編集')

@section('content_header')
    <h1>種別編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
            <form action="{{ url('types/update', ['update_id' => $edit->id ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">種別</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$edit->name}}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{$edit->detail}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
            </form>

            <form action="{{ url('types/delete', ['delete_id' => $edit->id]) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？')">
                    @csrf
                    @method('DELETE')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">削除</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
