{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'タイトル'を埋め込む --}}
@section('title', '登録商品一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>登録してある商品の一覧を表示するページです</h2>
                
                <a href="{{ route('products.create') }}">新規登録</a>
                
                @foreach($genres as $genre)
                <table>
                <th colspan="4">{{ $genre->genre }}</th>
                     @foreach( $genre->products as $product)
                        @if($genre->id  === $product->genre_id)
                            <div>
                                <tr>
                                    <td rowspan = "2">
                                        @if($product->type_id === 1)
                                            限定
                                        @endif
                                    </td>
                                    
                                    <td rowspan = "2">
                                        <a href="{{route('products.edit', $product->id)}}">
                                        @if(isset( $product->img_path ))
                                        <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="150" height="150">
                                        @else
                                        <img src="{{ secure_asset('storage/image/no_image.jpg') }}" width="150" height="150">
                                        @endif
                                        </a>
                                    </td>
                                    
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        ￥{{ $product->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        {{ $product->comment }}
                                    </td>
                                
                                </tr>
                            </div>
                        @endif
                    @endforeach
                </table>
                @endforeach
                
            </div>
        </div>
    </div>
@endsection