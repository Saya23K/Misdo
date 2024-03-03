{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ジャンル詳細')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ジャンルごとに一覧を表示するページです</h2>
                
                <div>
                    <a href="{{route('genres.edit', $genre->id)}}">{{ $genre->genre }}</a>
                </div>
                
                @foreach($genre->products as $product)
                    <table width="80%" border="1">
                        <tbody>
                            <tr>
                                <td rowspan="2">
                                    @if(isset( $product->img_path ))
                                        <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="100" height="100">
                                    @else
                                        <img src="{{ secure_asset('storage/image/no_image.jpg') }}" width="100" height="100">
                                    @endif
                                </td>
                                <th>{{ $product->name }}</th>
                                <td>￥{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{ $product->comment }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                @endforeach
                
                
                
                
                
                
                
            </div>
        </div>
    </div>
@endsection                