<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BenchmarkReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', 'evaluation_cycle_id', 'benchmark_type', 'scope_label',
        'org_avg_score', 'org_top_quartile', 'org_bottom_quartile',
        'benchmark_avg_score', 'benchmark_top_quartile', 'kpi_benchmarks',
        'period_start', 'period_end'
    ];

    protected function casts(): array
    {
        return [
            'kpi_benchmarks' => 'array',
            'period_start' => 'date',
            'period_end' => 'date',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function evaluationCycle(): BelongsTo
    {
        return $this->belongsTo(EvaluationCycle::class);
    }
}
