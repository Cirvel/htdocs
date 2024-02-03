<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

    <head>
        <title>Users</title>
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
        </nav>
    </header>
    <!-- Body -->
    <div class="mt-3"></div>
    <!-- Creation -->
    <div class="mb-3"></div>
        <div class="container-md form-control mx-auto p-2">
            <form class="" method="POST" action="{{ route('users.update',$user->id) }}">
                @csrf
                @method('put')
                <div class="mb-3 d-flex">
                    <h3 class="form-label">EDIT USER</h3>
                    <div class="ms-auto">
                        <a href="/users">
                            <button type="button" class="btn btn-close"></button>
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username"
                    title="Original value: {{ $user->username }}"
                    value="{{ $user->username }}"
                    required>
                </div>
                {{-- <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" id="password"\
                    title="Original value: {{ $user->password }}"
                    value="{{ $user->password }}"
                    required>
                </div>   --}}
                <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" class="form-control" name="nickname" id="nickname"\
                    title="Original value: {{ $user->nickname }}"
                    value="{{ $user->nickname }}"
                    required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example123@here.com"
                    title="Original value: {{ $user->email }}"
                    value="{{ $user->email }}"
                    required>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin"
                        title="Original value: {{ $user->is_admin }}"
                        {{ $user->is_admin == 1 ? "checked" : "" }}>
                        <label for="is_admin">Is Admin</label>
                    </div>
                </div>
                
                <div>
                    <button class="btn btn-success d-md-inline d-none" type="submit">Submit</button>
                    <button class="btn btn-success d-md-none d-inline" type="submit"><i class="fas fa-check"></i></button>
                    <button class="btn btn-danger d-md-inline d-none" type="reset">Clear</button>
                    <button class="btn btn-danger d-md-none d-inline" type="reset"><i class="fas fa-trash"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class="container-fluid border-top p-4 mt-3">
        @ MIT License
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</html>