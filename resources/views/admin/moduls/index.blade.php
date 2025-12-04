<div id="t1" class="col-12">
  <div class="card shadow-sm">
    <div class="card-header">
      <strong>Table 1 — Moduls</strong>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Modul Name</th>
              <th>Price</th>
              <th>Duration</th>

            </tr>
          </thead>
            <tbody>
              @foreach ($moduls as $modul)
                <tr>
                  <td>{{ $modul->id }}</td>
                  <td>{{ $modul->name }}</td>
                  <td>{{ $modul->price }}</td>
                  <td>{{ $modul->duration }}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
