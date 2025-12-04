<div id="t1" class="col-12">
  <div class="card shadow-sm">
    <div class="card-header">
      <strong>Table 1 — Employees</strong>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>salary</th>
              <th>hour cost</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employees as $employee)
              <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->salary }}</td>
                <td>{{ $employee->hour_cost }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
