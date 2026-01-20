<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @livewireStyles

    <style>
        body {
            background: #0f172a;
            color: #e5e7eb;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: #020617 !important;
            border-bottom: 1px solid #1e293b;
            z-index: 1050;
            /* para ficar acima do sidebar */
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 49px;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #020617;
            border-right: 1px solid #1e293b;
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            border-radius: 8px;
            padding: 10px 14px;
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background: #1e293b;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #6366f1;
            color: white;
        }

        /* Conteúdo */
        .content {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
            background: #0f172a;
            transition: margin-left 0.3s ease;
        }

        /* Cards */
        .card {
            background: #020617;
            border: 1px solid #1e293b;
            color: #ffffff;
            border-radius: 16px;
        }

        /* Forms */
        .form-control,
        .form-select {
            background: #020617;
            border: 1px solid #1e293b;
            color: #ffffff;
        }

        /* Tabela */
        .table {
            color: #ffffff;
        }

        .table thead {
            background: #020617;
        }

        .table tbody tr:hover {
            background: #1e293b;
        }

        /* botão hamburger */
        .navbar-toggler {
            border: none;
            background: none;
            font-size: 1.8rem;
            color: #ffffff;
        }

        /* sidebar escondida em mobile */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1040;
                position: fixed;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                transition: margin-left 0.3s;
            }
        }
    </style>
</head>

<body>


    {{-- MENU TOPO --}}
    <nav class="navbar navbar-expand-lg fixed-top px-4">
        <div class="container-fluid">
            <!-- Botão toggle padrão do Bootstrap -->
            <button class="navbar-toggler text-white" type="button" id="sidebarToggle">
                ☰
            </button>

            <div class="d-flex justify-content-center align-items-center text-center flex-grow-1">
                <h5 class="mb-0 text-primary">Dashboard</h5>
            </div>

            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#"
                    data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}"
                        class="rounded-circle me-2" width="40" height="40">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- SIDEBAR -->
    <nav class="sidebar" id="sidebar">
        <div class="p-3">
            <h4 class="mb-4 text-center border-bottom-1 p-3 border-danger text-primary">Menu</h4>
            <ul class="nav nav-pills flex-column gap-2">
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('clientes') }}" class="nav-link">Clientes</a></li>
                <li class="nav-item"><a href="{{ route('produtos') }}" class="nav-link">Produtos</a></li>
                <li class="nav-item"><a href="{{ route('servicos') }}" class="nav-link">Serviços</a></li>
            </ul>
        </div>
    </nav>


    <!-- CONTEÚDO -->
    <main class="content">
        {{ $slot }}
    </main>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
    </script>




    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('swal', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].icon,
                    confirmButtonColor: '#0d6efd',
                });
            });
        });
    </script>



    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openModal', data => {
                const modal = new bootstrap.Modal(document.getElementById('edite'));
                modal.show();
            });

            Livewire.on('closeModal', data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('edite'));
                if (modal) modal.hide();
            });
        });
    </script>




</body>

</html>
