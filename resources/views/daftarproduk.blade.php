@extends('layouts.admin')

@section('title', 'Daftar Menu - RestoPOS')

@section('content')
<div class="flex flex-col w-full">
    <!-- Success Alert Notification -->
    @if (session('success'))
        <div id="alertSuccess" class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-xs transition-all animate-in fade-in duration-200" role="alert">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                </div>
                <div>
                    <p class="font-title-sm text-sm font-semibold">Berhasil!</p>
                    <p class="font-body-sm text-xs text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('alertSuccess').remove()" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100/60 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <!-- Validation Error Alert -->
    @if ($errors->any())
        <div id="alertError" class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 flex items-center justify-between shadow-xs transition-all animate-in fade-in duration-200" role="alert">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                </div>
                <div>
                    <p class="font-title-sm text-sm font-semibold">Terjadi Kesalahan</p>
                    @foreach ($errors->all() as $error)
                        <p class="font-body-sm text-xs text-red-700">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            <button type="button" onclick="document.getElementById('alertError').remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100/60 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <!-- Title & Action Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Daftar Menu</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Kelola katalog produk dan kategori restoran Anda.</p>
        </div>
    </div>

    <!-- Primary Tab Bar & Call to Action Row -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 bg-surface-container-lowest p-2 rounded-2xl shadow-sm">
        <!-- Tabs -->
        <div class="flex items-center gap-2">
            <a href="{{ url('/manager/produk') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-fixed/60 text-primary font-title-sm text-title-sm font-semibold transition-all" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                <span class="material-symbols-outlined text-[19px]">restaurant_menu</span>
                <span>Daftar Produk</span>
            </a>
            <a href="{{ url('/manager/kategori') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low font-title-sm text-title-sm transition-all">
                <span class="material-symbols-outlined text-[19px]">category</span>
                <span>Kategori</span>
            </a>
        </div>
        <!-- CTA Button -->
        <div class="flex items-center gap-2.5">
            <button type="button" onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-title-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Menu</span>
            </button>
        </div>
    </div>

    <!-- Modern Table Container -->
    <div class="w-full bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant">
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold w-20" scope="col">Foto</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold min-w-[240px]" scope="col">Nama Menu</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Kategori</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Harga</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Status</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold text-right w-28" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    @forelse ($products as $product)
                        @php
                            $imgSrc = null;
                            if ($product->image) {
                                $imgSrc = str_starts_with($product->image, 'http')
                                    ? $product->image
                                    : asset('storage/' . $product->image);
                            }
                        @endphp
                        <tr class="hover:bg-surface-container-low/60 transition-colors group">
                            <!-- Image -->
                            <td class="py-4 px-6 align-middle">
                                <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-slate-100 border border-slate-200/60 flex items-center justify-center shadow-xs">
                                    @if ($imgSrc)
                                        <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-slate-400 text-[22px]">restaurant</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Name & Description -->
                            <td class="py-4 px-6 align-middle">
                                <div class="flex flex-col">
                                    <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">{{ $product->name }}</span>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1 mt-0.5">
                                        {{ $product->description ? Str::limit($product->description, 50) : '-' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6 align-middle">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-on-surface font-label-md text-label-md font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                    <span>{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-4 px-6 align-middle">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold font-mono tracking-tight">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </td>

                            <!-- Status (is_active) -->
                            <td class="py-4 px-6 align-middle">
                                @if ($product->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-label-md text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Tersedia</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 font-label-md text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Habis</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 align-middle text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button" 
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-category_id="{{ $product->category_id }}"
                                            data-price="{{ $product->price }}"
                                            data-description="{{ $product->description ?? '' }}"
                                            data-is_active="{{ $product->is_active ? '1' : '0' }}"
                                            data-image="{{ $imgSrc ?? '' }}"
                                            onclick="openEditModal(this)"
                                            class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" 
                                            title="Edit Menu">
                                        <span class="material-symbols-outlined text-[19px]">edit</span>
                                    </button>
                                    <button type="button" 
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            onclick="openDeleteModal(this)"
                                            class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" 
                                            title="Hapus Menu">
                                        <span class="material-symbols-outlined text-[19px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-slate-400">restaurant_menu</span>
                                    <p class="font-title-sm text-sm font-semibold text-on-surface">Belum ada menu produk</p>
                                    <p class="font-body-sm text-xs text-on-surface-variant">Klik tombol "Tambah Menu" untuk memasukkan item pertama Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="py-4 px-6 bg-surface-container-lowest flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-surface-container-low">
            <div class="flex items-center gap-2">
                <span class="font-body-sm text-body-sm text-on-surface-variant">Menampilkan</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $products->count() > 0 ? '1 - ' . $products->count() : '0' }}</span>
                <span class="font-body-sm text-body-sm text-on-surface-variant">dari</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $products->count() }} total menu</span>
            </div>
            <!-- Pagination Buttons -->
            <div class="flex items-center gap-1.5">
                <button class="p-1.5 rounded-lg text-on-surface-variant/40 cursor-not-allowed flex items-center justify-center" disabled="" type="button">
                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                </button>
                <button class="w-8 h-8 rounded-lg bg-primary text-on-primary font-title-sm text-title-sm font-bold flex items-center justify-center shadow-xs" type="button" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    1
                </button>
                <button class="p-1.5 rounded-lg text-on-surface-variant/40 cursor-not-allowed flex items-center justify-center" disabled="" type="button">
                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL TAMBAH MENU PRODUK                    -->
<!-- ========================================== -->
<div id="addProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-lg overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150 my-8">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Tambah Menu Baru</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Lengkapi data produk untuk dimasukkan ke katalog</p>
                </div>
            </div>
            <button type="button" onclick="closeAddModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('manager.produk.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-6 flex flex-col gap-4 max-h-[70vh] overflow-y-auto">
                <!-- Nama Menu -->
                <div>
                    <label for="addProductName" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Nama Menu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="addProductName" 
                           name="name" 
                           required 
                           placeholder="Contoh: Nasi Goreng Spesial" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Kategori & Harga Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Kategori -->
                    <div>
                        <label for="addProductCategoryId" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="addProductCategoryId" 
                                name="category_id" 
                                required 
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface bg-white shadow-xs transition-all">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="addProductPrice" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="addProductPrice" 
                               name="price" 
                               required 
                               min="0" 
                               step="500" 
                               placeholder="35000" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="addProductDescription" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Deskripsi
                    </label>
                    <textarea id="addProductDescription" 
                              name="description" 
                              rows="3" 
                              placeholder="Deskripsi singkat mengenai porsi atau bahan menu..." 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all"></textarea>
                </div>

                <!-- Foto Menu -->
                <div>
                    <label for="addProductImage" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Foto Produk (Opsional)
                    </label>
                    <input type="file" 
                           id="addProductImage" 
                           name="image" 
                           accept="image/*" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-sm text-on-surface file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 bg-white transition-all">
                    <p class="text-[11px] text-on-surface-variant mt-1">Format: JPG, PNG, WEBP (Maksimal 2MB)</p>
                </div>

                <!-- Status Ketersediaan (Toggle) -->
                <div class="pt-2 border-t border-surface-container-low flex items-center justify-between">
                    <div>
                        <span class="block font-title-sm text-sm font-semibold text-on-surface">Status Menu</span>
                        <span class="text-xs text-on-surface-variant">Tentukan apakah menu ini aktif dan dapat dipesan kasir</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600 shadow-inner"></div>
                    </label>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-surface-container-low/50 border-t border-surface-container-low flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 rounded-xl font-title-sm text-sm font-semibold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL EDIT MENU PRODUK                      -->
<!-- ========================================== -->
<div id="editProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-lg overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150 my-8">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Edit Menu</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Perbarui informasi dan ketersediaan menu</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 flex flex-col gap-4 max-h-[70vh] overflow-y-auto">
                <!-- Nama Menu -->
                <div>
                    <label for="editProductName" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Nama Menu <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="editProductName" 
                           name="name" 
                           required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Kategori & Harga Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Kategori -->
                    <div>
                        <label for="editProductCategoryId" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="editProductCategoryId" 
                                name="category_id" 
                                required 
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface bg-white shadow-xs transition-all">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="editProductPrice" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="editProductPrice" 
                               name="price" 
                               required 
                               min="0" 
                               step="500" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="editProductDescription" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Deskripsi
                    </label>
                    <textarea id="editProductDescription" 
                              name="description" 
                              rows="3" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all"></textarea>
                </div>

                <!-- Foto Menu Preview & Upload -->
                <div>
                    <label for="editProductImage" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Ganti Foto Produk (Opsional)
                    </label>
                    <div id="editProductImageCurrentContainer" class="hidden items-center gap-3 mb-2 p-2 rounded-xl bg-slate-50 border border-slate-200">
                        <img id="editProductImagePreview" src="" alt="Preview" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                        <span class="text-xs text-on-surface-variant">Foto saat ini aktif. Pilih file baru untuk menggantinya.</span>
                    </div>
                    <input type="file" 
                           id="editProductImage" 
                           name="image" 
                           accept="image/*" 
                           class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-sm text-on-surface file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 bg-white transition-all">
                    <p class="text-[11px] text-on-surface-variant mt-1">Biarkan kosong jika tidak ingin mengubah foto</p>
                </div>

                <!-- Status Ketersediaan (Toggle) -->
                <div class="pt-2 border-t border-surface-container-low flex items-center justify-between">
                    <div>
                        <span class="block font-title-sm text-sm font-semibold text-on-surface">Status Menu</span>
                        <span class="text-xs text-on-surface-variant">Tentukan apakah menu ini aktif dan dapat dipesan kasir</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" id="editProductIsActive" name="is_active" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600 shadow-inner"></div>
                    </label>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-surface-container-low/50 border-t border-surface-container-low flex items-center justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl font-title-sm text-sm font-semibold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL KONFIRMASI HAPUS                      -->
<!-- ========================================== -->
<div id="deleteProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-sm overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <div class="p-6 text-center">
            <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-[30px]">delete_forever</span>
            </div>
            <h3 class="font-headline-md text-lg text-on-surface font-bold mb-2">Hapus Menu?</h3>
            <p class="font-body-md text-sm text-on-surface-variant">
                Apakah Anda yakin ingin menghapus <span id="deleteProductNameDisplay" class="font-bold text-on-surface"></span>?
            </p>
            <p class="font-body-sm text-xs text-red-500 mt-2">
                Tindakan ini tidak dapat dibatalkan dan foto terkait akan dihapus dari server.
            </p>
        </div>

        <form id="deleteProductForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="px-6 py-4 bg-surface-container-low/50 border-t border-surface-container-low flex items-center justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2.5 rounded-xl font-title-sm text-sm font-semibold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-title-sm text-sm font-semibold shadow-sm active:scale-[0.98] transition-all">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript Interactivity -->
<script>
    const productBaseUrl = "{{ url('/manager/produk') }}";

    // --- Modal Tambah Menu ---
    function openAddModal() {
        const modal = document.getElementById('addProductModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('addProductName');
            if (input) input.focus();
        }, 50);
    }

    function closeAddModal() {
        const modal = document.getElementById('addProductModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // --- Modal Edit Menu ---
    function openEditModal(button) {
        const modal = document.getElementById('editProductModal');
        const form = document.getElementById('editProductForm');
        
        const id = button.dataset.id;
        const name = button.dataset.name;
        const categoryId = button.dataset.category_id;
        const price = button.dataset.price;
        const description = button.dataset.description;
        const isActive = button.dataset.is_active === '1';
        const image = button.dataset.image;

        form.action = `${productBaseUrl}/${id}`;

        document.getElementById('editProductName').value = name || '';
        document.getElementById('editProductCategoryId').value = categoryId || '';
        document.getElementById('editProductPrice').value = price || '';
        document.getElementById('editProductDescription').value = description || '';
        document.getElementById('editProductIsActive').checked = isActive;

        // Reset file input
        document.getElementById('editProductImage').value = '';

        // Handle image preview
        const currentContainer = document.getElementById('editProductImageCurrentContainer');
        const previewImg = document.getElementById('editProductImagePreview');
        if (image) {
            previewImg.src = image;
            currentContainer.classList.remove('hidden');
            currentContainer.classList.add('flex');
        } else {
            previewImg.src = '';
            currentContainer.classList.add('hidden');
            currentContainer.classList.remove('flex');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('editProductName');
            if (input) {
                input.focus();
                input.select();
            }
        }, 50);
    }

    function closeEditModal() {
        const modal = document.getElementById('editProductModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // --- Modal Hapus Menu ---
    function openDeleteModal(button) {
        const modal = document.getElementById('deleteProductModal');
        const form = document.getElementById('deleteProductForm');
        const nameDisplay = document.getElementById('deleteProductNameDisplay');

        const id = button.dataset.id;
        const name = button.dataset.name;

        form.action = `${productBaseUrl}/${id}`;
        nameDisplay.textContent = `"${name}"`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteProductModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close on Escape key
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
            closeDeleteModal();
        }
    });

    // Close when clicking on backdrop
    ['addProductModal', 'editProductModal', 'deleteProductModal'].forEach(function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    if (modalId === 'addProductModal') closeAddModal();
                    if (modalId === 'editProductModal') closeEditModal();
                    if (modalId === 'deleteProductModal') closeDeleteModal();
                }
            });
        }
    });
</script>
@endsection
