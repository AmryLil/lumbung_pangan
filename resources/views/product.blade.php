@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="w-full mt-20 px-32">
        <div class="bg-white p-4 rounded-lg shadow-xl gap-6 ">
            <div class="flex">
                <!-- Product Image -->
                <div class="w-1/2 flex justify-center relative h-[80vh] overflow-hidden rounded-lg shadow-md bg-slate-800">
                    <img src="{{ Str::startsWith($product->path_img, 'http') ? $product->path_img : asset('storage/' . $product->path_img) }}"
                        alt="Product Image" class="object-contain max-w-full max-h-[70vh] transform hover:scale-110 transition duration-300 ease-in-out">
                </div>

                <!-- Product Details -->
                <div class="w-1/2 flex flex-col p-4 justify-between px-8 space-y-6">
                    <div class="text-start">
                        <h1 class="text-5xl font-extrabold text-gray-800">{{ $product->nama }}</h1>
                        <p class="text-lg text-gray-500 font-medium mt-2">Kategori Produk</p>
                        <div class="h-1 w-1/3 bg-gray-800 mt-4 rounded"></div>
                    </div>

                    <!-- Product Specs -->
                    <div class="space-y-6">
                        <div>
                            <p class="text-2xl font-semibold text-gray-700">Deskripsi</p>
                            <p class="text-lg text-gray-600 mt-2">{{ $product->deskripsi }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label for="qty" class="text-lg font-semibold text-gray-700">Kuantitas:</label>
                            <input id="qty" type="number" value="1" min="1"
                                class="border-2 border-gray-300 p-2 text-center w-20 text-lg font-semibold rounded-lg focus:ring-2 focus:ring-gray-500 focus:outline-none" />
                        </div>
                        <div>
                            <p class="text-2xl font-semibold text-gray-700">Stok</p>
                            <p class="text-lg font-bold text-gray-900">{{ $product->jumlah }} Barang</p>
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <p class="text-4xl font-extrabold text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <div class="mt-4 flex justify-between items-center gap-4">
                            <!-- Checkout Button -->
                            <button id="co" onclick="showPaymentModal()"
                                class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-900 transform transition hover:scale-105 shadow-lg w-full">
                                Checkout Sekarang
                            </button>
                            <!-- Add to Cart Button -->
                            <button id="add-to-cart"
                                class="bg-yellow-400 flex items-center justify-center p-3 rounded-lg hover:bg-yellow-500 transform transition hover:scale-105 shadow-lg">
                                <img src="{{ asset('images/carts.png') }}" alt="" class="h-8">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Modal -->
        <div id="payment-modal"
            class="fixed z-50 inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center overflow-auto">
            <div class="bg-white rounded-lg shadow-xl w-1/3 p-6 relative">
                <button onclick="closePaymentModal()"
                    class="absolute top-4 right-4 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold">&times;</button>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Transfer Bank</h2>
                <p class="text-gray-700 mb-4">Silakan transfer jumlah total ke rekening bank berikut:</p>
                <div class="bg-gray-100 p-4 rounded-lg text-gray-800 mb-6">
                    <strong>Nama Bank:</strong> BCA<br>
                    <strong>No. Rekening:</strong> 1234567890<br>
                    <strong>Nama Pemilik:</strong> PT. MaskGlow
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Barang yang Dibeli:</h3>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li>{{ $product->nama }}</li>
                </ul>
                <div class="flex justify-between text-lg font-bold text-gray-900 mb-6">
                    <span>Total:</span>
                    <span>Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                </div>
                <form id="upload-receipt-form" enctype="multipart/form-data" class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Unggah Bukti Pembayaran:</label>
                    <input type="file" name="receipt" id="receipt"
                        class="border-2 border-gray-300 p-2 w-full rounded-lg focus:ring-2 focus:ring-gray-500 focus:outline-none"
                        accept="image/*" required onchange="previewReceipt()">
                </form>
                <div id="receipt-preview" class="hidden mb-6">
                    <h3 class="font-semibold text-gray-700 mb-2">Pratinjau Bukti Pembayaran:</h3>
                    <img id="receipt-image" src="" alt="Bukti Pembayaran" class="w-full rounded-lg shadow-lg">
                </div>
                <div class="flex justify-end space-x-4">
                    <button onclick="closePaymentModal()"
                        class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Tutup</button>
                    <button onclick="submitPaymentProof()"
                        class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
