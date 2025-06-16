<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Material UI Style Admin Dashboard - Bootstrap 5</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Toastfy -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <style>
    :root {
      --primary: #1976D2;
      --error: #E53935;
      --success: #43A047;
      --warning: #FBC02D;
      --secondary: #455A64;
      --surface: #fff;
      --background: #f5f6fa;
      --elevation-1: 0 1px 3px rgba(60,60,60,0.12), 0 1px 2px rgba(60,60,60,0.24);
      --elevation-2: 0 3px 6px rgba(60,60,60,0.16), 0 3px 6px rgba(60,60,60,0.23);
      --elevation-3: 0 10px 20px rgba(60,60,60,0.19), 0 6px 6px rgba(60,60,60,0.23);
    }
    body {
      background: var(--background);
      color: #222;
      min-height: 100vh;
      overflow-x: hidden;
    }
    .navbar-material {
      background: var(--surface);
      box-shadow: var(--elevation-1);
      border-bottom: none;
      position: sticky;
      top: 0;
      z-index: 1050;
      min-height: 64px;
      padding-top: 0.25rem;
      padding-bottom: 0.25rem;
    }
    .navbar-material .navbar-brand {
      font-weight: 700;
      color: var(--primary);
      letter-spacing: 1px;
    }
    .navbar-material .dropdown-menu {
      border-radius: 8px;
      box-shadow: var(--elevation-2);
    }
    .sidebar-material {
      position: sticky;
      top: 0;
      left: 0;
      height: 100vh;
      min-width: 220px;
      max-width: 220px;
      background: var(--surface);
      box-shadow: var(--elevation-1);
      transition: transform 0.2s cubic-bezier(.4,0,.2,1);
      z-index: 1040;
      display: flex;
      flex-direction: column;
      padding-top: 1rem;
      padding-bottom: 1rem;
    }
    .sidebar-collapsed {
      transform: translateX(-100%);
    }
    .sidebar-material .nav-link {
      color: #555;
      border-radius: 6px;
      font-weight: 500;
      transition: background 0.15s;
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0.75rem 1.25rem;
    }
    .sidebar-material .nav-link.active, .sidebar-material .nav-link:hover {
      background: rgba(25, 118, 210, 0.08);
      color: var(--primary);
    }
    .sidebar-material .nav-link i {
      font-size: 1.3rem;
    }
    .sidebar-header {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--primary);
      padding: 0 1.25rem 1rem 1.25rem;
      letter-spacing: 1px;
    }
    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.18);
      z-index: 1039;
    }
    @media (max-width: 991.98px) {
      .sidebar-material {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
      }
      .sidebar-overlay {
        display: block;
      }
    }
    .main-content {
      flex: 1 1 0%;
      min-width: 0;
      padding: 2rem 2.5vw;
      margin-left: 0px;
      margin-top: 64px;
      transition: margin-left 0.2s;
    }
    @media (max-width: 991.98px) {
      .main-content {
        margin-left: 0;
      }
    }
    .stat-card {
      background: var(--surface);
      border: none;
      border-radius: 14px;
      box-shadow: var(--elevation-1);
      padding: 1.5rem 1.25rem;
      transition: box-shadow 0.2s;
      position: relative;
      overflow: hidden;
      min-height: 110px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .stat-card .icon {
      font-size: 2.2rem;
      color: var(--primary);
      opacity: 0.13;
      position: absolute;
      right: 1rem;
      bottom: 1rem;
    }
    .table-material th {
      background: #f3f6f9;
      color: #555;
      font-weight: 600;
      border-bottom: 2px solid #e0e0e0;
    }
    .table-material td, .table-material th {
      vertical-align: middle;
    }
    .btn-material {
      position: relative;
      overflow: hidden;
      border-radius: 6px;
      font-weight: 500;
      letter-spacing: 0.5px;
      box-shadow: var(--elevation-1);
      transition: box-shadow 0.18s, background 0.18s;
    }
    .btn-material:active {
      box-shadow: var(--elevation-2);
    }
    .btn-primary {
      background: var(--primary) !important;
      border: none;
      color: #fff !important;
    }
    .btn-secondary {
      background: var(--secondary) !important;
      border: none;
      color: #fff !important;
    }
    .btn-danger {
      background: var(--error) !important;
      border: none;
      color: #fff !important;
    }
    .btn-success {
      background: var(--success) !important;
      border: none;
      color: #fff !important;
    }
    .btn-warning {
      background: var(--warning) !important;
      border: none;
      color: #fff !important;
    }
    /* Ripple effect */
    .ripple {
      position: absolute;
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.5s linear;
      background-color: rgba(255,255,255,0.5);
      pointer-events: none;
    }
    @keyframes ripple {
      to {
        transform: scale(2.5);
        opacity: 0;
      }
    }
    /* Floating label form */
    .form-material .form-floating > .form-control:focus ~ label,
    .form-material .form-floating > .form-control:not(:placeholder-shown) ~ label {
      opacity: 0.85;
      transform: scale(0.85) translateY(-1.2rem) translateX(0.15rem);
      color: var(--primary);
    }
    .form-material .form-floating > label {
      opacity: 0.6;
      transition: all 0.18s;
      background: transparent;
      padding: 0 0.25rem;
    }
    .form-material .form-floating > .form-control:focus {
      border: 1.5px solid var(--primary);
      box-shadow: none;
    }
    .form-material .form-floating > .form-control {
      border-radius: 6px;
      border-width: 1.5px;
      border-color: #bdbdbd;
      box-shadow: none;
      transition: border-color 0.18s;
    }
    /* Material Alerts, Badges, Modal */
    .alert-material {
      border: none;
      border-radius: 8px;
      box-shadow: var(--elevation-1);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .alert-primary { background: #e3f2fd; color: var(--primary); }
    .alert-danger { background: #ffebee; color: var(--error); }
    .alert-success { background: #e8f5e9; color: var(--success); }
    .alert-warning { background: #fffde7; color: #b28704; }
    .badge-material {
      border-radius: 6px;
      font-size: 0.85em;
      font-weight: 600;
      padding: 0.35em 0.7em;
      box-shadow: var(--elevation-1);
      background: #e3f2fd;
      color: var(--primary);
    }
    .badge-danger { background: #ffebee; color: var(--error); }
    .badge-success { background: #e8f5e9; color: var(--success); }
    .badge-warning { background: #fffde7; color: #b28704; }
    .modal-content {
      border-radius: 12px;
      box-shadow: var(--elevation-3);
      border: none;
    }
    .modal-header {
      border-bottom: none;
    }
    .modal-footer {
      border-top: none;
    }
    /* Scrollbar for sidebar */
    .sidebar-material {
      scrollbar-width: thin;
      scrollbar-color: #e0e0e0 #fff;
    }
    .sidebar-material::-webkit-scrollbar {
      width: 6px;
      background: #fff;
    }
    .sidebar-material::-webkit-scrollbar-thumb {
      background: #e0e0e0;
      border-radius: 6px;
    }
    @media (max-width: 991.98px) {
      .sidebar-material {
        min-width: 220px;
        max-width: 220px;
        z-index: 1040;
      }
      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-material navbar-expand-lg px-3 py-2">
    <button id="openSidebar" class="btn btn-outline-primary d-lg-none me-2 btn-material ripple-btn" type="button">
      <i class="bi bi-list"></i>
    </button>
    <span class="navbar-brand">Sinilam</span>
  </nav>
  <div class="d-flex">
    <!-- Sidebar -->
            <x-sidebar />
    <!-- Main content -->
    <main class="main-content">

                {{ $slot }}

    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sidebar toggle logic
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    function showSidebar() {
      sidebar.classList.remove('sidebar-collapsed');
      sidebarOverlay.style.display = 'block';
    }
    function hideSidebar() {
      sidebar.classList.add('sidebar-collapsed');
      sidebarOverlay.style.display = 'none';
    }
    openSidebar && openSidebar.addEventListener('click', showSidebar);
    closeSidebar && closeSidebar.addEventListener('click', hideSidebar);
    sidebarOverlay && sidebarOverlay.addEventListener('click', hideSidebar);
    // Responsive: auto-hide sidebar on resize
    window.addEventListener('resize', () => {
      if(window.innerWidth >= 992) {
        sidebar.classList.remove('sidebar-collapsed');
        sidebarOverlay.style.display = 'none';
      } else {
        sidebar.classList.add('sidebar-collapsed');
      }
    });
    // Initial state
    if(window.innerWidth < 992) {
      sidebar.classList.add('sidebar-collapsed');
    } else {
      sidebar.classList.remove('sidebar-collapsed');
    }
    // Ripple effect for Material buttons
    document.querySelectorAll('.ripple-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        const circle = document.createElement('span');
        circle.classList.add('ripple');
        const rect = btn.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        circle.style.width = circle.style.height = size + 'px';
        circle.style.left = (e.clientX - rect.left - size/2) + 'px';
        circle.style.top = (e.clientY - rect.top - size/2) + 'px';
        btn.appendChild(circle);
        setTimeout(() => circle.remove(), 500);
      });
    });
  </script>

    <!-- Toastfy -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>


        document.addEventListener('livewire:initialized', () => {

            Livewire.on('toast', ({ message, variant}) => {

                const backgroundColors = {
                    success: "#28a745",
                    error: "#dc3545",
                    warning: "#ffc107"
                };


                Toastify({
                    text: event.detail.message,
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: backgroundColors[variant] || "#343a40",
                    },
                }).showToast();

            });



            Livewire.on('deleteConfirmation', ({ message }) => {

                Swal.fire({
                    title: message,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch('deleteConfirmed');
                        }
                    });

            });

            Livewire.on('close-modal', ( {target} ) => {
                const modalElement = document.getElementById(target);
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();

            });

        });



        </script>


</body>
</html>
