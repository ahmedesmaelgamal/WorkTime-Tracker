<div id="t2" class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <strong>Table 2 — Projects</strong>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                  <tr>
                        <th>#</th>
                        </th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                        <th>Total Employees</th>
                        <th>Total Project Cost</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->total_days }}</td>
                            <td>{{ $project->total_employees }}</td>
                            <td>{{ $project->total_project_cost }}</td>
                        </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
