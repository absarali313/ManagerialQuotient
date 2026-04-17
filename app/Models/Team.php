<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'department_id', 'name', 'description', 'manager_user_id', 'is_active',
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

    /** The manager leading this team */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function kpiWeights(): HasMany
    {
        return $this->hasMany(KpiWeight::class, 'scope_id')
                    ->where('scope', 'team');
    }

    public function employeeRankings(): HasMany
    {
        return $this->hasMany(EmployeeRanking::class, 'scope_id')
                    ->where('scope', 'team');
    }
}
