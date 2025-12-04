{{-- <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nami Soft Task </title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h1 class="mb-4">Nami Soft Task </h1>

    <!-- Controls -->
    <div class="row g-3 align-items-center mb-4">
      <div class="col-sm-6 col-md-4">
        <label for="tableSelect" class="form-label">Choose Project to display</label>
        <select id="tableSelect" class="form-select" aria-label="Select table">
          <option value="" selected>Choose</option>
          <option value="all" selected>All Projects</option>
          <option value="t1">Project 1 </option>
          <option value="t2">Project 2 </option>
          <option value="t3">Project 3 </option>
        </select>
      </div>

      <div class="col-auto">
        <label class="form-label d-block mb-1">&nbsp;</label>
        <button  class="btn btn-primary">Apply</button>
      </div>

      <div class="col-12 col-md-4 align-self-end">
        <small class="text-muted">Tip: choose a table and click <strong>Apply</strong> to show it.</small>
      </div>
    </div>

    <!-- Tables -->
    <div id="tablesContainer" class="row gy-4">
        @yield('tables')
    </div>

    <!-- small footer -->
    <footer class="mt-4">
      <small class="text-muted">Example layout — Bootstrap 5</small>
    </footer>
  </div>

  <!-- Bootstrap JS (requires Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

 <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

   
  </script>




<script>
$(document).ready(function() {
  // Apply Filter Button Click
  $('#applyFilter').click(function() {
    loadReportData();
  });

  // Load initial data
  loadReportData();

  // Function to load report data via AJAX
  function loadReportData() {
    const tableFilter = $('#tableSelect').val();
    
    if (!tableFilter) {
      alert('Please select a table to display');
      return;
    }

    showLoading(true);

    $.ajax({
      url: '{{ route("report.filter") }}',
      method: 'POST',
      data: {
        table_filter: tableFilter,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        if (response.success) {
          updateTable(response.data);
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

  // Function to update the table based on selected filter
  function updateTable(data) {
    const container = $('#tablesContainer');
    container.empty();

    if (!data || data.length === 0) {
      container.html('<div class="col-12"><div class="alert alert-info">No data found</div></div>');
      return;
    }

    // Create table based on data type
    const tableFilter = $('#tableSelect').val();
    let tableHtml = '';
    let tableName = '';

    switch(tableFilter) {
      case 'employees':
        tableName = 'Employees';
        tableHtml = createEmployeeTable(data);
        break;
      case 'projects':
        tableName = 'Projects';
        tableHtml = createProjectTable(data);
        break;
      case 'modules':
        tableName = 'Modules';
        tableHtml = createModuleTable(data);
        break;
      case 'work_times':
        tableName = 'Work Times';
        tableHtml = createWorkTimeTable(data);
        break;
      case 'all':
        tableName = 'All Data';
        tableHtml = createAllTables(data);
        break;
    }

    const cardHtml = `
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">${tableName}</h5>
          </div>
          <div class="card-body">
            ${tableHtml}
          </div>
        </div>
      </div>
    `;

    container.html(cardHtml);
  }

  // Helper function to create employee table
  function createEmployeeTable(employees) {
    let html = `
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Salary</th>
              <th>Hourly Rate</th>
            </tr>
          </thead>
          <tbody>
    `;

    employees.forEach(employee => {
      const hourlyRate = (employee.salary / 160).toFixed(2);
      html += `
        <tr>
          <td>${employee.id}</td>
          <td>${employee.name}</td>
          <td>$${employee.salary.toLocaleString()}</td>
          <td>$${hourlyRate}/hr</td>
        </tr>
      `;
    });

    html += `
          </tbody>
        </table>
      </div>
    `;

    return html;
  }

  // Helper function to create project table
  function createProjectTable(projects) {
    let html = `
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Project Name</th>
              <th>Total Hours</th>
            </tr>
          </thead>
          <tbody>
    `;

    projects.forEach(project => {
      const totalHours = project.total_hours || 0;
      html += `
        <tr>
          <td>${project.id}</td>
          <td>${project.name}</td>
          <td><span class="badge bg-primary">${totalHours.toFixed(1)}</span></td>
        </tr>
      `;
    });

    html += `
          </tbody>
        </table>
      </div>
    `;

    return html;
  }

  // Helper function to create module table
  function createModuleTable(modules) {
    let html = `
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Module Name</th>
              <th>Total Hours</th>
            </tr>
          </thead>
          <tbody>
    `;

    modules.forEach(module => {
      const totalHours = module.total_hours || 0;
      html += `
        <tr>
          <td>${module.id}</td>
          <td>${module.name}</td>
          <td><span class="badge bg-info">${totalHours.toFixed(1)}</span></td>
        </tr>
      `;
    });

    html += `
          </tbody>
        </table>
      </div>
    `;

    return html;
  }

  // Helper function to create work time table
  function createWorkTimeTable(workTimes) {
    let html = `
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Date</th>
              <th>Employee</th>
              <th>Project</th>
              <th>Module</th>
              <th>Hours</th>
            </tr>
          </thead>
          <tbody>
    `;

    workTimes.forEach(workTime => {
      html += `
        <tr>
          <td>${formatDate(workTime.date)}</td>
          <td>${workTime.employee?.name || 'N/A'}</td>
          <td>${workTime.project?.name || 'N/A'}</td>
          <td>${workTime.modul?.name || 'N/A'}</td>
          <td><span class="badge bg-primary">${workTime.hours}</span></td>
        </tr>
      `;
    });

    html += `
          </tbody>
        </table>
      </div>
    `;

    return html;
  }

  // Helper function to create all tables view
  function createAllTables(data) {
    let html = `
      <div class="row">
        <div class="col-md-6 mb-4">
          <h6>Employees Summary</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Employee</th>
                  <th>Total Hours</th>
                  <th>Cost</th>
                </tr>
              </thead>
              <tbody>
    `;

    // Employee summary
    if (data.employees) {
      data.employees.forEach(employee => {
        const totalHours = employee.total_hours || 0;
        const hourlyRate = employee.salary / 160;
        const totalCost = totalHours * hourlyRate;
        
        html += `
          <tr>
            <td>${employee.name}</td>
            <td>${totalHours.toFixed(1)}</td>
            <td>$${totalCost.toFixed(2)}</td>
          </tr>
        `;
      });
    }

    html += `
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="col-md-6 mb-4">
          <h6>Projects Summary</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Total Hours</th>
                </tr>
              </thead>
              <tbody>
    `;

    // Project summary
    if (data.projects) {
      data.projects.forEach(project => {
        const totalHours = project.total_hours || 0;
        html += `
          <tr>
            <td>${project.name}</td>
            <td>${totalHours.toFixed(1)}</td>
          </tr>
        `;
      });
    }

    html += `
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <h6>Recent Work Times</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Employee</th>
                  <th>Project</th>
                  <th>Hours</th>
                </tr>
              </thead>
              <tbody>
    `;

    // Recent work times
    if (data.work_times) {
      data.work_times.slice(0, 10).forEach(workTime => {
        html += `
          <tr>
            <td>${formatDate(workTime.date)}</td>
            <td>${workTime.employee?.name || 'N/A'}</td>
            <td>${workTime.project?.name || 'N/A'}</td>
            <td>${workTime.hours}</td>
          </tr>
        `;
      });
    }

    html += `
              </tbody>
            </table>
          </div>
        </div>
      </div>
    `;

    return html;
  }

  // Utility functions
  function formatDate(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
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
    // Create alert
    const alertHtml = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `;
    
    // Insert after the filter controls
    $('.row.g-3').after(alertHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
      $('.alert').alert('close');
    }, 5000);
  }
});
</script>
</body>
</html> --}}





<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Nami Soft Task</title>
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
  </style>
</head>
<body>
  <div class="container py-4">
    <h1 class="mb-4">Nami Soft Task - Work Time Management</h1>

    <!-- Controls -->
    <div class="row g-3 align-items-center mb-4">
      <div class="col-sm-6 col-md-4">
        <label for="tableSelect" class="form-label">Choose Data to display</label>
        <select id="tableSelect" class="form-select" aria-label="Select table">
          <option value="" selected>Choose</option>
          <option value="employees">Employees</option>
          <option value="projects">Projects</option>
          <option value="modules">Modules</option>
          <option value="work_times">Work Times</option>
          <option value="all">All Data Summary</option>
        </select>
      </div>

      <div class="col-auto">
        <label class="form-label d-block mb-1">&nbsp;</label>
        <button id="applyFilter" class="btn btn-primary">Apply</button>
      </div>

      <div class="col-12 col-md-4 align-self-end">
        <small class="text-muted">Tip: choose a table and click <strong>Apply</strong> to show it.</small>
      </div>
    </div>

    <!-- Tables Container -->
    <div id="tablesContainer" class="row gy-4">
      <!-- Data will be loaded here via AJAX -->
      <div class="col-12 text-center">
        <p class="text-muted">Select a data type and click Apply to see the information</p>
      </div>
    </div>

    <!-- small footer -->
    <footer class="mt-4">
      <small class="text-muted">Work Time Management System — Powered by Laravel</small>
    </footer>
  </div>

  <!-- Bootstrap JS (requires Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- AJAX Script -->
  <script>
  $(document).ready(function() {
    // Apply Filter Button Click
    $('#applyFilter').click(function() {
      loadReportData();
    });

    // Load initial data (optional)
    // loadReportData();

    // Function to load report data via AJAX
    function loadReportData() {
      const tableFilter = $('#tableSelect').val();
      
      if (!tableFilter) {
        alert('Please select a data type to display');
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
            updateTable(response.data);
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

    // Function to update the table based on selected filter
    function updateTable(data) {
      const container = $('#tablesContainer');
      container.empty();

      if (!data || (Array.isArray(data) && data.length === 0) || 
          (typeof data === 'object' && Object.keys(data).length === 0)) {
        container.html('<div class="col-12"><div class="alert alert-info">No data found</div></div>');
        return;
      }

      // Create table based on data type
      const tableFilter = $('#tableSelect').val();
      let tableHtml = '';
      let tableName = '';

      switch(tableFilter) {
        case 'employees':
          tableName = 'Employees';
          tableHtml = createEmployeeTable(data);
          break;
        case 'projects':
          tableName = 'Projects';
          tableHtml = createProjectTable(data);
          break;
        case 'modules':
          tableName = 'Modules';
          tableHtml = createModuleTable(data);
          break;
        case 'work_times':
          tableName = 'Work Times';
          tableHtml = createWorkTimeTable(data);
          break;
        case 'all':
          tableName = 'All Data Summary';
          tableHtml = createAllTables(data);
          break;
      }

      const cardHtml = `
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">${tableName}</h5>
            </div>
            <div class="card-body">
              ${tableHtml}
            </div>
          </div>
        </div>
      `;

      container.html(cardHtml);
    }

    // Helper function to create employee table
    function createEmployeeTable(employees) {
      let html = `
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Salary</th>
                <th>Hourly Rate</th>
              </tr>
            </thead>
            <tbody>
      `;

      employees.forEach(employee => {
        const hourlyRate = (employee.salary / 160).toFixed(2);
        html += `
          <tr>
            <td>${employee.id}</td>
            <td>${employee.name}</td>
            <td>$${employee.salary.toLocaleString()}</td>
            <td>$${hourlyRate}/hr</td>
          </tr>
        `;
      });

      html += `
            </tbody>
          </table>
        </div>
      `;

      return html;
    }

    // Helper function to create project table
    function createProjectTable(projects) {
      let html = `
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Total Hours</th>
              </tr>
            </thead>
            <tbody>
      `;

      projects.forEach(project => {
        const totalHours = project.total_hours || 0;
        html += `
          <tr>
            <td>${project.id}</td>
            <td>${project.name}</td>
            <td><span class="badge bg-primary">${totalHours.toFixed(1)}</span></td>
          </tr>
        `;
      });

      html += `
            </tbody>
          </table>
        </div>
      `;

      return html;
    }

    // Helper function to create module table
    function createModuleTable(modules) {
      let html = `
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Module Name</th>
                <th>Total Hours</th>
              </tr>
            </thead>
            <tbody>
      `;

      modules.forEach(module => {
        const totalHours = module.total_hours || 0;
        html += `
          <tr>
            <td>${module.id}</td>
            <td>${module.name}</td>
            <td><span class="badge bg-info">${totalHours.toFixed(1)}</span></td>
          </tr>
        `;
      });

      html += `
            </tbody>
          </table>
        </div>
      `;

      return html;
    }

    // Helper function to create work time table
    function createWorkTimeTable(workTimes) {
      let html = `
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Project</th>
                <th>Module</th>
                <th>Hours</th>
              </tr>
            </thead>
            <tbody>
      `;

      workTimes.forEach(workTime => {
        html += `
          <tr>
            <td>${formatDate(workTime.date)}</td>
            <td>${workTime.employee?.name || 'N/A'}</td>
            <td>${workTime.project?.name || 'N/A'}</td>
            <td>${workTime.modul?.name || 'N/A'}</td>
            <td><span class="badge bg-primary">${workTime.hours}</span></td>
          </tr>
        `;
      });

      html += `
            </tbody>
          </table>
        </div>
      `;

      return html;
    }

    // Helper function to create all tables view
    function createAllTables(data) {
      let html = `
        <div class="row">
          <div class="col-md-6 mb-4">
            <h6>Employees Summary</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Employee</th>
                    <th>Total Hours</th>
                    <th>Cost</th>
                  </tr>
                </thead>
                <tbody>
      `;

      // Employee summary
      if (data.employees) {
        data.employees.forEach(employee => {
          const totalHours = employee.total_hours || 0;
          const hourlyRate = employee.salary / 160;
          const totalCost = totalHours * hourlyRate;
          
          html += `
            <tr>
              <td>${employee.name}</td>
              <td>${totalHours.toFixed(1)}</td>
              <td>$${totalCost.toFixed(2)}</td>
            </tr>
          `;
        });
      }

      html += `
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="col-md-6 mb-4">
            <h6>Projects Summary</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Project</th>
                    <th>Total Hours</th>
                  </tr>
                </thead>
                <tbody>
      `;

      // Project summary
      if (data.projects) {
        data.projects.forEach(project => {
          const totalHours = project.total_hours || 0;
          html += `
            <tr>
              <td>${project.name}</td>
              <td>${totalHours.toFixed(1)}</td>
            </tr>
          `;
        });
      }

      html += `
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <h6>Recent Work Times</h6>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Employee</th>
                    <th>Project</th>
                    <th>Hours</th>
                  </tr>
                </thead>
                <tbody>
      `;

      // Recent work times
      if (data.work_times) {
        data.work_times.slice(0, 10).forEach(workTime => {
          html += `
            <tr>
              <td>${formatDate(workTime.date)}</td>
              <td>${workTime.employee?.name || 'N/A'}</td>
              <td>${workTime.project?.name || 'N/A'}</td>
              <td>${workTime.hours}</td>
            </tr>
          `;
        });
      }

      html += `
                </tbody>
              </table>
            </div>
          </div>
        </div>
      `;

      return html;
    }

    // Utility functions
    function formatDate(dateString) {
      if (!dateString) return 'N/A';
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
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
      // Create alert
      const alertHtml = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      `;
      
      // Insert after the filter controls
      $('.row.g-3').after(alertHtml);
      
      // Auto remove after 5 seconds
      setTimeout(() => {
        $('.alert').alert('close');
      }, 5000);
    }
  });
  </script>
</body>
</html>