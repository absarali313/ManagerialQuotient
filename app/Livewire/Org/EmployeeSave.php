<?php

namespace App\Livewire\Org;

use App\Models\Department;
use App\Models\JobRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EmployeeSave extends Component
{
    public ?User $employee = null;

    public string $name = '';

    public string $email = '';

    public ?string $phone = null;

    public ?string $employeeId = null;

    public ?int $departmentId = null;

    public ?int $jobRoleId = null;

    public bool $isActive = true;

    public string $systemRole = 'employee';

    public ?string $password = null;

    public function mount(?User $employee = null): void
    {
        if ($employee && $employee->exists) {
            $this->employee = $employee;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->phone = $employee->phone;
            $this->employeeId = $employee->employee_id;
            $this->departmentId = $employee->department_id;
            $this->jobRoleId = $employee->job_role_id;
            $this->isActive = $employee->is_active;
            $this->systemRole = $employee->system_role ?? 'employee';
        }
    }

    public function getDepartmentsProperty(): Collection
    {
        return Department::where('organization_id', $this->organizationId())->orderBy('name')->get();
    }

    public function getJobRolesProperty(): Collection
    {
        return JobRole::where('organization_id', $this->organizationId())->orderBy('title')->get();
    }

    private function organizationId(): int
    {
        $user = auth()->user();

        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function save(): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->employee?->id)],
            'phone' => ['nullable', 'string', 'max:255'],
            'employeeId' => ['nullable', 'string', 'max:255'],
            'departmentId' => ['nullable', 'exists:departments,id'],
            'jobRoleId' => ['nullable', 'exists:job_roles,id'],
            'isActive' => ['boolean'],
            'systemRole' => ['required', 'in:employee,manager,hr,org_admin'],
            'password' => [$this->employee && $this->employee->exists ? 'nullable' : 'required', 'string', 'min:8'],
        ];

        $validated = $this->validate($rules);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'employee_id' => $validated['employeeId'],
            'department_id' => $validated['departmentId'],
            'job_role_id' => $validated['jobRoleId'],
            'is_active' => $validated['isActive'],
            'system_role' => $validated['systemRole'],
            'organization_id' => $this->organizationId(),
            'user_type' => 'employee',
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if (! $this->employee || ! $this->employee->exists) {
            $this->employee = User::create($data);
            session()->flash('success', "Employee $this->name has been created.");
        } else {
            $this->employee->update($data);

            session()->flash('success', "Employee $this->name has been updated.");
        }

        $this->redirectRoute('org_employees_edit', ['employee' => $this->employee->id], navigate: true);
    }

    public function render(): View
    {
        return view('livewire.org.employee.employee-save');
    }
}
