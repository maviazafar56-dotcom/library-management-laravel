<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name', 'Student_ID', 'Session', 'Contact_no', 'Email', 'Username', 'Password', 'Read', 'Confirmation_Code', 'Verify', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
    ];

    /**
     * Get the borrowing records for the student.
     */
    public function records()
    {
        return $this->hasMany(Record::class, 'Student_ID', 'Student_ID');
    }
}
