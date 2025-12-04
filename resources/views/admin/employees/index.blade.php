<div id="employeesTable" class="col-12">
    <div class="card shadow-sm">
        <div class="card-header">
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
                        @if(count($employees) > 0)
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
            <small>Showing {{ count($employees) }} employees</small>
        </div>
    </div>
</div>