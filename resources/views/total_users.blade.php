<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('TotalUser.css') }}">
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
</head>

<body>
    @if (auth()->check() && auth()->user()->role === 'admin')
        <div class="dashboard">
            <!-- Sidebar -->
            <div class="sidebar">
                <h2>FLASHSTORE</h2>
                <ul>
                    <li><a href="/"><i class="bi bi-house-door"></i> Home</a></li>
                    <li><a href="/total-users"><i class="bi bi-people"></i> Total Users</a></li>
                    <li><a href="/total-sales"><i class="bi bi-bar-chart"></i> Total Sales</a></li>
                    <a class="submit-btn admin-btn" href="halamantambah" role="button" data-aos="zoom-in"
                        data-aos-delay="400">
                        <i class='bx bx-plus'></i> Tambah Produk
                    </a>
                </ul>
            </div>

            <!-- Profile Icon on Top Right -->
            <div class="top-right-profile">
                <a href="/profile">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="section">
                    <h2 class="animate-slide-in">Total Users</h2>
                    <table class="table table-hover animate-fade-in">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
