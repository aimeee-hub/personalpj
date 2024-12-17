@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" id="category" name="type" required onchange="toggleOtherField()">
                                <option selected disabled>選択してください</option>
                                @foreach ($types as $type)
                                    <option value={{$type->id}}>{{ $type->name }}</option>
                                @endforeach
                                <option value="other">その他</option>
                            </select>

                            <div id="otherField" style="display: none; margin-top: 10px;">
                                <label for="other">その他種別:</label>
                                <input type="text" class="form-control" id="other" name="type-name">
                            
                                <label for="other">種別詳細:</label>
                                <input type="text" class="form-control" id="other" name="type-detail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>

                <script>
                    function toggleOtherField() {
                        const select = document.getElementById('category'); // 修正: 'options' → 'category'
                        const otherField = document.getElementById('otherField');
                        const otherInput = document.getElementById('other');

                        if (select.value === 'other') {
                            otherField.style.display = 'block';
                            otherInput.setAttribute('required', 'required');
                        } else {
                            otherField.style.display = 'none';
                            otherInput.removeAttribute('required');
                        }
                    }
                </script>

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
