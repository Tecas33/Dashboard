<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 65px;
            left: 0;
            width: 250px;
            height: 100vh;
        }

        .sidebar .nav-link {
            color: #000000ff;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #0080ffff;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>


 {{-- MENU TOPO --}}
    <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-white  px-4">
        <div class="container-fluid">

            {{-- Título --}}
            <div class="justify-content-center align-items-center text-center">
                <h5 class="mb-0 text-primary">Dashboard</h5>
                {{-- <small class="text-muted">
                    Manage your project, tasks and Service
                </small> --}}
            </div>

            {{-- Perfil --}}
            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   href="#"
                   data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}"
                         class="rounded-circle me-2"
                         width="40" height="40">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">
                                Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

<!-- SIDEBAR -->
<nav class="sidebar bg-white ">
    <div class="p-3">
        <h4 class=" mb-4 text-center border-bottom-1 p-3 border-danger text-primary">Menu</h4>

        <ul class="nav nav-pills flex-column gap-2">
            <li class="nav-item">
                <a href="{{ route('dashboard')}}" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('clientes')}}" class="nav-link">Clientes</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('produtos')}}" class="nav-link">Produtos</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('servicos')}}" class="nav-link">Serviços</a>
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="nav-link">Relatórios</a>
            </li> -->
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
