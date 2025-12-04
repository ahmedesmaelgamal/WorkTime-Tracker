<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Nami Soft Task - Work Time Management</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      transition: transform 0.2s;
      margin-bottom: 20px;
    }
    .card:hover {
      transform: translateY(-2px);
    }
    .badge {
      font-size: 0.85em;
    }
    .table th {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <h1 class="mb-4">Nami Soft Task - Work Time Management</h1>

    <div class="row g-3 align-items-center mb-4">
      <div class="col-sm-6 col-md-4">
        <label for="tableSelect" class="form-label">Choose Data to display</label>
        <select id="tableSelect" class="form-select" aria-label="Select table">
          <option value="" selected>Choose</option>
          <option value="employees">Employees</option>
          <option value="projects">Projects</option>
          <option value="moduls">Modules</option>
          <option value="work_times">Work Times</option>
          <option value="all">All Data Summary</option>
        </select>
      </div>

      <div class="col-auto">
        <label class="form-label d-block mb-1">&nbsp;</label>
        <button id="applyFilter" class="btn btn-primary">Apply</button>
      </div>

      <div class="col-12 col-md-4 align-self-end">
        <small class="text-muted">Tip: choose a data type and click <strong>Apply</strong> to show it.</small>
      </div>
    </div>

    <div id="tablesContainer" class="row gy-4">
      <div class="col-12 text-center">
        <p class="text-muted">Select a data type and click Apply to see the information</p>
      </div>
    </div>
    <footer class="mt-4">
      <small class="text-muted">Work Time Management System — Powered by Laravel</small>
    </footer>
  </div>

  <!-- Bootstrap JS (requires Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
  $(document).ready(function() {
    $('#applyFilter').click(function() {
      loadTableData();
    });
    function loadTableData() {
      const tableFilter = $('#tableSelect').val();
      
      if (!tableFilter) {
        alert('Please select a table to display');
        return;
      }

      showLoading(true);

      $.ajax({
        url: '{{ route("admin.report.filter") }}',
        method: 'POST',
        data: {
          table_filter: tableFilter,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.success) {
            $('#tablesContainer').html(response.html);
          } else {
            showError('Failed to load data: ' + response.message);
          }
        },
        error: function(xhr, status, error) {
          showError('Error loading data: ' + error);
        },
        complete: function() {
          showLoading(false);
        }
      });
    }

    function showLoading(show) {
      const button = $('#applyFilter');
      if (show) {
        button.html('<span class="spinner-border spinner-border-sm"></span> Loading...');
        button.prop('disabled', true);
      } else {
        button.html('Apply');
        button.prop('disabled', false);
      }
    }

    function showError(message) {
      const alertHtml = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
      
      $('.row.g-3').after(alertHtml);
      
      setTimeout(() => {
        $('.alert').alert('close');
      }, 5000);
    }
  });
  </script>


<script>
$(document).ready(function() {
    $('#applyFilter').click(function() {
        loadTableData();
    });

    function loadTableData() {
        const tableFilter = $('#tableSelect').val();
        
        if (!tableFilter) {
            alert('Please select a table to display');
            return;
        }

        showLoading(true);

        $.ajax({
            url: '{{ route("admin.report.filter") }}',
            method: 'POST',
            data: {
                table_filter: tableFilter,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#tablesContainer').html(response.html);
                } else {
                    showError('Failed to load data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
              console.log(error);
                showError('Error loading data: ' + error);
            },
            complete: function() {
                showLoading(false);
            }
        });
    }

    function showLoading(show) {
        const button = $('#applyFilter');
        if (show) {
            button.html('<span class="spinner-border spinner-border-sm"></span> Loading...');
            button.prop('disabled', true);
        } else {
            button.html('Apply');
            button.prop('disabled', false);
        }
    }

    function showError(message) {
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('.row.g-3').after(alertHtml);
        
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>
</body>
</html>