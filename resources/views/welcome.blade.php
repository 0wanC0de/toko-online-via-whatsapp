<!DOCTYPE html>
<html lang="id">

<head>
    <title>FlashStore</title>
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- Bootstrap Icons & CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                var navbar = document.querySelector(".navbar");
                if (window.scrollY > 200) {
                    navbar.style.background = "rgba(83, 63, 219, 1)";
                } else {
                    navbar.style.background = "rgba(83, 63, 219, 0)";
                }
            });
        });
    </script>

</head>

<body>

    <body class="{{ Auth::user() && Auth::user()->role == 'admin' ? 'admin' : 'user' }}">
        <!-- Navbar -->
        @if (auth()->check() && auth()->user()->role === 'admin')
            <!-- Sidebar untuk Admin -->

            <nav class="sidebar" data-aos="fade-down">
                <div class="sidebar-container">
                    <!-- Logo -->
                    <div class="sidebar-logo">
                        <h1 class="logo-text">
                            <i class="bi bi-cart"></i> FlashStore
                        </h1>
                    </div>
                    <!-- AOS JS -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
                    <script>
                        AOS.init({
                            duration: 1000,
                            once: true,
                        });
                    </script>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
                        rel="stylesheet"
                        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                        crossorigin="anonymous">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                    </script>
                    <!-- Navigation Menu -->
                    <ul class="sidebar-menu">
                        <li><a href="#home"><i class="bi bi-house-fill"></i>Beranda</a></li>
                        <li><a href="#products"><i class="bi bi-bag-fill"></i> Produk</a></li>
                        <li>
                            <a href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda"
                                target="_blank">
                                <i class="bi bi-telephone-fill"></i> Hubungi
                            </a>
                        </li>
                        <li><a href="/keranjang" class="cart-button"><i class="bi bi-cart-fill"></i> Keranjang</a></li>
                        <li><a href="{{ route('dashboard') }}"><i class="bi bi-person-circle"></i>Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        @else
            <!-- Navbar untuk User -->
            <nav class="navbar fixed-top" data-aos="fade-down" style="transition: all 0.3s ease;">
                <div class="container navbar-container ">
                    <!-- Logo -->
                    <div class="navbar-logo">
                        <h1 class="logo-text mb-0"> <a class="text-white text-decoration-none" href="#home">
                                <i class="bi bi-cart-fill"></i> FlashStore
                            </a>
                        </h1>
                    </div>
                    <!-- AOS JS -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
                    <script>
                        AOS.init({
                            duration: 1000,
                            once: true,
                        });
                    </script>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
                        rel="stylesheet"
                        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                        crossorigin="anonymous">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                    </script>
                    <!-- Navigation Menu -->
                    <ul class="navbar-menu">
                        <li><a class="my-auto h-100 navbar-hover-effect" href="#home">Home</a></li>
                        <li><a class="my-auto h-100 navbar-hover-effect" href="#products">Product</a></li>
                        <li>
                            <a class="my-auto h-100 navbar-hover-effect"
                                href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda"
                                target="_blank">Contact</a>
                        </li>
                        <li><a class="my-auto h-100 navbar-hover-effect cart-button" href="/keranjang">Cart</a></li>

                        @auth
                            <!-- Jika pengguna sudah login -->
                            <li><a class="my-auto h-100 navbar-hover-effect" href="{{ route('dashboard') }}"></i> Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </li>
                        @else
                            <!-- Jika pengguna belum login -->
                            <li><a href="{{ route('login') }}" class="button-pill btn btn-primary">Login</a></li>
                            <li><a href="{{ route('register') }}" class="button-pill btn btn-outline-primary">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        @endif



        <!-- Header Section -->
        <header id="home" class="hero-section">
            <div class="container hero-content">
                <!-- Bagian Kiri: Teks -->
                <div class="hero-text text-white">
                    <h1 data-aos="fade-down">Welcome to <span class="brand">FlashStore</span></h1>
                    <p data-aos="fade-up" data-aos-delay="200">Checkout seamlessly via <i class="bi bi-whatsapp"></i> WhatsApp</p>
        
                    @if (!Auth::check())
                        <div class="sp">
                            <a href="{{ route('login') }}" class="sparkle-button">
                                <span class="spark"></span>
                                
                                <span class="text">Get Started</span>
                            </a>
                        </div>
                    @endif
        
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <a class="submit-btn admin-btn" href="halamantambah" role="button" data-aos="zoom-in" data-aos-delay="400">
                            Tambah Produk
                        </a>
                    @endif
                </div>
        
                <!-- Bagian Kanan: Gambar -->
                <div class="hero-image" data-aos="fade-left">
                    <img src="{{ asset('images/FlashStoreU.jpg') }}" alt="FlashStore Illustration">
                </div>
            </div>
        </header>


        <!-- About Us Section -->
        <section id="about-us" class="about-us">
            <div class="container">
                <h2 data-aos="fade-up" class="text-black">About Us</h2>
                <div class="about-content">
                    <div class="about-text" data-aos="fade-right">
                        <p>Welcome to <span class="brand">FlashStore</span>, your go-to destination for quality
                            products. We provide the best products at affordable prices with an easy checkout process
                            via WhatsApp.
                        </p>
                    </div>
                    <div class="about-image" data-aos="fade-left">
                        <img src="{{ asset('images/AboutUS.jpg') }}" alt="About Us Image">
                    </div>
                </div>
            </div>
        </section>


        <!-- Products Section -->
        <section id="products" class="products">
            <div class="container">
                <h2 data-aos="fade-up">Produk Kami</h2>
                <div class="product-list">
                    @foreach ($products as $product)
                        <div class="product-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                            @if ($product['image'])
                                <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                    style="width: 100px; height: 100px;">
                            @else
                                <img src="{{ asset('images/default-image.png') }}" alt="Default Image"
                                    style="width: 100px; height: 100px;">
                            @endif
                            <h3>{{ $product['name'] }}</h3>
                            <div class="product-details">
                                <p class="description">{{ $product['description'] }}</p>
                                <p class="stock">Stock: <span
                                        id="stock-{{ $product['id'] }}">{{ $product['stock'] }}</span></p>
                                <p class="price">Price: $<span
                                        id="price-{{ $product['id'] }}">{{ $product['price'] }}</span></p>
                            </div>

                            @if (Auth::check() && Auth::user()->role === 'admin')
                                <button class="edit-btn" data-id="{{ $product['id'] }}"
                                    data-stock="{{ $product['stock'] }}" data-price="{{ $product['price'] }}">
                                    Edit
                                </button>
                            @endif

                            <form action="{{ route('add-to-keranjang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product['id'] }}">
                                <input type="hidden" name="name" value="{{ $product['name'] }}">
                                <input type="hidden" name="price" value="{{ $product['price'] }}">
                                <button type="submit" class="btn-add-to-cart">Tambah Keranjang</button>
                            </form>
                            @if (Auth::check() && Auth::user()->role === 'user')
                                <form action="{{ route('wishlist.store') }}" method="POST" class="form-wishlist"
                                    style="margin-top: 10px;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                    <button type="submit" class="btn-wishlist"
                                        id="wishlist-button-{{ $product['id'] }}">
                                        <i class='bx bx-heart' id="wishlist-icon-{{ $product['id'] }}"></i>
                                        <span id="wishlist-text-{{ $product['id'] }}">Tambah ke Wishlist</span>
                                    </button>
                                </form>
                            @endif

                        </div>
                        <div id="editModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2>Edit Produk</h2>
                                <form id="editForm">
                                    @csrf
                                    <input type="hidden" id="edit-id" name="id">
                                    <label>Stock:</label>
                                    <input type="number" id="edit-stock" name="stock" required>
                                    <label>Price:</label>
                                    <input type="number" id="edit-price" name="price" required>
                                    <button type="submit" class="btn-save">Simpan</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        <!-- Footer Section -->
        <footer id="contact" data-aos="fade-up">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-left">
                        <h1><img class="footer-logo " style="font-style: italic;">FlashStore</h1>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum dolores veniam, error hic
                            praesentium unde veritatis consectetur voluptate porro, et laborum neque inventore iste eius
                            quibusdam, quidem quo ex temporibus! </p>

                    </div>
                    <div class="footer-links">
                        <div class="footer-column">
                            <h4>Platform</h4>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <li><a href="#products">Product</a></li>
                                <li><a
                                        href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda">Contact</a>
                                </li>
                                <li><a href="#">Cart</a></li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h4>Help</h4>
                            <ul>
                                <li><a href="#">How does it work?</a></li>
                                <li><a href="#">Where to ask questions?</a></li>
                                <li><a href="#">How to play?</a></li>
                                <li><a href="#">What is needed for this?</a></li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h4>Subscribe</h4>
                            <form class="d-flex justify-content-center align-items-center mb-2">
                                <div class="w-100">
                                    <input type="email" class="form-control bg-transparent text-white py-2"
                                        placeholder="Your email here!" id="subscribe=button">
                                </div>
                                <button type="submit"
                                    class="btn btn-outline-primary button-pill-end py-2">Subscribe</button>
                            </form>
                            <p class="mb-2"><i class="bi bi-telephone"></i> 123 4567 8090</p>
                            <p class="mb-2"><i class="bi bi-envelope"></i> flashstore@gmail.com</p>
                            <p class="mb-2"><i class="bi bi-geo-alt-fill"></i> My Location</p>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/flashsoftindonesia/"><i
                                        class="text-white bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/flashsoftindonesia/"><i
                                        class="text-white bi bi-instagram"></i></a>
                                <a href="#"><i class="text-white bi bi-whatsapp"></i></a>
                                <a href="#"><i class="text-white bi bi-discord"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="footer-bottom mt-5 mb-2">@ Flashstore 2024. All rights reserved.</p>
            </div>
        </footer>

        <!-- AOS JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });
        </script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            function editProduct(id, stock, price) {
                document.getElementById("edit-id").value = id;
                document.getElementById("edit-stock").value = stock;
                document.getElementById("edit-price").value = price;
                document.getElementById("editModal").style.display = "block";
            }

            document.querySelector(".close").addEventListener("click", function() {
                document.getElementById("editModal").style.display = "none";
            });

            window.onclick = function(event) {
                let modal = document.getElementById("editModal");
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            }


            document.addEventListener("DOMContentLoaded", function() {
                const editButtons = document.querySelectorAll(".edit-btn");
                const modal = document.getElementById("editModal");
                const closeModal = document.querySelector(".close");
                const editForm = document.getElementById("editForm");
                const editId = document.getElementById("edit-id");
                const editStock = document.getElementById("edit-stock");
                const editPrice = document.getElementById("edit-price");

                editButtons.forEach(button => {
                    button.addEventListener("click", function() {
                        editId.value = this.dataset.id;
                        editStock.value = this.dataset.stock;
                        editPrice.value = this.dataset.price;
                        modal.style.display = "block";
                    });
                });

                closeModal.addEventListener("click", function() {
                    modal.style.display = "none";
                });

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };

                editForm.addEventListener("submit", function(event) {
                    event.preventDefault();

                    fetch("{{ route('product.update') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id: editId.value,
                                stock: editStock.value,
                                price: editPrice.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById("stock-" + editId.value).textContent = editStock
                                    .value;
                                document.getElementById("price-" + editId.value).textContent = editPrice
                                    .value;
                                modal.style.display = "none";
                                alert("Produk berhasil diperbarui!");
                            } else {
                                alert("Gagal memperbarui produk.");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wishlistForms = document.querySelectorAll('.form-wishlist');

                wishlistForms.forEach(form => {
                    const productId = form.querySelector('input[name="product_id"]').value;
                    const button = form.querySelector('.btn-wishlist');
                    const icon = form.querySelector('.bx-heart');
                    const text = form.querySelector('#wishlist-text-' + productId);

                    // Periksa status wishlist
                    fetch(`/wishlist/check/${productId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.isInWishlist) {
                                button.innerHTML =
                                    "<i class='bx bxs-heart text-danger'></i> Ditambahkan ke Wishlist";
                            }
                        });

                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); 

                        
                        button.innerHTML =
                            "<i class='bx bxs-heart text-danger'></i> Ditambahkan ke Wishlist";

                        
                        setTimeout(() => {
                            this.submit();
                        }, 500);
                    });
                });
            });
        </script>

    </body>
</body>
