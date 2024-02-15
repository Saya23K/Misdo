<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Genre;
use App\Models\Type;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        //登録されている商品の一覧を表示する
        
        $genres = Genre::with('products')->get();
        
        // dd($genres);
        
         return view('admin.product.index', compact('products', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新規に商品を登録する画面
        
        // ジャンルをGenreModelから参照
        $genres = Genre::all();
    
        // 区分をTypeModelから参照
        $types = Type::all();
        
        return view('admin.product.create', compact('genres', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 新規登録するシステム
        // バリデーション
        $this->validate($request, Product::$rules);
        
        $product = new Product;
        $form = $request->all();
        
        // 画像が送信された場合
        if (isset($form['image'])) {
            
            // 画像をproduct_imgに保存
            $path = $request->file('image')->store('public/product_img');
            $product->img_path = basename($path);
            
        // 画像が送信されなかった場合
        }else {
            $product->img_path = null;
        }
        
        // 送信された_tokenとimageを削除
        unset($form['_token']);
        unset($form['image']);
        
        $product->fill($form);
        $product->save();
        
        // 連続登録時にジャンルを選択しておきたいので$genre_idに値を入れてcompactで新規登録画面に飛ばす
        $genre_id = $puroduct->genre_id;
        
        return redirect('admin/product/create')->with(compact('genre_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //詳細見る（使用しない）
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //編集するページ
        return view('admin.product.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //編集したものを更新するシステム
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //削除するシステム
    }
}
