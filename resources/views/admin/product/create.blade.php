{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '商品追加')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>商品を新規登録するページです</h2>
                
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        @endif
                        
                        <div>
                            <div>
                                ◆ジャンル選択
                            </div>
                            <div>
                                <select name="genre_id">
                                    @foreach ($genres as $genre)
                                        @if(session('genre_id') and session('genre_id') == $genre->id)
                                        <option value="{{ $genre->id }}" selected>{{ $genre->genre }}</option>
                                        @else
                                        <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <a href="{{ route('genres.create') }}">⇒ジャンル追加</a>
                            </div>
                        </div>

                        <div>
                            <div>
                                ◆タイプ選択
                            </div>
                            @foreach ($types as $type)
                                <!--初期値をレギュラー商品に（id=1）-->
                                @if ($type->id===1)
                                    <input type="radio" name="type_id" value="{{ $type->id }}" checked>{{ $type->type }}
                                @else
                                    <input type="radio" name="type_id" value="{{ $type->id }}">{{ $type->type }}
                                @endif
                            @endforeach
                        </div>       
                        
                        <div>
                            <input type="text" name="name" placeholder="商品名(全角)">
                        </div>
                        <div>
                            <input type="text" name="price" placeholder="金額(半角数字のみ)">
                        </div>
                        <div>
                            <textarea name="comment" rows="6" cols="40" placeholder="商品コメント"></textarea>
                        </div>
                        <div>
                            <input type="file" name="image" >
                        </div>
                        
                    </div>
                    
                    <input type="submit" value="登録">
                    
                    
                </form>
                
            </div>
        </div>
    </div>
@endsection