{{-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="{{ asset('keranjang.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <h1 class="logo-text">
                <i class="bi bi-bag-fill"></i> FlashStore
            </h1>
            <ul class="navbar-menu">
                <li><a href="/"><i class="bi bi-house-fill"></i>Beranda</a></li>
                <li><a href="/"><i class="bi bi-bag-fill"></i> Produk</a></li>
                <li>
                    <a href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda"
                        target="_blank">
                        <i class="bi bi-telephone-fill"></i> Hubungi
                    </a>
                </li>
                <li><a href="/keranjang" class="cart-button"><i class="bi bi-cart-fill"></i> Keranjang</a></li>

                @auth
                    
                    <li><a href="{{ route('dashboard') }}"><i class="bi bi-person-circle"></i>Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    
                    <li><a href="{{ route('login') }}" class="btn btn-success">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <header>
        <h1>Keranjang Anda</h1>
    </header>

    <section class="products">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($keranjang->count() > 0)
                <form action="{{ route('update-keranjang') }}" method="POST">
                    @csrf
                    <table class="table table-bordered table-striped text-center cart-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($keranjang as $item)
                                @php
                                    $subtotal = $item->price * $item->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr class="product-item">
                                    <td>{{ optional($item->product)->name ?? 'Produk tidak ditemukan' }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>
                                        <input type="number" name="quantities[{{ $item->id }}]"
                                            value="{{ $item->quantity }}" min="1">
                                    </td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <a href="{{ route('remove-from-keranjang', $item->id) }}"
                                            class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>Total: ${{ number_format($total, 2) }}</p>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn-update-cart">
                            <i class="bi bi-bag-check-fill"></i> Perbarui Keranjang
                        </button>
                        @php
                            $pesan = 'Halo, saya ingin memesan produk berikut:';
                            foreach ($keranjang as $item) {
                                $pesan .= '- ' . optional($item->product)->name . ' (' . $item->quantity . 'x) ';
                            }
                            $pesan .= 'Terima kasih!';
                        @endphp
                        <script>
                            var pesanWA = {!! json_encode($pesan) !!};
                        </script>
                        <a class="btn-whatsapp" href="#" onclick="prosesPesanan(event)">
                            <i class="bi bi-telephone-fill"></i> Pesan sekarang
                        </a>
                    </div>
                </form>
            @else
                <p>Keranjang Anda kosong!</p>
            @endif
        </div>
    </section>

    
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

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



    <script>
        function prosesPesanan(event) {
            event.preventDefault();

            
            fetch("{{ route('pesan.sekarang') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        
                        window.location.href = "https://wa.me/123456789?text=" + encodeURIComponent(pesanWA);
                    } else {
                        alert(data.error || 'Terjadi kesalahan saat memproses pesanan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Coba lagi nanti.');
                });
        }
    </script>



</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="{{ asset('keranjang.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
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
                <li><a class="my-auto h-100 navbar-hover-effect" href="/">Beranda</a></li>
                <li><a class="my-auto h-100 navbar-hover-effect" href="/">Produk</a></li>
                <li>
                    <a class="my-auto h-100 navbar-hover-effect"
                        href="https://wa.me/123456789?text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20produk%20Anda"
                        target="_blank">Contact</a>
                </li>
                <li><a class="my-auto h-100 navbar-hover-effect cart-button" href="/keranjang">Keranjang</a>
                </li>
            </ul>
        </div>
    </nav>

    <header>
        <h1>Keranjang Anda</h1>
    </header>

    <section class="products">
        <div class="container">
            <div id="keranjang-container">
                <h3>Keranjang Belanja</h3>
                <table class="table table-bordered table-striped text-center cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="keranjang-list">
                        <!-- Item keranjang akan ditampilkan di sini -->
                    </tbody>
                </table>
                <p id="total-keranjang">Total: Rp 0</p>
                <div class="d-flex justify-content-between">
                    <a class="btn-whatsapp" href="#" onclick="prosesPesanan(event)">
                        <i class="bi bi-telephone-fill"></i> Pesan sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
    


    <script>
        console.log('Script loaded'); // Pastikan ini muncul di console

        function addToKeranjang(event) {
            event.preventDefault(); // Mencegah form submit

            // Ambil data dari form
            const form = event.target;
            const product = {
                id: form.querySelector('input[name="id"]').value,
                name: form.querySelector('input[name="name"]').value,
                price: parseFloat(form.querySelector('input[name="price"]').value),
                quantity: 1, // Default quantity
            };

            // Ambil keranjang dari local storage (jika sudah ada)
            let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

            // Cek apakah produk sudah ada di keranjang
            const existingProduct = keranjang.find(item => item.id === product.id);
            if (existingProduct) {
                // Jika sudah ada, tambahkan quantity-nya
                existingProduct.quantity += 1;
            } else {
                // Jika belum ada, tambahkan produk baru ke keranjang
                keranjang.push(product);
            }

            // Simpan keranjang ke local storage
            localStorage.setItem('keranjang', JSON.stringify(keranjang));

            // Tampilkan pesan sukses
            alert('Produk berhasil ditambahkan ke keranjang!');

            // Perbarui tampilan keranjang
            displayKeranjang();
        }

        function displayKeranjang() {
            const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
            const keranjangList = document.getElementById('keranjang-list');
            const totalKeranjang = document.getElementById('total-keranjang');

            // Kosongkan list sebelum menambahkan item baru
            keranjangList.innerHTML = '';

            let total = 0;

            // Tampilkan setiap item di keranjang
            keranjang.forEach(item => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td>
                        <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${item.id}, this.value)">
                    </td>
                    <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeFromKeranjang(${item.id})">Hapus</button>
                    </td>
                `;
                keranjangList.appendChild(row);
            });

            // Tampilkan total
            totalKeranjang.textContent = `Total: Rp ${total.toLocaleString('id-ID')}`;
        }

        function updateQuantity(productId, quantity) {
            let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

            // Cari produk dan update quantity-nya
            const product = keranjang.find(item => item.id == productId);
            if (product) {
                product.quantity = parseInt(quantity);
            }

            // Simpan kembali ke local storage
            localStorage.setItem('keranjang', JSON.stringify(keranjang));

            // Tampilkan ulang keranjang
            displayKeranjang();
        }

        function removeFromKeranjang(productId) {
            let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

            // Filter item yang tidak sesuai dengan productId
            keranjang = keranjang.filter(item => item.id != productId);

            // Simpan kembali ke local storage
            localStorage.setItem('keranjang', JSON.stringify(keranjang));

            // Tampilkan ulang keranjang
            displayKeranjang();
        }

        function prosesPesanan(event) {
            event.preventDefault();

            const keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
            let pesan = 'Halo, saya ingin memesan produk berikut:\n';

            keranjang.forEach(item => {
                pesan += `- ${item.name} (${item.quantity}x) - Rp ${item.price.toLocaleString('id-ID')}\n`;
            });

            pesan += 'Terima kasih!';

            // Redirect ke WhatsApp
            window.location.href = `https://wa.me/123456789?text=${encodeURIComponent(pesan)}`;
        }

        // Panggil fungsi untuk menampilkan keranjang saat halaman dimuat
        displayKeranjang();
    </script>
</body>

</html>