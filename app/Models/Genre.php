<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static $rules = array(
        'genre' => 'required',
    );
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
}
