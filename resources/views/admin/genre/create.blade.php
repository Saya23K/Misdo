{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ジャンル追加')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>商品のジャンルを新規登録するページです</h2>
                
                <form action="{{ route('genres.store') }}" method="POST">
                    @csrf
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
                        <!--初期値を期間限定商品に（id=1）-->
                        @if ($type->id===1)
                            <input type="radio" name="type_id" value="{{ $type->id }}" checked>{{ $type->type }}
                        @else
                            <input type="radio" name="type_id" value="{{ $type->id }}">{{ $type->type }}
                        @endif
                    @endforeach
                    
                    <div>
                        <input type="text" name="genre" placeholder="ジャンル入力(全角)">
                    </div>
                    
                    <input type="submit" value="登録">
                    
                    
                </form>
                
                
            </div>
        </div>
    </div>
@endsection