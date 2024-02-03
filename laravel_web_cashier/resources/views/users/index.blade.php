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
            <ol class="breadcrumb flex-row flex-wrap justify-content-around d-md-block d-none">
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/">Home</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/struk">Struk</a></li>
                {{-- <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/users">Users</a></li> --}}
                <li class="btn active" aria-current="page">Users</li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/items">Items</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/categories">Categories</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/registers">Registers</a></li>
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
                        <a class="text-decoration-none" href="/logout">
                            <button class="dropdown-item"><i class="fas fa-sign-out"></i> Logout</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Body -->
    <div class="mt-3"></div>
    <h3>USERS</h3>
    <!-- Options -->
    <div class="container-fluid mt-3">
        {{-- <form action=""> --}}
            <div class="d-flex flex-wrap flex-grow-1 gap-2">
                <div class="d-flex flex-grow-1">
                    <input class="form-control" type="text" name="search" id="search" title="Search engine">
                    <button type="submit" class="btn btn-info ms-2" name="search-button" id="search-button"><i class="fas fa-search"></i></button>
                </div>
                <div class="d-md-flex d-flex flex-grow-1 gap-2">
                    <select class="form-select" name="filter" id="filter" title="Filter">
                        <option value="id">#</option>
                        <option value="username">Username</option>
                        <option value="nickname">Nickname</option>
                        <option value="email">Email</option>
                        <option value="is_admin">Is Admin</option>
                    </select>
                    <select class="form-select" name="sort" id="sort" title="Sort Order">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <a href="{{ route('users.create') }}">
                        <button type="button" class="btn btn-outline-success text-nowrap ms-2"><i class="fa fa-plus"></i><span class="d-none d-md-inline"> Add User</span></button>
                    </a>
                </div>
            </div>
        {{-- </form> --}}
    </div>
    <!-- Table -->
    <div class="table-responsive mt-3">
        <table class="table table-striped" id="search_list">
            <thead>
                <tr>
                    <th scope="col" style="width: 10ch;">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" style="width: 15ch;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $users_fetch as $user )
                    <tr>
                        <td scope="row">{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->nickname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin == 1)
                                {{-- If user is admin, display check --}}
                                <i class="fas fa-star fa-sm fa-fw"></i> Admin
                            @else
                                {{-- If user is not an admin, display cross --}}
                                <i class="fas fa-cash-register fa-sm fa-fw"></i> Cashier
                            @endif
                        </td>
                        <td>
                            @if (!auth()->id() == $user->id)
                                {{-- If row is the user, remove all option completely --}}
                                <form onsubmit="return confirm('Are you sure you want to delete this data?')" action="{{ route('users.destroy', ['user' => $user])}}" method="POST">
                                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="text-decoration-none">
                                        <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                    </a>
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                </form>
                            @else
                                {{-- If row is account, simply give logout option --}}
                                <a href="/logout">
                                    <button class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="d-none d-md-inline">Log out</span> </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Footer -->
    <footer class="container-fluid border-top p-4 mt-3">
        @ MIT License
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script>
    $(document).ready(function(){
        $('#search-button').on('click',function(){
            var query = $('#search').val(); // Get search bar value
            var filter = $('#filter').val(); // Get selected filter value
            var sort = $('#sort').val(); // Get selected sort value
            $.ajax({ // Ajax script
                url: "{{ route('users.search') }}", // Route
                type: "GET", // Method
                data: {'search':query,filter,sort}, 
                success:function(data){ // If process has no error..
                    $('#search_list').html(data); // Replace row display for data table
                }
            })
        })
    })
</script>

</html>