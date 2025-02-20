<!DOCTYPE html>
<html lang="id">
<head>
    <title>FlashStore</title>
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- Bootstrap Icons & CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">


    </head>
<body>
    <!-- Navbar -->
    <nav class="navbar" data-aos="fade-down">
        <div class="container navbar-container">
            <!-- Logo -->
            <div class="navbar-logo">
                <h1 class="logo-text">
                    <i class="bi bi-bag-fill"></i> FlashStore
                </h1>
                <link rel="stylesheet" href="{{ asset('styles.css') }}">
                <!-- AOS JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
                <script>
                    AOS.init({
                        duration: 1000, 
                        once: true, 
                    });
                </script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            </div>

            <!-- Navigation Menu -->
            <ul class="navbar-menu">
                <li><a href="#home"><i class="bi bi-house-fill"></i>Beranda</a></li>
                <li><a href="#products"><i class="bi bi-bag-fill"></i> Produk</a></li>
                <li>
                    <a href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda" target="_blank">
                      <i class="bi bi-telephone-fill"></i> Hubungi
                    </a>
                  </li>
                <li><a href="/keranjang" class="cart-button"><i class="bi bi-cart-fill"></i> Keranjang</a></li>
      

                @auth
                    <!-- Jika pengguna sudah login -->
                    <li><a href="{{ route('dashboard') }}"><i class="bi bi-person-circle"></i>Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- Jika pengguna belum login -->
                    <li><a href="{{ route('login') }}" class="btn btn-success">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>


   <!-- Header Section -->
    <header id="home" class="hero-section">
        <div class="container hero-content">
            <!-- Bagian Kiri: Teks -->
            <div class="hero-text">
                <h1 data-aos="fade-down">Welcome to <span class="brand">FlashStore</span></h1>
                <p data-aos="fade-up" data-aos-delay="200">Checkout seamlessly via <i class="bi bi-whatsapp"></i>WhatsApp</p>
                
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a class="submit-btn admin-btn" href="halamantambah" role="button" data-aos="zoom-in" data-aos-delay="400">
                    Tambah Produk
                    </a>
                @endif
            </div>  

            <!-- Bagian Kanan: Gambar -->
            <div class="hero-image" data-aos="fade-left">
                <img src="{{ asset('images/FlashStoreN.jpg') }}" alt="FlashStore Illustration">
            </div>
        </div>  
    </header>



    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <h2 data-aos="fade-up">Produk Kami</h2>
            <div class="product-list">
                @foreach ($products as $product)
                <div class="product-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                    @if ($product['image'])
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" style="width: 100px; height: 100px;">
                    @else
                        <img src="{{ asset('images/default-image.png') }}" alt="Default Image" style="width: 100px; height: 100px;">
                    @endif
                    <h3>{{ $product['name'] }}</h3>
                    <div class="product-details">
                        <p class="description">{{ $product['description'] }}</p>
                        <p class="stock">Stock: <span id="stock-{{ $product['id'] }}">{{ $product['stock'] }}</span></p>
                        <p class="price">Price: $<span id="price-{{ $product['id'] }}">{{ $product['price'] }}</span></p>
                    </div>

                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <button class="edit-btn" data-id="{{ $product['id'] }}" data-stock="{{ $product['stock'] }}" data-price="{{ $product['price'] }}">
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
                    <h3><img  class="footer-logo"> FlashStore</h3>
                    <p>Tempat Belanja </p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Platform</h4>
                        <ul>
                            <li><a href="#home">Beranda</a></li>
                            <li><a href="#products">Produk</a></li>
                            <li><a href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda">Hubungi</a></li>
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
                        <h4>Contacts</h4>
                        <p>📞 123 4567 8090</p>
                        <p>📧 flashstore@gmail.com</p>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/flashsoftindonesia/"><img src="images/facebook.png" alt="Facebook"></a>
                            <a href="https://www.instagram.com/flashsoftindonesia/"><img src="images/instagram.png" alt="Instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <p class="footer-bottom">@ Flashstore 2024. All rights reserved.</p>
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

        document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".edit-btn");
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close");
        const editForm = document.getElementById("editForm");
        const editId = document.getElementById("edit-id");
        const editStock = document.getElementById("edit-stock");
        const editPrice = document.getElementById("edit-price");
    
        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                editId.value = this.dataset.id;
                editStock.value = this.dataset.stock;
                editPrice.value = this.dataset.price;
                modal.style.display = "block";
            });
        });
    
        closeModal.addEventListener("click", function () {
            modal.style.display = "none";
        });
    
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    
        editForm.addEventListener("submit", function (event) {
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
                    document.getElementById("stock-" + editId.value).textContent = editStock.value;
                    document.getElementById("price-" + editId.value).textContent = editPrice.value;
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

</body>




{{-- aaaaaaaaaaaaa --}}