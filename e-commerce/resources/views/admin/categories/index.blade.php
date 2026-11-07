<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category Management
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="container flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.categories.index') }}" method="GET"
                class="flex flex-wrap gap-3 my-4">

                {{-- Search --}}
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama kategori..."
                    class="border-gray-300 rounded-md shadow-sm"
                >

                {{-- Sorting --}}
                <select name="sort" class="border-gray-300 rounded-md shadow-sm">
                    <option value="">Urutan Default</option>
                    <option value="name_asc" 
                        {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                        Nama A-Z
                    </option>
                    <option value="name_desc" 
                        {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                        Nama Z-A
                    </option>
                    <option value="products_asc"
                        {{ request('sort') == 'products_asc' ? 'selected' : '' }}>
                        Produk Paling Sedikit
                    </option>

                    <option value="products_desc"
                        {{ request('sort') == 'products_desc' ? 'selected' : '' }}>
                        Produk Paling Banyak
                    </option>
                </select>

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md">
                    Terapkan
                </button>
                <a href="{{ route('admin.categories.index') }}"
                class="bg-gray-200 px-4 py-2 rounded-md">
                    Reset
                </a>
            </form>
                <a href="{{ route('admin.categories.create') }}"
                    class="ml-auto px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    + Tambah Kategori
                </a>

        </div>
        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jumlah Produk</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $category->id }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $category->slug }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $category->products_count }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">

                                        <a
                                            href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="px-3 py-1 bg-yellow-400 text-gray-900 text-sm rounded hover:bg-yellow-500"
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

                                            <button
                                                type="submit"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
                                            >
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $categories->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>

    </div>
</x-app-layout>
