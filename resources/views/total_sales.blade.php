<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('TotalSales.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <h2 class="animate-slide-in">Total Sales</h2>
                    <table class="table table-hover animate-fade-in">
                        <thead class="table-dark">
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ optional($sale->product)->name ?? 'Unknown Product' }}</td>
                                    <td>{{ $sale->total_sold }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <canvas id="salesChart"></canvas>
                    <script>
                        var ctx = document.getElementById('salesChart').getContext('2d');
                        var salesChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode($sales->pluck('product.name')) !!},
                                datasets: [{
                                    label: 'Total Sales',
                                    data: {!! json_encode($sales->pluck('total_sold')) !!},
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(255, 159, 64, 0.6)',
                                        'rgba(153, 102, 255, 0.6)'
                                    ]
                                }]
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
