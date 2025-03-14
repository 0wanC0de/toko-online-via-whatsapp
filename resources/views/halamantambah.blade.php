<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('halamantambah.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
    <title>halaman</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="sidebar" data-aos="fade-down">
        <div class="sidebar-container">
            <!-- Logo -->
            <div class="navbar-logo">
                <h1 class="logo-text">
                    </i> FlashStore
                </h1>
                <!-- AOS JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
                <script>
                    AOS.init({
                        duration: 1000, // Durasi animasi
                        once: true, // Animasi hanya sekali saat di-scroll
                    });
                </script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                    crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                </script>
            </div>

            <!-- Navigation Menu -->
            <ul class="sidebar-menu">
                <li><a href="/"><i class="bi bi-house-fill"></i>Beranda</a></li>
                <li><a href="/"><i class="bi bi-bag-fill"></i> Produk</a></li>
                <li>
                    <a href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda"
                        target="_blank">
                        <i class="bi bi-telephone-fill"></i> Hubungi
                    </a>
                </li>
                <li><a href="/keranjang" class="cart-button"><i class="bi bi-cart-fill"></i> Keranjang</a></li>
                <li><a href="{{ route('dashboard') }}"><i class="bi bi-person-circle"></i>Dashboard</a></li>
                <li>
                    <div class="logout-btn">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Header Section -->
    <header id="home">
        <div class="container">
            <h1>Tambah Produk</h1>
            <p></p>
        </div>
    </header>

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <form method="POST" action="{{ route('tambah-product') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="Nama produk">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                    <input name="description" type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="Deskripsi produk">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                    <input name="price" type="number" class="form-control" id="exampleFormControlInput1"
                        placeholder="Harga produk">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stock</label>
                    <input name="stock" type="number" class="form-control" id="exampleFormControlInput1"
                        placeholder="Stok produk">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                    <input name="image" type="file" class="form-control" id="exampleFormControlInput1"
                        placeholder="gambar produk">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </section>



    <!-- Products Section -->
    @yield('content')

    <!-- Footer Section -->
    <footer id="contact">
        <div class="container">
            <p>&copy; 2025 Online Shop. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
