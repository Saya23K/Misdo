<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    protected $casts = [
        'price' => 'integer',
        'type_id' => 'integer',
        'genre_id' => 'integer',
    ];
    

    public static $rules = array(
        'name' => 'required',
        'price' => 'required',
        'comment' => 'required',
        );
        
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
}
