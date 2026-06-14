<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Book_ID', 'Book_Name', 'Writer_Name', 'Shelf_ID', 'Amounts', 'Price', 'image'
    ];

    /**
     * Get the shelf where the book is located.
     */
    public function shelf()
    {
        return $this->belongsTo(Shelf::class, 'Shelf_ID', 'Shelf_ID');
    }

    /**
     * Get the borrowing records for the book.
     */
    public function records()
    {
        return $this->hasMany(Record::class, 'Book_ID', 'Book_ID');
    }
}
