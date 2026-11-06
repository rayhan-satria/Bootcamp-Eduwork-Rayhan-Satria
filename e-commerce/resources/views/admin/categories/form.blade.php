<div class="mb-3">

    <label for="name" class="form-label">
        Nama Kategori
    </label>

    <input
        type="text"
        name="name"
        id="name"
        class="form-control"
        value="{{ old('name', $productCategory->name ?? '') }}"
        required
    >

    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror

</div>

<div class="mb-3">

    <label for="description" class="form-label">
        Deskripsi
    </label>

    <textarea
        name="description"
        id="description"
        class="form-control"
        rows="4"
    >{{ old('description', $productCategory->description ?? '') }}</textarea>

    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror

</div>