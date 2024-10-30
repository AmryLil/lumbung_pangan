<!-- resources/views/products/edit.blade.php -->

@extends('layouts.dashboard-layout')

@section('content')
    <div class="container  mt-10  p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Edit Product</h2>

        <!-- Show success message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form to edit product -->
        <form action="{{ route('products.update', $product->id_222290) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_222290" class="block text-gray-700 font-semibold">Product Name</label>
                <input type="text" name="nama_222290" class="mt-1 w-full p-2 border border-gray-300 rounded"
                    value="{{ old('nama_222290', $product->nama_222290) }}" required>
                @error('nama_222290')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi_222290" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="deskripsi_222290" class="mt-1 w-full p-2 border border-gray-300 rounded" rows="4" required>{{ old('deskripsi_222290', $product->deskripsi_222290) }}</textarea>
                @error('deskripsi_222290')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_222290" class="block text-gray-700 font-semibold">Price</label>
                <input type="number" name="harga_222290" class="mt-1 w-full p-2 border border-gray-300 rounded"
                    value="{{ old('harga_222290', $product->harga_222290) }}" required>
                @error('harga_222290')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_id_222290" class="block text-gray-700 font-semibold">Category</label>
                <select name="kategori_id_222290" class=" text-gray-700  mt-1 w-full p-2 border border-gray-300 rounded"
                    required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_222290 }}">{{ $category->nama_222290 }}</option>
                    @endforeach
                </select>
                @error('kategori_id_222290')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="path_img_222290" class="block text-gray-700 font-semibold">Product Image</label>
                <input type="file" name="path_img_222290" class="mt-1 w-full border border-gray-300 rounded p-2">
                @if ($product->path_img_222290)
                    <img src="{{ Str::startsWith($product->path_img_222290, 'http')
                        ? $product->path_img_222290
                        : asset('storage/' . $product->path_img_222290) }}"
                        alt="Current Image" class="mt-2 h-24">
                @endif
                @error('path_img_222290')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update
                    Product</button>
                <a href="{{ route('products.index') }}"
                    class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
@endsection
