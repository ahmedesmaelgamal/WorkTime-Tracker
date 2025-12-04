<div id="workTimesTable" class="col-12">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Work Times Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Project</th>
                            <th>Modul</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($workTimes) > 0)
                            @foreach($workTimes as $workTime)
                            <tr>
                                <td>{{ $workTime->date }}</td>
                                <td>{{ $workTime->employee_name }}</td>
                                <td>{{ $workTime->project_name }}</td>
                                <td>{{ $workTime->modul_name }}</td>
                                <td class="text-center">{{ $workTime->hours }}</td>
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
            <small>Showing {{ count($workTimes) }} work time records</small>
        </div>
    </div>
</div>