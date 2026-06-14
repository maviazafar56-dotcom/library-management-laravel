<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $table = 'shelfs';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Shelf_ID', 'Shelf_Location'
    ];

    /**
     * Get the books placed on this shelf.
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'Shelf_ID', 'Shelf_ID');
    }
}
