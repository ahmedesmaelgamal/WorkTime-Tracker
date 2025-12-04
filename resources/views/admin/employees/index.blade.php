@extends('admin.app')
@section('tables')
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
                  <tr>
                      <td>1</td>
                      <td>Alice Johnson</td>
                      <td>1000</td>
                      <td>10</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>Bob Smith</td>
                      <td>3000</td>
                      <td>20</td>
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
