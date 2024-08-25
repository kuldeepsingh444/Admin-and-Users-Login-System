<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    Protected $fillable = [
        'title',
        'description',
         'image',
        'create_by_id',
        'updated_by_id',
    ]; 

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_by_id');
    }

    /**
     * Relationship with the user who updated the data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    /**
     * Override the boot method to automatically set create_by_id and updated_by_id fields.
     */
    protected static function boot()
    {
        parent::boot();

        // When creating a new instance, automatically set the create_by_id field
        static::creating(function ($data) {
            $data->create_by_id = auth()->id();
        });

        // When updating an instance, automatically set the updated_by_id field
        static::updating(function ($data) {
            $data->updated_by_id = auth()->id();
        });
    }

}
