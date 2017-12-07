<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'first_name',
        'note',
        'likes',
    ];

    public function getPrev($id)
    {
        if ($id == 1) {
            return 1;
        } else {
            return $id - 1;
        }
    }

    public function getNext($id)
    {
        if ($id < $this->count()) {
            return $id + 1;
        } else {
            return $id;
        }
    }

}