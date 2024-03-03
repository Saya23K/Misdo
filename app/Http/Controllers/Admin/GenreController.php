<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Genre;
use App\Models\Product;
use App\Models\Type;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ジャンル一覧
        $limits = Genre::withWhereHas('products', function ($query) {
        $query->where('type_id', '!=', '3');
        })->where('type_id', '=', '1')->get();
        
        $regulars = Genre::withWhereHas('products', function ($query) {
        $query->where('type_id', '!=', '3');
        })->where('type_id', '=', '2')->get();
        
        // ジャンルごと販売終了
        $discontinuations = Genre::withWhereHas('products', function ($query) {
        $query->where('type_id', '=', '3');
        })->where('type_id', '=', '3')->get();
        
        // 特定商品のみ販売終了
        $endofsales = Genre::withWhereHas('products', function ($query) {
        $query->where('type_id', '=', '3');
        })->where('type_id', '!=', '3')->get();
        
        // dd($endofsales);
        
        return view('admin.genre.index' , compact('limits', 'regulars', 'discontinuations', 'endofsales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ジャンルを追加するページ
        
        // 区分をTypeModelから参照
        $types = Type::all();
        
        return view('admin.genre.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ジャンルを追加するシステム
        
        // バリデーション
        $this->validate($request, Genre::$rules);
        
        $genre = new Genre;
        $form = $request->all();
        
        // 送信された_tokenを削除
        unset($form['_token']);
        
        $genre->fill($form);
        $genre->save();
        
        
        return redirect('admin/genres/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ジャンルごとの一覧ページ
        $genre = Genre::with('products')->find($id);
        
        return view('admin.genre.show', compact('genre'));
        
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
        //指定したIDのレコードを取得
        $genre = Genre::find($id);
        $types = Type::all();
        
        
        return view('admin.genre.edit', compact('genre', 'types'));
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
        // 編集を更新するシステム
        $this->validate($request, Genre::$rules);
        $genre = Genre::with('products')->find($id);
        $revise = $request->all();
        
        // dd($genre->products);
        
        // 販売終了が選択されたらproductのtype_idも3(販売終了)にする
        if($request->type_id == 3){
            foreach($genre->products as $product){
                $product->type_id = '3';
                $product->save();
            }
        }
        
        unset($revise['_token']);
        
        $genre->fill($revise)->save();
        
        return redirect('admin/genres');
        
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
