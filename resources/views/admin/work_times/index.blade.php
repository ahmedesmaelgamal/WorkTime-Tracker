
<div id="t3" class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <strong>Table 3 — Time Logs</strong>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-sm mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Date</th>
                    <th>Employee</th>
                    <th>Project</th>
                    <th>Hours</th>
                    <th>medul</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach ($workTimes as $workTime)
                    <td>{{ $workTime->date }}</td>
                    <td>{{ $workTime->employee->name }}</td>
                    <td>{{ $workTime->project->name }}</td>
                    <td>{{ $workTime->hours }}</td>
                    <td>{{ $workTime->modul->name }}</td>
                    @endforeach
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
