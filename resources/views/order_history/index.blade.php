<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('orderHistory.css') }}">
    <link rel="icon" href="{{ asset('images/FlashStoreU.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>FlashStore</h2>
            <ul>
                <li><a href="/"><i class="bx bx-home"></i> Home</a></li>
                <li><a href="/wishlist"><i class="bx bx-heart"></i> Wishlist</a></li>
                <li><a href="/order-history"><i class="bx bx-history"></i> Order History</a></li>
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
            <h2>Order History</h2>
            @if ($orders->isEmpty())
                <div class="alert alert-warning text-center">You have no order history.</div>
            @else
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-md-4 mb-4">
                        <div class="card order-card">
                            <div class="card-body text-center">
                                @if ($order->product->image)
                                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                                         alt="{{ $order->product->name }}" 
                                         class="img-fluid mb-3" 
                                         style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-image.png') }}" 
                                         alt="Default Image" 
                                         class="img-fluid mb-3" 
                                         style="height: 150px; object-fit: cover;">
                                @endif
                                
                                <h5 class="card-title">{{ $order->product->name }}</h5>
                                <p class="card-text">Quantity: {{ $order->quantity }}</p>
                                <p class="card-text text-success">Price: ${{ $order->price }}</p>
                                <p class="order-total">Total: ${{ $order->quantity * $order->price }}</p>
            
                                <!-- Tombol Remove -->
                                <form action="{{ route('orders.remove', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>            
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
