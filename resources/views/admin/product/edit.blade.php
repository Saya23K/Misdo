{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '情報の編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>登録してある商品の編集ページです</h2>
                
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
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
                            <div>
                                ◆ジャンル選択
                            </div>
                            <div>
                                <select name="genre_id">
                                    @foreach ($genres as $genre)
                                        @if($product->genre_id === $genre->id)
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
                                @if ($product->type_id === $type->id)
                                    <input type="radio" name="type_id" value="{{ $type->id }}" checked>{{ $type->type }}商品
                                @else
                                    <input type="radio" name="type_id" value="{{ $type->id }}">{{ $type->type }}商品
                                @endif
                            @endforeach
                        </div>       
                        
                        <div>
                            <input type="text" name="name" value="{{ $product->name }}">
                        </div>
                        <div>
                            <input type="text" name="price" value="{{ $product->price }}">
                        </div>
                        <div>
                            <textarea name="comment" rows="6" cols="40">{{ $product->comment }}</textarea>
                        </div>
                        <div>
                            <div>
                                @if(isset( $product->img_path ))
                                <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="100" height="100">
                                <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                @endif
                            </div>
                            <input type="file" name="image" >
                            
                        </div>
                        
                    </div>
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                 @csrf
                 @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                        削除
                    </button>
                </form>
                
            </div>
        </div>
    </div>
@endsection