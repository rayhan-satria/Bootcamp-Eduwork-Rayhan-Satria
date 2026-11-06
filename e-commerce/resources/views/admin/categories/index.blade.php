@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Category Management</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary">
            Tambah Kategori
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
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Jumlah Produk</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>

                        <td>{{ $category->slug }}</td>

                        <td>{{ $category->products_count }}</td>

                        <td>{{ $category->description ?? '-' }}</td>

                        <td>
                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.categories.destroy', $category->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
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
                        <td colspan="5" class="text-center">
                            Belum ada kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{ $categories->links() }}

</div>
@endsection