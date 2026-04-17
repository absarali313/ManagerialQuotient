<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KpiWeight extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'kpi_id', 'scope', 'scope_id', 'weight', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'weight' => 'integer',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(Kpi::class);
    }

    // Since scope/scope_id replaces polymorphic relations, 
    // we define explicit methods for each supported scope.

    public function jobRole(): BelongsTo
    {
        return $this->belongsTo(JobRole::class, 'scope_id')
                    ->where('scope', 'job_role');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'scope_id')
                    ->where('scope', 'department');
    }
}
