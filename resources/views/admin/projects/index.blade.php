@extends('admin.app')
@section('tables')
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
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>start data</th>
                    <th>end date </th>
                    <th>total days </th>
                    <th>total employees  </th>
                    <th>total project cost </th>
                  </tr>
                </thead>
                  <tbody>
                  <tr>
                      <td>1</td>
                      <td>Website Redesign</td>
                      <td>2025-10-05</td>
                      <td>2025-11-05</td>
                      <td>10</td>
                      <td>3</td>
                      <td>5500</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>Mobile App</td>
                      <td>2025-10-05</td>
                      <td>2025-11-05</td>
                      <td>10</td>
                      <td>3</td>
                      <td>5500</td>
                  </tr>
                  <tr>
                      <td>3</td>
                      <td>API Stabilization</td>
                      <td>2025-10-05</td>
                      <td>2025-11-05</td>
                      <td>10</td>
                      <td>3</td>
                      <td>5500</td>
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
