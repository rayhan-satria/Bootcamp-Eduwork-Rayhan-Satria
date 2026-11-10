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
                <button
                    type="button"
                    onclick="document.getElementById('createCategoryModal').showModal()"
                    class="px-4 py-2 ml-auto bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    + Tambah Kategori
                </button>

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
                <table class="min-w-full divide-y divide-gray-200 table">

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

                                        <button
                                            type="button"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            onclick="openEditModal(this)"
                                            class="px-3 py-1 bg-yellow-400 text-gray-900 text-sm rounded hover:bg-yellow-500">
                                            Edit
                                        </button>

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
    <dialog id="createCategoryModal"
    class="w-full max-w-md rounded-xl p-0 shadow-xl backdrop:bg-black/50">

    <div class="p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Tambah Kategori
        </h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Contoh: Elektronik"
                >

                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

                <label for="description" class="block text-sm font-medium text-gray-700 mb-2 mt-3">
                    Deskripsi Kategori
                </label>

                <input
                    type="text"
                    name="description"
                    id="description"
                    value="{{ old('description') }}"
                    required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Tuliskan deskripsi kategori..."
                >

                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button
                    type="button"
                    onclick="document.getElementById('createCategoryModal').close()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</dialog>
<dialog id="editCategoryModal" class="w-full max-w-md rounded-xl p-0 shadow-xl backdrop:bg-black/50">
    <div class="p-6">

        <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

        <form id="editCategoryForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="editName" class="block text-sm font-medium mb-1">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    id="editName"
                    required
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium mb-1">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    id="editDescription"
                    rows="3"
                    class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    onclick="document.getElementById('editCategoryModal').close()"
                    class="px-4 py-2 bg-gray-200 rounded-lg">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</dialog>
<script>
    function openEditModal(button) {
        const categoryId = button.dataset.id;
        const categoryName = button.dataset.name;
        const categoryDescription = button.dataset.description;

        const form = document.getElementById('editCategoryForm');

        const updateUrl = @json(route('admin.categories.update', ['productCategory' => '__ID__']));

        form.action = updateUrl.replace('__ID__', categoryId);

        document.getElementById('editName').value = categoryName;
        document.getElementById('editDescription').value = categoryDescription;

        document.getElementById('editCategoryModal').showModal();
    }
</script>
</x-app-layout>
