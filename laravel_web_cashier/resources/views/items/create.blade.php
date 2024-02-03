<!DOCTYPE html>

<html lang="en" data-bs-theme="auto">

    <head>
        <title>Items</title>
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
            <form class="" method="POST" action="{{ route('items.store') }}">
                @csrf
                @method('post')
                <div class="mb-3 d-flex">
                    <h3 class="form-label">CREATE ITEM</h3>
                    <div class="ms-auto">
                        <a href="{{ route('items.index') }}">
                            <button type="button" class="btn btn-close"></button>
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category )
                            <option title="{{ $category->description }}"
                                value="{{ $category->id }}" 
                                >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Rupiah" required>
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