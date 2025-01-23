@extends('layouts.app')

@section('title', 'Shop')

@section('content')
    <main class="mt-[80px] relative w-full">
        <!-- Banner Section -->
        <div class="h-[300px] relative">
            <img src="{{ asset('images/banner/banner_lumbung.png') }}" alt="banner" class="w-full h-full object-cover">
            {{-- <div class="absolute top-0 text-slate-50">
                <h3 class="text-xl">Beranda | List Produk</h3>
                <h1 class="text-3xl font-bold">SILAHKAN PILIH PRODUK</h1>
            </div> --}}
        </div>

        <div class="px-32 ">
            <!-- Featured Items Section -->
           
            <div class="flex justify-center items-center">
                <div class="h-0.5 bg-black w-full mt-10"></div>
                <h2 class="text-2xl font-semibold mt-10 text-center w-[800px]">DAFTAR PRODUK</h2>
                <div class="h-0.5 bg-black w-full mt-10"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-5">
                @if (!empty($products) && count($products) > 0)
                    @foreach ($products as $product)
                        <x-shop.card-product :path="route('product.show', $product->id)" :title="$product->nama" :price="number_format($product->harga, 0, ',', '.') . ' IDR'" :image="Str::startsWith($product->path_img, 'http')
                            ? $product->path_img
                            : asset('storage/' . $product->path_img)"
                             />
                    @endforeach
                @else
                    <p class="text-center col-span-full">No products available.</p>
                @endif
            </div>

            <div class="flex justify-center items-center ">
                <x-product></x-product>
            </div>
            {{-- <div class="w-full mt-10 flex justify-center items-center">
                <a href="/shop?page=2" type="button"
                    class=" px-20 cursor-pointer text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm  py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Read
                    More</a>
            </div> --}}
        </div>
    </main>
@endsection
