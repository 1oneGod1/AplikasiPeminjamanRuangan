<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relationship: RoomType has many Rooms
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'type', 'name');
    }

    /**
     * Scope: Get active room types only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
