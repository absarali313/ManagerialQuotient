<?php

namespace App\Livewire\Org;

use App\Models\Department;
use App\Models\JobRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EmployeeForm extends Component
{
    public ?User $employee = null;

    public $name = '';
    public $email = '';
    public $phone = '';
    public $employee_id = '';
    public $department_id = '';
    public $job_role_id = '';
    public $is_active = true;
    public $system_role = 'employee';

    public function mount(?User $employee = null)
    {
        if ($employee && $employee->exists) {
            $this->employee = $employee;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->phone = $employee->phone;
            $this->employee_id = $employee->employee_id;
            $this->department_id = $employee->department_id;
            $this->job_role_id = $employee->job_role_id;
            $this->is_active = $employee->is_active;
            $this->system_role = $employee->system_role ?? 'employee';
        }
    }

    public function getDepartmentsProperty()
    {
        return Department::where('organization_id', $this->organizationId())->orderBy('name')->get();
    }

    public function getJobRolesProperty()
    {
        return JobRole::where('organization_id', $this->organizationId())->orderBy('title')->get();
    }

    private function organizationId()
    {
        $user = auth()->user();
        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->employee?->id)],
            'phone' => ['nullable', 'string', 'max:255'],
            'employee_id' => ['nullable', 'string', 'max:255'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'job_role_id' => ['nullable', 'exists:job_roles,id'],
            'is_active' => ['boolean'],
            'system_role' => ['required', 'in:employee,manager,hr,org_admin'],
        ];

        $validated = $this->validate($rules);
        $validated['organization_id'] = $this->organizationId();
        $validated['user_type'] = 'employee';

        if (! $this->employee || ! $this->employee->exists) {
            $validated['password'] = Hash::make(str()->random(12));
            $this->employee = User::create($validated);
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Employee {$this->employee->name} has been created.",
            ]);
        } else {
            $this->employee->update($validated);
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Employee {$this->employee->name} has been updated.",
            ]);
        }

        return redirect()->route('org-employees');
    }

    #[Layout('components.layouts.dashboard')]
    public function render()
    {
        return view('livewire.org.employee.employee-form');
    }
}
