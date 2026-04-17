<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'name', 'code', 'description', 'head_user_id', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /** The user who heads this department */
    public function head(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_user_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function jobRoles(): HasMany
    {
        return $this->hasMany(JobRole::class);
    }

    public function kpiWeights(): HasMany
    {
        return $this->hasMany(KpiWeight::class, 'scope_id')
                    ->where('scope', 'department');
    }

    public function performanceHistory(): HasMany
    {
        return $this->hasMany(PerformanceHistory::class, 'scope_id')
                    ->where('scope', 'department');
    }
}
