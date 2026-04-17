<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'department_id', 'title', 'code', 'level', 'description', 'is_active',
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

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /** KPI weights configured specifically for this role (Section 5.1) */
    public function kpiWeights(): HasMany
    {
        return $this->hasMany(KpiWeight::class, 'scope_id')
                    ->where('scope', 'job_role');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    /** Promotions targeting this role as the next level */
    public function targetedByPromotions(): HasMany
    {
        return $this->hasMany(PromotionRecommendation::class, 'target_job_role_id');
    }

    public function currentPromotions(): HasMany
    {
        return $this->hasMany(PromotionRecommendation::class, 'current_job_role_id');
    }
}
