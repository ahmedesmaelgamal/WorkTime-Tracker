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
                    @foreach ($projects as $project)
                        <th>{{ $project->name }}</th>
                        <th>{{ $project->start_date }}</th>
                        <th>{{ $project->end_date }}</th>
                        <th>{{ $project->total_days }}</th>
                        <th>{{ $project->total_employees }}</th>
                        <th>{{ $project->total_project_cost }}</th>
                    @endforeach
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
