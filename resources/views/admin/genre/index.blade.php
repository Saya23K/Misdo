{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ジャンル一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>商品ジャンルの一覧です</h2>
                <div>期間限定商品</div>
                @foreach($limits as $limit)
                    <div>
                        <a href="{{route('genres.show', $limit->id)}}">{{ $limit->genre }}</a>
                    </div>
                    @foreach($limit->products as $product)
                        @if(isset( $product->img_path ))
                            <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="100" height="100">
                        @else
                            <img src="{{ secure_asset('storage/image/no_image.jpg') }}" width="100" height="100">
                        @endif
                    @endforeach
                @endforeach
                
                <div>レギュラー商品</div>
                @foreach($regulars as $regular)
                    <div>
                        <a href="{{route('genres.show', $regular->id)}}">{{ $regular->genre }}</a>
                    </div>
                    @foreach($regular->products as $product)
                        @if(isset( $product->img_path ))
                            <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="100" height="100">
                        @else
                            <img src="{{ secure_asset('storage/image/no_image.jpg') }}" width="100" height="100">
                        @endif
                    @endforeach
                @endforeach
                
                <div>販売終了</div>
                 @foreach($discontinuations as $discontinuation)
                    <div>
                        <a href="{{route('genres.show', $discontinuation->id)}}">{{ $discontinuation->genre }}</a>
                    </div>
                    @foreach($discontinuation->products as $product)
                        @if(isset( $product->img_path ))
                            <img src="{{ secure_asset('storage/product_img/' . $product->img_path ) }}" width="100" height="100">
                        @else
                            <img src="{{ secure_asset('storage/image/no_image.jpg') }}" width="100" height="100">
                        @endif
                    @endforeach
                @endforeach
                
                <div>販売終了商品(単発)</div>
                @foreach($endofsales as $endofsale)
                    @foreach($endofsale->products as $product)
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
                @endforeach
                
                
                
            </div>
        </div>
    </div>
@endsection