<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    // Menampilkan daftar kategori untuk
    public function manage(Request $request)
    {
        $query = ProductCategory::withCount('products');

        // Search berdasarkan nama kategori
        if ($request->filled('search')) {
            $query  ->where(function ($q) use ($request) {
                $q  ->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('slug', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sortOptions = [
            'name_asc'  => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'products_asc'  => ['products_count', 'asc'],
            'products_desc' => ['products_count', 'desc'],
        ];

        $sort = $request->input('sort');

        if (isset($sortOptions[$sort])) {
            $query->orderBy(...$sortOptions[$sort]);
        } else {
            $query->latest();
        }

    $categories = $query->paginate(10)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $originalSlug = $validated['slug'];
        $counter = 1;

        while (ProductCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        ProductCategory::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ProductCategory $productCategory)
    {
        $products = $productCategory->products()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('categories.show', compact(
            'productCategory',
            'products'
        ));
    }
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $productCategory->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $originalSlug = $validated['slug'];
        $counter = 1;

        while (
            ProductCategory::where('slug', $validated['slug'])
                ->where('id', '!=', $productCategory->id)
                ->exists()
        ) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $productCategory->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->products()->exists()) {
            return back()->with(
                'error',
                'Kategori masih memiliki produk. Pindahkan atau hapus produknya terlebih dahulu.'
            );
        }

        $productCategory->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
