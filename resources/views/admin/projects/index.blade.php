<div id="projectsTable" class="col-12">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Projects Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Days</th>
                            <th>Total Employees</th>
                            <th>Total Project Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($projects) > 0)
                            @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td><strong>{{ $project->name }}</strong></td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td class="text-center">{{ $project->total_days }}</td>
                                <td class="text-center">{{ $project->total_employees }}</td>
                                <td class="text-end">{{ $project->total_project_cost }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center py-3 text-muted">
                                    No project data available
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Showing {{ count($projects) }} projects</small>
        </div>
    </div>
</div>