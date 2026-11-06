@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Management</h1>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary">
            Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    width="65"
                                    height="65"
                                    style="object-fit: cover"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>

                        <td>{{ $product->category->name }}</td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{ $products->links() }}

</div>
@endsection