<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get product name initial.
     *
     * @return string
     */
    public function getInitialAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initial = '';
        foreach ($words as $word)
            $initial .= $word[0];
        return strtoupper(substr($initial, 0, 2));
    }
}
