<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeRanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'organization_id', 'evaluation_cycle_id', 'scope', 
        'scope_id', 'rank', 'total_in_scope', 'mq_score', 'percentile', 
        'performance_band', 'ranked_on'
    ];

    protected function casts(): array
    {
        return [
            'ranked_on' => 'date',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function evaluationCycle(): BelongsTo
    {
        return $this->belongsTo(EvaluationCycle::class);
    }

    // Scoped relationships
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'scope_id')
                    ->where('scope', 'team');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'scope_id')
                    ->where('scope', 'department');
    }
}
