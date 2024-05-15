@extends("layouts.customer")
@section("css")
<style>

</style>

@endsection

@section("content")

    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                
                <aside class="col-lg-6">
                    <div class="container">
                        <img src="{{ asset('images/' . $product->image) }}" style="width:100%">
                    </div>
                </aside>
                
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ $product->product_name }} 
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <!-- Rating and orders information -->
                        </div>

                        <div class="mb-3">
                            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="unit">/item</span>
                        </div>
                        <div class="row">
                            <p>About :</p>
                        </div>

                        <p>
                            {{ $product->description }}
                        </p>

                        <div class="row mb-4" id="productSection">
                            <!-- col.// -->
                            <div class="col-md-12 col-12 mb-3">
                                <label class="mb-2 d-block">Quantity : {{$product->name}}  <b>{{$product->stok}}</b> tersedia</label>
                                <div class="input-group mb-3 quantity-operations" style="width: 170px;">
                                    {{-- <button class="btn btn-white border border-secondary px-3 decrease" type="button"
                                            id="button-addon1" data-mdb-ripple-color="dark">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control text-center border border-secondary quantity"
                                           value="1" aria-label="Example text with button addon"
                                           aria-describedby="button-addon1"/>
                                    <button class="btn btn-white border border-secondary px-3 increase" type="button"
                                            id="button-addon2" data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus"></i>
                                    </button> --}}
                                </div>
                                <div class="col-md-12 col-12 mb-3">
                                    @if($product->stok > 0)
                                    <div class="input-group mb-3 quantity-operations" style="width: 170px;">

                                        <button class="btn btn-white border border-secondary px-3 decrease">-</button>
                                        <input type="text" class="form-control text-center border border-secondary quantity"
                                           value="1" aria-label="Example text with button addon" id="qty" min="0" max="9999"
                                           aria-describedby="button-addon1"/>                                        
                                        <button class="btn btn-white border border-secondary px-3 increase">+</button>
                                    </div>
                                    @else
                                        <button class="btn btn-primary" disabled>Stok Habis</button>
                                    @endif
                                </div>
                                <div class="">
                                    </div>total: <span id="totalPrice" class="price">{{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                  <form action="{{route('checkout')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idProduct" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-outline-primary" style="font-size:24px">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </form>
                                 {{-- <form action="{{route('checkout')}}" method="POST">
                                    @csrf
                                    <div class="btn btn-success">
                                        <i class="fa fa-shopping-cart"></i>
                                        Checkout
                                    </div>
                                </form> --}}

                            </div>
                            

                         
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <!-- Review section -->
    {{-- <section class="border-top py-4">
        <div class="container">
            <!-- Review form for logged-in users -->
            <!-- Display reviews -->
        </div>
    </section> --}}
@endsection
@section("script")
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var increaseButton = document.querySelector('.increase');
        var decreaseButton = document.querySelector('.decrease');
        var quantityInput = document.getElementById('qty');
        
        increaseButton.addEventListener('click', function() {
            var currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue) && currentValue < 9999) {
                quantityInput.value = currentValue + 1;
            }
        });
        
        decreaseButton.addEventListener('click', function() {
            var currentValue = parseInt(quantityInput.value);
            if (!isNaN(currentValue) && currentValue > 0) {
                quantityInput.value = currentValue - 1;
            }
    });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var increaseButton = document.querySelector('.increase');
            var decreaseButton = document.querySelector('.decrease');
            var quantityInput = document.getElementById('qty');
            var pricePerItem = parseInt("{{ $product->price }}"); // Ambil harga produk dari PHP dan konversi ke integer
    
            // Fungsi untuk mengupdate harga berdasarkan jumlah barang yang dipilih
            function updatePrice() {
                var currentValue = parseInt(quantityInput.value);
                var totalPrice = currentValue * pricePerItem; // Hitung total harga
    
                // Update harga di HTML
                document.getElementById('totalPrice').innerText = totalPrice.toLocaleString('id-ID'); // Format harga ke format mata uang Indonesia
            }
    
            increaseButton.addEventListener('click', function() {
                var currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue < 9999) {
                    quantityInput.value = currentValue + 1;
                    updatePrice(); // Panggil fungsi untuk mengupdate harga
                }
            });
    
            decreaseButton.addEventListener('click', function() {
                var currentValue = parseInt(quantityInput.value);
                if (!isNaN(currentValue) && currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    updatePrice(); // Panggil fungsi untuk mengupdate harga
                }
            });
        });
        
    </script>
    
    
@endsection