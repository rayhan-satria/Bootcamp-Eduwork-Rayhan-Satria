<div class="mb-3">
    <label class="form-label">Nama Produk</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $product->name ?? '') }}"
        required
    >

    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>

    <select name="product_category_id" class="form-select" required>
        <option value="">Pilih Kategori</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(old('product_category_id', $product->product_category_id ?? '') == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('product_category_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>

    <textarea
        name="description"
        class="form-control"
        rows="4"
    >{{ old('description', $product->description ?? '') }}</textarea>

    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Harga</label>

    <input
        type="number"
        name="price"
        class="form-control"
        min="0"
        step="0.01"
        value="{{ old('price', $product->price ?? '') }}"
        required
    >

    @error('price')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Stok</label>

    <input
        type="number"
        name="stock"
        class="form-control"
        min="0"
        value="{{ old('stock', $product->stock ?? 0) }}"
        required
    >

    @error('stock')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Gambar Produk</label>

    <input
        type="file"
        name="image"
        class="form-control"
        accept="image/jpeg,image/png,image/webp"
    >

    @error('image')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    @if (isset($product) && $product->image)
        <div class="mt-3">
            <p>Gambar saat ini:</p>

            <img
                src="{{ asset('storage/' . $product->image) }}"
                width="150"
                alt="{{ $product->name }}"
            >
        </div>
    @endif
</div>