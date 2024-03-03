{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '情報の編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>登録してあるジャンルの編集ページです</h2>
                
                <form action="{{ route('genres.update', $genre->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div>
                            ◆タイプ選択
                        </div>
                        @foreach ($types as $type)
                            @if ($genre->type_id === $type->id)
                                <input type="radio" name="type_id" value="{{ $type->id }}" checked>{{ $type->type }}
                            @else
                                <input type="radio" name="type_id" value="{{ $type->id }}">{{ $type->type }}
                            @endif
                        @endforeach
                        <div>
                            <input type="text" name="genre" value="{{ $genre->genre }}">
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </form>
                    
            </div>
        </div>
    </div>
@endsection