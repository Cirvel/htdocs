<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

    <head>
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body class="m-2">
    <!-- Navbar -->
    <header class="d-flex flex-column flex-md-row container-fluid align-items-center border-bottom pt-4 pb-3">
        <nav aria-label="breadcrumb" class="d-flex my-auto flex-wrap">
            <div class="d-flex me-3 navbar-brand my-auto">
                <img src="/images/mon_256.png" alt="mon_256" class="navbar-toggler-icon">
                <h4 class="fs-4 ms-1 align-middle">CHASSEURS</h4>
            </div>
            <ol class="breadcrumb flex-row flex-wrap justify-content-around d-md-block d-none">
                {{-- <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/">Home</a></li> --}}
                <li class="btn active" aria-current="page">Home</li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/struk">Struk</a></li>
                @if (auth()->user()->is_admin == 1) {{-- If user is admin, display these options --}}
                    <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/users">Users</a></li>
                    <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/items">Items</a></li>
                    <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/categories">Categories</a></li>
                    <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/registers">Registers</a></li>
                @endif
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/logout">Logout</a></li>
            </ol>
            <div class="navbar-text ms-md-auto d-flex flex-row ">
                <div class="dropdown d-md-none d-block open">
                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        id="triggerId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fa fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="text-decoration-none" href="/">
                            <button class="dropdown-item"><i class="fas fa-home"></i> Home</button>
                        </a>
                        <a class="text-decoration-none" href="/struk">
                            <button class="dropdown-item"><i class="fas fa-credit-card"></i> Struk</button>
                        </a>
                        @if (auth()->user()->is_admin == 1) {{-- If user is admin, display these options --}}
                            <a class="text-decoration-none" href="/users">
                                <button class="dropdown-item"><i class="fas fa-users"></i> Users</button>
                            </a>
                            <a class="text-decoration-none" href="/items">
                                <button class="dropdown-item"><i class="fas fa-box"></i> Items</button>
                            </a>
                            <a class="text-decoration-none" href="/categories">
                                <button class="dropdown-item"><i class="fas fa-tags"></i> Categories</button>
                            </a>
                            <a class="text-decoration-none" href="/registers">
                                <button class="dropdown-item"><i class="fas fa-cash-register"></i> Registers</button>
                            </a>
                        @endif
                        <a class="text-decoration-none" href="/logout">
                            <button class="dropdown-item"><i class="fas fa-sign-out"></i> Logout</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Body -->
    <div class="body mt-3">
        <div class="text-center text-uppercase">
            <h3>WELCOME, {{ $nickname }}!</h3>
            @if (auth()->user()->is_admin)
                <p>Admin</p>
            @else    
                <p>Cashier</p>
            @endif
        </div>
        
        <h1>CHASSEURS</h1>
        <p>Your finest versatile store.</p>
        <div class="card p-1">
            <h2>PROFICIENCY</h2>
            <p>Our employee are graceful, polite, and always ready to lend a hand.</p>
            <h2>EFFICIENCY</h2>
            <p>Our clerk and their co-workers are working fast and effective yet still maintain quality.</p>
            <h2>ECONOMIC</h2>
            <p>Our product provides more while costing less, don't ask how we managed to do it.</p>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="container-fluid border-top p-4 mt-3">
        @ MIT License
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>