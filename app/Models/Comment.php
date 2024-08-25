<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    Protected $fillable = [
        'title',
        'description',
        'create_by_id',
        'updated_by_id',
    ]; 
}
