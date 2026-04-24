<?php

namespace App\Models;

use App\Models\LetterType;
use Illuminate\Database\Eloquent\Model;

class GuestBook extends Model
{
    protected $fillable = [
        'name',
        'institution',
        'purpose',
        'phone',
        'visit_date',
        'created_by',
        'letter_type_id',
        'custom_letter_type',
        'letter_number'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function letterType()
    {
        return $this->belongsTo(LetterType::class);
    }
}
