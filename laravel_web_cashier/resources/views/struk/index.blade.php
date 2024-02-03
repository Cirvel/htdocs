<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

<head>
    <title>Struk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="m-2">
    <!-- Navbar -->
    <header class="d-flex flex-column flex-md-row container-fluid align-items-center border-bottom pt-4 pb-3">
        <nav aria-label="breadcrumb" class="d-flex my-auto flex-wrap">
            <div class="d-flex me-3 navbar-brand my-auto ">
                <img src="/images/mon_256.png" alt="mon_256" class="navbar-toggler-icon">
                <h4 class="fs-4 ms-1 align-middle">CHASSEURS</h4>
            </div>
            <ol class="breadcrumb flex-row flex-wrap justify-content-around d-md-block d-none">
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/">Home</a></li>
                {{-- <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/struk">Struk</a></li> --}}
                <li class="btn active" aria-current="page">Struk</li>
                @if (auth()->user()->is_admin == 1) {{-- If user is admin, display these options --}}
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/users">Users</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/items">Items</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/categories">Categories</a></li>
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/registers">Registers</a></li>
                @endif
                <li class="btn"><a class="link-body-emphasis text-decoration-none" href="/logout">Logout</a></li>
            </ol>
            <div class="navbar-text ms-md-auto d-flex flex-row">
                <div class="dropdown d-md-none d-block open">
                    <button class="btn dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
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
    <div class="mt-3"></div>
    <h3>STRUK</h3>
    <!-- Nav -->
    <div class="bd-example m-0 border-0">
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-struk-tab" data-bs-toggle="tab" data-bs-target="#nav-struk"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-shopping-cart"></i> Cart</button>
                <button class="nav-link" id="nav-items-tab" data-bs-toggle="tab" data-bs-target="#nav-items"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                    tabindex="-1"><i class="fas fa-archive"></i> Catalog</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <!-- Tab Struk -->
            <div class="tab-pane fade active show" id="nav-struk" role="tabpanel" aria-labelledby="nav-struk-tab">
                <!-- Form -->
                <div class="container-lg card p-3">
                    <form class="form" method="POST" action="{{ route('struk.store') }}">
                        @csrf
                        @method('post')
                        <div class="d-md-flex mb-3 gap-2">
                            <label for="category-dropdown" class="form-label">Category</label>
                            <select class="form-select form-select-lg" name="category" id="category-dropdown">
                                @foreach ( $categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="item-dropdown" class="form-label">Item</label>
                            <select class="form-select form-select-lg" name="item" id="item-dropdown">
                                {{-- Use AJAX for dynamic item to category display --}}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="0" required>
                        </div>
                        <div>
                            <button class="btn btn-success d-md-inline d-none" type="submit">Add</button>
                            <button class="btn btn-success d-md-none d-inline" type="submit"><i class="fas fa-check"></i></button>
                            <button class="btn btn-danger d-md-inline d-none" type="reset" id="btr" id="btr">Clear</button>
                            <button class="btn btn-danger d-md-none d-inline" type="reset"><i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Table -->
                <div class="container mt-3">
                    <button class="btn btn-primary d-md-inline d-none"  data-bs-toggle="modal" data-bs-target="#checkoutModal" type="button"><i class="fas fa-print"></i> Checkout</button>
                    <button class="btn btn-primary d-md-none d-inline"  data-bs-toggle="modal" data-bs-target="#checkoutModal" type="button"><i class="fas fa-print"></i></button>
                    <button class="btn btn-danger d-md-inline d-none" id="flush-button" type="button"><i class="fas fa-toilet"></i> Flush</button>
                    <button class="btn btn-danger d-md-none d-inline" id="flush-button" type="button"><i class="fas fa-toilet"></i></button>
                </div>

                <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('struk.print') }}" onsubmit="return alert('Printing checkout...')">
                            @csrf
                            @method('post')
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="nickname" class="form-label">As</label>
                                <input type="text" name="nickname" id="nickname" class="form-control" value="{{ $nickname }}" readonly>
                                <label for="register" class="form-label">Register</label>
                                <select name="register" id="register" class="form-control">
                                    @foreach ( $registers as $register )
                                        <option value="{{ $register->designation }}">{{ $register->designation }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"  data-bs-dismiss="modal">Confirm</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="table-categories" class="table-responsive mt-3">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10ch;">#</th>
                                <th scope="col">Item</th>
                                <th scope="col">Cost</th>
                                <th scope="col" style="width: 10ch;">Amount</th>
                                <th scope="col">Total</th>
                                <th scope="col" style="width: 5ch;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ((array) session('cart') as $key => $product)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $product['item_name'] }}</td>
                                <td>Rp. {{ number_format($product['price']) }}</td>
                                <td>{{ $product['amount'] }}</td>
                                <td>Rp. {{ number_format($product['total']) }}</td>
                                <td>
                                    <form method="GET" action="{{ route('struk.remove') }}" onsubmit="return confirm('Confirm removal?')">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" value="{{ $key }}" name="id">
                                        <button id="cart_remove" type="submit" class="btn btn-danger mb-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Tab Catalog -->
            <div class="tab-pane fade" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab">
                <!-- Options -->
                <div class="container-fluid mt-3">
                    {{-- <form action=""> --}}
                        <div class="d-flex flex-wrap flex-grow-1 gap-2">
                            <div class="d-flex flex-grow-1">
                                <input class="form-control" type="text" name="search" id="search" title="Search engine">
                                <button type="submit" class="btn btn-info ms-2" name="search-button" id="search-button"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="d-md-flex d-flex flex-grow-1 gap-2">
                                <select class="form-select" name="filter" id="filter" title="Sort Order">
                                    <option value="id">Name</option>
                                    <option value="name" selected>Name</option>
                                    <option value="category_id">Category</option>
                                    <option value="price">Price</option>
                                    <option value="quantity">Quantity</option>
                                </select>
                                <select class="form-select" name="sort" id="sort" title="Sort Order">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
                <!-- Catalog -->
                <div class="border-top mt-3"></div>
                <div class="container-fluid mt-3">
                    <div class="row row-cols-1 row-cols-md-2 g-2 text-center" id="search_list">
                        @foreach ( $catalog as $item )
                            <div class="col card">
                                <div class="offcanvas-bottom d-flex">
                                    <p><b>{{ $item->name }}</b></p>
                                    <div class="ms-auto">
                                        <p>{{ $item->categoryFK->name }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <b>{{ $item->quantity }}x | Rp. {{ number_format($item->price,2) }}</b>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
        // Search engine
        $('#search-button').on('click',function(){
            var query = $('#search').val(); // Get search bar value
            var filter = $('#filter').val(); // Get selected filter value
            var sort = $('#sort').val(); // Get selected sort value
            $.ajax({ // Ajax script
                url: "{{ route('struk.search') }}", // Route
                type: "GET", // Method
                data: {'search':query,filter,sort}, 
                success:function(data){ // If process has no error..
                    $('#search_list').html(data); // Replace row display for data table
                }
            })
        })

        // Dropdown category refresh
        $('#category-dropdown').on('click',function(){
            var query = $(this).val(); // Get search bar value
            $.ajax({ // Ajax script
                url: "{{ route('struk.dropdown') }}", // Route
                type: "GET", // Method
                data: {'search':query}, 
                success:function(data){ // If process has no error..
                    $('#item-dropdown').html(data); // Replace display for data
                }
            })
        })

        $('#flush-button').on('click',function(){
            const yes = confirm('Confirm flush?');
            if (yes) {
                location.href = "{{ route('struk.flush') }}"
            }
        })

        $('#print-button').on('click',function(){
            alert('Cart printed');
            location.href = "{{ route('struk.print') }}"
        })

        dropdownStart();
        function dropdownStart(){
            var query = $('#category-dropdown').val(); // Get search bar value
            $.ajax({ // Ajax script
                url: "{{ route('struk.dropdown') }}", // Route
                type: "GET", // Method
                data: {'search':query}, 
                success:function(data){ // If process has no error..
                    $('#item-dropdown').html(data); // Replace display for data
                }
            })
        }
    })
</script>

</html>