<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultKpiScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_result_id', 'kpi_id', 'raw_score', 'weighted_score', 
        'weight_applied', 'max_score'
    ];

    // ── Relationships ────────────────────────────────────────────────────────

    public function assessmentResult(): BelongsTo
    {
        return $this->belongsTo(AssessmentResult::class);
    }

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(Kpi::class);
    }
}
