<div id="modulsTable" class="col-12">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Moduls Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Modul Name</th>
                            <th>Total Hours</th>
                            <th>Total Cost</th>
                            <th>Projects Used</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($moduls) && is_iterable($moduls) && count($moduls) > 0)
                            @foreach($moduls as $modul)
                            <tr>
                                <td>{{ $modul->id ?? 'N/A' }}</td>
                                <td><strong>{{ $modul->name ?? 'N/A' }}</strong></td>
                                <td class="text-center">{{ $modul->total_hours ?? 0 }}</td>
                                <td class="text-end">{{ $modul->total_cost ?? '$0.00' }}</td>
                                <td class="text-center">{{ $modul->total_projects ?? 0 }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-3 text-muted">
                                    <div class="alert alert-info mb-0">
                                        No modul data available
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>
                Showing {{ isset($moduls) && is_iterable($moduls) ? count($moduls) : 0 }} moduls
            </small>
        </div>
    </div>
</div>