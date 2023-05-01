<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 */
class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
