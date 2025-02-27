<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('Profile.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <div>
                <h2>FLASHSTORE</h2>
                <ul>
                    <li><a href="/dashboard"><i class="bi bi-house-door"></i> Home</a></li>
                    @if (auth()->check() && auth()->user()->role === 'user')
                        <li><a href="/wishlist"><i class="bi bi-heart"></i> Wishlist</a></li>
                        <li><a href="/order-history"><i class="bi bi-bag"></i> Order History</a></li>
                    @endif
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <li><a href="/total-users"><i class="bi bi-people"></i> Total Users</a></li>
                        <li><a href="/total-sales"><i class="bi bi-bar-chart"></i> Total Sales</a></li>
                        <a class="submit-btn admin-btn" href="halamantambah" role="button" data-aos="zoom-in"
                            data-aos-delay="400">
                            <i class='bx bx-plus'></i> Tambah Produk
                        </a>
                    @endif
                </ul>
            </div>
        </div>

        <div class="main-content">
            <section class="section">
                <h2>Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ auth()->user()->email }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            
                <!-- Update Password -->
                <section class="mt-4">
                    <header>
                        <h2>Update Password</h2>
                        <p>Ensure your account is using a long, random password to stay secure.</p>
                    </header>
                    <form method="post" action="{{ route('password.update') }}" class="mt-3">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control"
                                autocomplete="current-password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                autocomplete="new-password">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Save</button>
                    </form>
                </section>
            
                <!-- Delete Account -->
                <section class="mt-4">
                    <header>
                        <h2>Delete Account</h2>
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </header>
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <div class="form-group">
                            <label for="password_delete">Password</label>
                            <input type="password" name="password" id="password_delete" class="form-control"
                                placeholder="Enter your password to confirm">
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">Delete Account</button>
                    </form>
                </section>
            </section>
            
        </div>

    </div>
</body>

</html>
