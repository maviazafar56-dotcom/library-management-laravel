<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Student_ID', 'Book_ID', 'Collection_Date', 'Expired_Date', 'Submission_Date', 'Submission_Status', 'Fine', 'Read'
    ];

    /**
     * Get the student who borrowed the book.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'Student_ID', 'Student_ID');
    }

    /**
     * Get the book that was borrowed.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'Book_ID', 'Book_ID');
    }

    /**
     * Helper to calculate active fine.
     */
    public function calculateFine()
    {
        if ($this->Submission_Status === 'Yes') {
            $returnDate = strtotime($this->Submission_Date);
        } else {
            $returnDate = time();
        }

        $expiredDate = strtotime($this->Expired_Date);
        if ($expiredDate && $returnDate > $expiredDate) {
            $diff = $returnDate - $expiredDate;
            $days = ceil($diff / (60 * 60 * 24));
            return $days * 10; // Rs. 10 per day of delay
        }
        return 0;
    }

    /**
     * Accessor for Fine attribute.
     */
    public function getFineAttribute($value)
    {
        if ($this->Submission_Status === 'Yes') {
            return $value ?? 0;
        }

        if ($this->Submission_Status === 'Pending' && $this->Submission_Date) {
            $returnDate = strtotime($this->Submission_Date);
        } else {
            $returnDate = time();
        }

        $expiredDate = strtotime($this->Expired_Date);
        if ($expiredDate && $returnDate > $expiredDate) {
            $diff = $returnDate - $expiredDate;
            $days = ceil($diff / (60 * 60 * 24));
            return $days * 10; // Rs. 10 per day of delay
        }
        return 0;
    }
}
