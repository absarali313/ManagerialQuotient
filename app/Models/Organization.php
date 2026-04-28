<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_user_id', 'name', 'slug', 'industry', 'logo_path', 'website', 'description',
        'license_type', 'max_users', 'license_starts_at', 'license_expires_at', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'license_starts_at'  => 'date',
            'license_expires_at' => 'date',
            'is_active'          => 'boolean',
            'max_users'          => 'integer',
        ];
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    /**
     * All employee accounts belonging to this org.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'organization_id')->where('user_type', 'employee');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function jobRoles(): HasMany
    {
        return $this->hasMany(JobRole::class);
    }

    public function kpis(): HasMany
    {
        return $this->hasMany(Kpi::class);
    }

    public function kpiWeights(): HasMany
    {
        return $this->hasMany(KpiWeight::class);
    }

    public function evaluationCycles(): HasMany
    {
        return $this->hasMany(EvaluationCycle::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function assessmentResults(): HasMany
    {
        return $this->hasMany(AssessmentResult::class);
    }

    public function performanceAlerts(): HasMany
    {
        return $this->hasMany(PerformanceAlert::class);
    }

    public function employeeRankings(): HasMany
    {
        return $this->hasMany(EmployeeRanking::class);
    }

    public function promotionRecommendations(): HasMany
    {
        return $this->hasMany(PromotionRecommendation::class);
    }

    public function managerNotes(): HasMany
    {
        return $this->hasMany(ManagerNote::class);
    }

    public function reportExports(): HasMany
    {
        return $this->hasMany(ReportExport::class);
    }

    public function benchmarkReports(): HasMany
    {
        return $this->hasMany(BenchmarkReport::class);
    }

    public function aiInsights(): HasMany
    {
        return $this->hasMany(AiInsight::class);
    }
}
