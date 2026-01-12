<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Site')</title>

     @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>


        <main>
            {{ $slot }}
        </main>
    
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
</body>
</html>