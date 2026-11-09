<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
    
        <div class="container flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.products.index') }}" method="GET"
                class="flex flex-wrap gap-3 my-4">

                {{-- Search --}}
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk..."
                    class="border-gray-300 rounded-md shadow-sm"
                >

                {{-- Filter kategori --}}
                <select name="category" class="border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Kategori</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Sorting --}}
                <select name="sort" class="border-gray-300 rounded-md shadow-sm">
                    <option value="">Urutan Default</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                        Nama A-Z
                    </option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                        Nama Z-A
                    </option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                        Harga Terendah
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                        Harga Tertinggi
                    </option>
                    <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>
                        Stok Terendah
                    </option>
                    <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>
                        Stok Tertinggi
                    </option>
                </select>

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md">
                    Terapkan
                </button>

                <a href="{{ route('admin.products.index') }}"
                class="bg-gray-200 px-4 py-2 rounded-md">
                    Reset
                </a>
            </form>

                <button
                    type="button"
                    onclick="document.getElementById('createProductModal').showModal()"
                    class="px-4 py-2 ml-auto bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    + Tambah Produk
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
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    @if ($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            class="w-16 h-16 object-cover rounded-md"
                                            alt="{{ $product->name }}"
                                        >
                                    @else
                                        <span class="text-gray-400">Tidak ada gambar</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $product->id }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $product->category->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                    {{ $product->description ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $product->stock }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">

                                        <button
                                            type="button"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-category="{{ $product->product_category_id }}"
                                            data-description="{{ $product->description }}"
                                            data-price="{{ $product->price }}"
                                            data-stock="{{ $product->stock }}"
                                            data-image="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                                            onclick="openEditModal(this)"
                                            class="px-3 py-1 bg-yellow-400 text-gray-900 text-sm rounded hover:bg-yellow-500">
                                            Edit
                                        </button>

                                        <form
                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
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
            {{ $products->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>

    </div>
    <dialog id="createProductModal"
        class="w-full max-w-md rounded-xl p-0 shadow-xl backdrop:bg-black/50">

        <div class="p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-5">
                Tambah Produk
            </h2>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Contoh: Sepatu"
                    >

                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <label for="product_category_id" class="block text-sm font-medium text-gray-700 mb-2 mt-3">
                        Kategori
                    </label>

                        <select name="product_category_id" id="product_category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    @error('product_category_id')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2 mt-3">
                        Deskripsi Produk
                    </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm"
                            placeholder="Tuliskan deskripsi produk...">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2 mt-3">
                        Harga Produk
                    </label>

                    <input
                        type="number"
                        onkeydown="return event.key !== 'e' && event.key !== 'E'"
                        name="price"
                        id="price"
                        value="{{ old('price') }}"
                        required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan harga produk..."
                    >

                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2 mt-3">
                        Stok Produk
                    </label>

                    <input
                        type="number"
                        onkeydown="return event.key !== 'e' && event.key !== 'E'"
                        name="stock"
                        id="stock"
                        value="{{ old('stock') }}"
                        required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Masukkan stok produk..."
                    >

                    @error('stock')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-4">
                        <label for="createImageInput" class="block mb-2 font-medium">
                            Gambar Produk
                        </label>

                        <input
                            type="file"
                            name="image"
                            id="createImageInput"
                            accept="image/*"
                            required
                            class="w-full border rounded p-2"
                        >

                        {{-- Area Crop --}}
                        <div id="createCropperWrapper" class="hidden mt-4">

                            <div id="createImageCropper"></div>

                            <button
                                type="button"
                                id="cropCreateImage"
                                class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Terapkan Crop
                            </button>

                        </div>

                        {{-- Preview Hasil Crop --}}
                        <div class="mt-4">
                            <img
                                id="createImagePreview"
                                src=""
                                alt="Preview gambar produk"
                                class="hidden w-48 h-48 object-cover rounded border"
                            >
                        </div>
                    </div>                
                </div>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="document.getElementById('createProductModal').close()"
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

    <dialog id="editProductModal" class="w-full max-w-md rounded-xl p-0 shadow-xl backdrop:bg-black/50">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Edit Produk</h2>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="editName"
                        required
                        class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="mb-4">

                    <label for="editCategory" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori
                    </label>

                        <select
                            name="product_category_id"
                            id="editCategory"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            <option value="">Pilih Kategori</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>                
                </div>

                <div class="mb-4">
                    <label for="editDescription" class="block text-sm font-medium mb-1">
                        Deskripsi Produk
                    </label>
                        <textarea
                            name="description"
                            id="editDescription"
                            rows="3"
                            class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label for="editPrice" class="block text-sm font-medium mb-1">
                        Harga Produk
                    </label>

                    <input
                        type="number"
                        name="price"
                        id="editPrice"
                        min="0"
                        step="1"
                        required
                        class="w-full border rounded-lg px-3 py-2"
                    >
                </div>

                <div class="mb-4">
                    <label for="editStock" class="block text-sm font-medium mb-1">
                        Stok Produk
                    </label>

                    <input
                        type="number"
                        name="stock"
                        id="editStock"
                        min="0"
                        required
                        class="w-full border rounded-lg px-3 py-2"
                    >                
                </div>

                <div class="mb-4">
                    <label for="editImageInput" class="block mb-2 font-medium">
                        Ganti Gambar Produk
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="editImageInput"
                        accept="image/*"
                        class="w-full border rounded p-2"
                    >

                    {{-- Area Crop --}}
                    <div id="editCropperWrapper" class="hidden mt-4">
                        <div id="editImageCropper"></div>

                        <button
                            type="button"
                            id="cropEditImage"
                            class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Terapkan Crop
                        </button>
                    </div>

                    {{-- Preview Gambar --}}
                    <div class="mt-4">
                        <img
                            id="editImagePreview"
                            src=""
                            alt="Preview gambar produk"
                            class="hidden w-48 h-48 object-cover rounded border"
                        >
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button
                        type="button"
                        onclick="document.getElementById('editProductModal').close()"
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
            const productId = button.dataset.id;

            const form = document.getElementById('editProductForm');

            const updateUrl = @json(route('admin.products.update', ['product' => '__ID__']));

            form.action = updateUrl.replace('__ID__', productId);

            document.getElementById('editName').value = button.dataset.name;
            document.getElementById('editCategory').value = button.dataset.category;
            document.getElementById('editDescription').value = button.dataset.description;
            document.getElementById('editPrice').value = button.dataset.price;
            document.getElementById('editStock').value = button.dataset.stock;

            // Tampilkan gambar lama
            const editImagePreview = document.getElementById('editImagePreview');

            if (button.dataset.image) {
                editImagePreview.src = button.dataset.image;
                editImagePreview.classList.remove('hidden');
            } else {
                editImagePreview.src = '';
                editImagePreview.classList.add('hidden');
            }

            // Reset input gambar
            document.getElementById('editImageInput').value = '';
                if (editCropper) {
                    editCropper.destroy();
                    editCropper = null;
                }

editCropperWrapper.classList.add('hidden');

            document.getElementById('editProductModal').showModal();
        }

        let createCropper = null;

            const createImageInput = document.getElementById('createImageInput');
            const createCropperWrapper = document.getElementById('createCropperWrapper');
            const createImageCropper = document.getElementById('createImageCropper');

            createImageInput.addEventListener('change', function (event) {
                const file = event.target.files[0];

                if (!file) return;

                // Hapus instance cropper sebelumnya
                if (createCropper) {
                    createCropper.destroy();
                }

                // Tampilkan area crop
                createCropperWrapper.classList.remove('hidden');

                // Inisialisasi Croppie
                createCropper = new Croppie(createImageCropper, {
                    viewport: {
                        width: 250,
                        height: 250,
                        type: 'square'
                    },
                    boundary: {
                        width: 350,
                        height: 300
                    },
                    enableZoom: true
                });

                // Baca gambar yang dipilih
                const reader = new FileReader();

                reader.onload = function (e) {
                    createCropper.bind({
                        url: e.target.result
                    });
                };

                reader.readAsDataURL(file);
            });

            const cropCreateImage = document.getElementById('cropCreateImage');
            const createImagePreview = document.getElementById('createImagePreview');

            cropCreateImage.addEventListener('click', async function () {

                if (!createCropper) return;

                // Ambil hasil crop
                const croppedBlob = await createCropper.result({
                    type: 'blob',
                    size: 'viewport',
                    format: 'webp',
                    quality: 0.8
                });

                // Ubah Blob menjadi File
                const croppedFile = new File(
                    [croppedBlob],
                    'product-image.webp',
                    { type: 'image/webp' }
                );

                // Masukkan hasil crop ke input file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);

                createImageInput.files = dataTransfer.files;

                // Tampilkan preview
                createImagePreview.src = URL.createObjectURL(croppedBlob);
                createImagePreview.classList.remove('hidden');

                // Sembunyikan area crop
                createCropperWrapper.classList.add('hidden');

                // Hapus instance cropper
                createCropper.destroy();
                createCropper = null;
            });

        let editCropper = null;

        const editImageInput = document.getElementById('editImageInput');
        const editCropperWrapper = document.getElementById('editCropperWrapper');
        const editImageCropper = document.getElementById('editImageCropper');
        const editImagePreview = document.getElementById('editImagePreview');

        editImageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) return;

            if (editCropper) {
                editCropper.destroy();
            }

            editCropperWrapper.classList.remove('hidden');

            editCropper = new Croppie(editImageCropper, {
                viewport: {
                    width: 250,
                    height: 250,
                    type: 'square'
                },
                boundary: {
                    width: 350,
                    height: 300
                },
                enableZoom: true
            });

            const reader = new FileReader();

            reader.onload = function (e) {
                editCropper.bind({
                    url: e.target.result
                });
            };

            reader.readAsDataURL(file);
        });

        const cropEditImage = document.getElementById('cropEditImage');

            cropEditImage.addEventListener('click', async function () {

                if (!editCropper) return;

                const croppedBlob = await editCropper.result({
                    type: 'blob',
                    size: 'viewport',
                    format: 'webp',
                    quality: 0.8
                });

                const croppedFile = new File(
                    [croppedBlob],
                    'product-image.webp',
                    { type: 'image/webp' }
                );

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);

                editImageInput.files = dataTransfer.files;

                editImagePreview.src = URL.createObjectURL(croppedBlob);
                editImagePreview.classList.remove('hidden');

                editCropperWrapper.classList.add('hidden');

                editCropper.destroy();
                editCropper = null;
            });
    </script>

</x-app-layout>
