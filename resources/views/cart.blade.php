@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="px-32 rounded-md mt-20">
        <div class="flex shadow-md">
            <!-- Shopping Cart Section -->
            <div class="w-[65%] bg-white py-10">
                <div class="flex justify-between border-b pb-8 px-10">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl">{{ $cartItems->count() }} Items</h2>
                </div>

                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold px-20 text-gray-900 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-900 text-xs uppercase w-1/5">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-900 text-xs uppercase w-1/5">Price</h3>
                    <h3 class="font-semibold text-center text-gray-900 text-xs uppercase w-1/5">Total</h3>
                </div>

                <div class="flex flex-col gap-3">
                    @php $totalPrice = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php
                            $itemTotal = $item->price_222290 * $item->quantity_222290;
                            $totalPrice += $itemTotal;
                        @endphp
                        <div class="flex items-center hover:bg-gray-100 px-6 py-5">
                            <div class="flex w-2/5">
                                <div class="w-20">
                                    <img class="h-24" src="{{ $item->product->path_img_222290 }}"
                                        alt="{{ $item->product->nama_222290 }}">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm text-slate-950">{{ $item->product->nama_222290 }}</span>
                                    <button onclick="removeItemFromCart({{ $item->product_id_222290 }})"
                                        class="font-bold text-sm text-start rounded text-red-500">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5">
                                {{-- <input class="mx-2 border text-center w-8" type="number"
                                    value="{{ $item->quantity_222290 }}" min="1"
                                    onchange="updateQuantity({{ $item->id_222290 }}, this.value)"> --}}
                                {{ $item->quantity_222290 }}
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">Rp
                                {{ number_format($item->product->harga_222290, 2) }}</span>
                            <span class="text-center w-1/5 font-semibold text-sm">Rp
                                {{ number_format($itemTotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary Section -->
            <div id="summary" class="w-[35%] px-8 py-10 bg-white">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items {{ $cartItems->count() }}</span>
                </div>

                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost</span>
                        <span>Rp {{ number_format($totalPrice, 2) }}</span>
                    </div>
                    <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full"
                        onclick="showPaymentModal()">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Bank Transfer -->
    <div id="payment-modal"
        class="fixed z-50 inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center overflow-auto">
        <div class="bg-white rounded-lg w-1/3 p-5">
            <h2 class="text-xl font-bold mb-4">Transfer Bank</h2>
            <p>Silakan transfer jumlah total ke rekening bank berikut:</p>
            <div class="my-4">
                <strong>Nama Bank: BCA</strong><br>
                <strong>No. Rekening: 1234567890</strong><br>
                <strong>Nama Pemilik Rekening: PT. MaskGlow</strong>
            </div>

            <!-- Daftar Barang yang Dibeli -->
            <div class="border-t my-4 py-2">
                <h3 class="font-semibold">Barang yang Dibeli:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($cartItems as $item)
                        <li>{{ $item->product->nama_222290 }} - {{ $item->quantity_222290 }} pcs</li>
                    @endforeach
                </ul>
            </div>

            <!-- Total Biaya -->
            <div class="flex justify-between font-bold mt-4">
                <span>Total:</span>
                <span>Rp {{ number_format($totalPrice, 2) }}</span>
            </div>

            <!-- Form Upload Bukti Pembayaran -->
            <form id="upload-receipt-form" enctype="multipart/form-data" class="mt-4">
                <label class="block mb-2">Unggah Bukti Pembayaran:</label>
                <input type="file" name="receipt" id="receipt" class="border p-2 w-full" accept="image/*" required
                    onchange="previewReceipt()">
            </form>

            <!-- Preview Gambar yang Diupload -->
            <div id="receipt-preview" class="mt-4 hidden">
                <h3 class="font-semibold mb-2">Pratinjau Bukti Pembayaran:</h3>
                <img id="receipt-image" src="" alt="Bukti Pembayaran" class="w-full rounded shadow-lg">
            </div>

            <div class="flex justify-end mt-5">
                <button onclick="closePaymentModal()"
                    class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">Tutup</button>
                <button onclick="submitPaymentProof()"
                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Kirim</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function removeItemFromCart(productId) {
            fetch(`/cart/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Product removed from cart successfully') {
                        alert('Item removed from cart');
                        window.location.reload();
                        // Bisa tambahkan logika untuk mengupdate tampilan cart
                    } else {
                        alert(data.message); // Tampilkan pesan error jika ada
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to remove item from cart');
                });
        }
    </script>
    <script>
        function previewReceipt() {
            const receiptInput = document.getElementById('receipt');
            const receiptPreview = document.getElementById('receipt-preview');
            const receiptImage = document.getElementById('receipt-image');

            if (receiptInput.files && receiptInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    receiptImage.src = e.target.result;
                    receiptPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(receiptInput.files[0]);
            } else {
                receiptPreview.classList.add('hidden');
                receiptImage.src = '';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showPaymentModal() {
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        async function submitPaymentProof() {
            const receiptInput = document.getElementById('receipt');

            // Validasi apakah bukti pembayaran diunggah
            if (!receiptInput.files.length) {
                Swal.fire('Error', 'Please upload a payment proof!', 'error');
                return;
            }

            const formData = new FormData(document.getElementById('upload-receipt-form'));
            formData.append('customer_id', {{ session('user_id') }});
            formData.append('total_amount', {{ $totalPrice }});

            try {
                const response = await fetch('/submit-payment-proof', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();
                // console.log("ini datanya : " + data.message);


                if (data.message === 'Pembayaran berhasil disimpan') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Pembayaran berhasil disimpan',
                        icon: 'success', // Ini akan menampilkan ikon centang default
                        confirmButtonText: 'OK',
                    }).then(() => {
                        closePaymentModal();
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Failed to submit payment proof', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while submitting payment proof', 'error');
            }
        }
    </script>
@endsection
