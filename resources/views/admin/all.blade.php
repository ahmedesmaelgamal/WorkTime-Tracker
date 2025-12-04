<!-- resources/views/admin/tables/all.blade.php -->
<div id="allDataTable" class="col-12">
    <!-- Employees Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Employees Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Salary</th>
                            <th>Hourly Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($employees) && count($employees) > 0)
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td><strong>{{ $employee->name }}</strong></td>
                                <td>${{ number_format($employee->salary, 2) }}</td>
                                <td>${{ number_format($employee->salary / 160, 2) }}/hr</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    No employee data available
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Showing {{ count($employees ?? []) }} employees</small>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <strong>Projects Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Total Hours</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($projects) && count($projects) > 0)
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><strong>{{ $project->name }}</strong></td>
                                <td>
                                    @php
                                        $totalHours = $project->workTimes->sum('hours') ?? 0;
                                    @endphp
                                    <span class="badge bg-primary">{{ number_format($totalHours, 1) }}</span>
                                </td>
                                <td>
                                    @php
                                        $totalCost = 0;
                                        if(isset($project->workTimes)) {
                                            foreach($project->workTimes as $workTime) {
                                                $hourlyRate = $workTime->employee->salary / 160;
                                                $totalCost += $workTime->hours * $hourlyRate;
                                            }
                                        }
                                    @endphp
                                    <span class="badge bg-success">${{ number_format($totalCost, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    No project data available
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Showing {{ count($projects ?? []) }} projects</small>
        </div>
    </div>

    <!-- Modules Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <strong>Modules Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Module Name</th>
                            <th>Total Hours</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($modules) && count($modules) > 0)
                            @foreach($modules as $module)
                            <tr>
                                <td>{{ $module->id }}</td>
                                <td><strong>{{ $module->name }}</strong></td>
                                <td>
                                    @php
                                        $totalHours = $module->workTimes->sum('hours') ?? 0;
                                    @endphp
                                    <span class="badge bg-primary">{{ number_format($totalHours, 1) }}</span>
                                </td>
                                <td>
                                    @php
                                        $totalCost = 0;
                                        if(isset($module->workTimes)) {
                                            foreach($module->workTimes as $workTime) {
                                                $hourlyRate = $workTime->employee->salary / 160;
                                                $totalCost += $workTime->hours * $hourlyRate;
                                            }
                                        }
                                    @endphp
                                    <span class="badge bg-success">${{ number_format($totalCost, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    No module data available
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Showing {{ count($modules ?? []) }} modules</small>
        </div>
    </div>

    <!-- Work Times Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <strong>Work Times Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Project</th>
                            <th>Module</th>
                            <th>Hours</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($workTimes) && count($workTimes) > 0)
                            @foreach($workTimes->take(20) as $workTime)
                            <tr>
                                <td>{{ $workTime->id }}</td>
                                <td>{{ $workTime->date->format('Y-m-d') }}</td>
                                <td>{{ $workTime->employee->name ?? 'N/A' }}</td>
                                <td>{{ $workTime->project->name ?? 'N/A' }}</td>
                                <td>{{ $workTime->modul->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $workTime->hours }}</span>
                                </td>
                                <td>
                                    @php
                                        $hourlyRate = $workTime->employee->salary / 160;
                                        $cost = $workTime->hours * $hourlyRate;
                                    @endphp
                                    <span class="badge bg-success">${{ number_format($cost, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-3 text-muted">
                                    No work time data available
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Showing {{ min(count($workTimes ?? []), 20) }} work time records (showing first 20)</small>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
    border-radius: 8px 8px 0 0 !important;
}

.table th {
    background-color: #f8f9fa;
    border-top: none;
    font-weight: 600;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85em;
}
</style>