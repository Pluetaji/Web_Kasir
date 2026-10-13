@extends('layouts.admin')

@section('title', 'Kategori Menu - RestoPOS')

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
            <a href="{{ url('/manager/produk') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low font-title-sm text-title-sm transition-all">
                <span class="material-symbols-outlined text-[19px]">restaurant_menu</span>
                <span>Daftar Produk</span>
            </a>
            <a href="{{ url('/manager/kategori') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary-fixed/60 text-primary font-title-sm text-title-sm font-semibold transition-all" style="background-color: rgb(236, 253, 245); color: rgb(5, 150, 105);">
                <span class="material-symbols-outlined text-[19px]">category</span>
                <span>Kategori</span>
            </a>
        </div>
        <!-- CTA Button -->
        <div class="flex items-center gap-2.5">
            <button type="button" onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-title-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Kategori</span>
            </button>
        </div>
    </div>

    <!-- Modern Table Container -->
    <div class="w-full bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant">
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Nama Kategori</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold text-right w-36" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-surface-container-low/60 transition-colors group">
                            <td class="py-4 px-6 align-middle">
                                <span class="font-title-sm text-title-sm text-on-surface font-semibold group-hover:text-primary transition-colors">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-6 align-middle text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button" 
                                            data-id="{{ $category->id }}" 
                                            data-name="{{ $category->name }}"
                                            onclick="openEditModal(this.dataset.id, this.dataset.name)"
                                            class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" 
                                            title="Edit Kategori">
                                        <span class="material-symbols-outlined text-[19px]">edit</span>
                                    </button>
                                    <button type="button" 
                                            data-id="{{ $category->id }}" 
                                            data-name="{{ $category->name }}"
                                            onclick="openDeleteModal(this.dataset.id, this.dataset.name)"
                                            class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" 
                                            title="Hapus Kategori">
                                        <span class="material-symbols-outlined text-[19px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-12 px-6 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant text-slate-400">category</span>
                                    <p class="font-title-sm text-sm font-semibold text-on-surface">Belum ada kategori</p>
                                    <p class="font-body-sm text-xs text-on-surface-variant">Klik tombol "Tambah Kategori" untuk menambahkan kategori baru.</p>
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
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $categories->count() > 0 ? '1 - ' . $categories->count() : '0' }}</span>
                <span class="font-body-sm text-body-sm text-on-surface-variant">dari</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $categories->count() }} total kategori</span>
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
<!-- MODAL TAMBAH KATEGORI                       -->
<!-- ========================================== -->
<div id="addCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">add_circle</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Tambah Kategori</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Tambahkan kategori menu restoran baru</p>
                </div>
            </div>
            <button type="button" onclick="closeAddModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('manager.kategori.store') }}">
            @csrf
            <div class="p-6 flex flex-col gap-4">
                <div>
                    <label for="addCategoryName" class="block font-title-sm text-sm font-semibold text-on-surface mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="addCategoryName" 
                           name="name" 
                           required 
                           autocomplete="off"
                           placeholder="Contoh: Makanan Utama, Minuman Dingin" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>
            </div>
            <div class="px-6 py-4 bg-surface-container-low/50 border-t border-surface-container-low flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 rounded-xl font-title-sm text-sm font-semibold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL EDIT KATEGORI                         -->
<!-- ========================================== -->
<div id="editCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Edit Kategori</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Perbarui nama kategori yang dipilih</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form id="editCategoryForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6 flex flex-col gap-4">
                <div>
                    <label for="editCategoryName" class="block font-title-sm text-sm font-semibold text-on-surface mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="editCategoryName" 
                           name="name" 
                           required 
                           autocomplete="off"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>
            </div>
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
<div id="deleteCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-sm overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <div class="p-6 text-center">
            <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-[30px]">delete_forever</span>
            </div>
            <h3 class="font-headline-md text-lg text-on-surface font-bold mb-2">Hapus Kategori?</h3>
            <p class="font-body-md text-sm text-on-surface-variant">
                Apakah Anda yakin ingin menghapus kategori <span id="deleteCategoryNameDisplay" class="font-bold text-on-surface"></span>?
            </p>
            <p class="font-body-sm text-xs text-red-500 mt-2">
                Peringatan: Menu yang terikat dengan kategori ini mungkin ikut terhapus.
            </p>
        </div>

        <form id="deleteCategoryForm" method="POST" action="">
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
    const categoryBaseUrl = "{{ url('/manager/kategori') }}";

    // --- Modal Tambah Kategori ---
    function openAddModal() {
        const modal = document.getElementById('addCategoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('addCategoryName');
            if (input) input.focus();
        }, 50);
    }

    function closeAddModal() {
        const modal = document.getElementById('addCategoryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        const input = document.getElementById('addCategoryName');
        if (input) input.value = '';
    }

    // --- Modal Edit Kategori ---
    function openEditModal(id, name) {
        const modal = document.getElementById('editCategoryModal');
        const form = document.getElementById('editCategoryForm');
        const input = document.getElementById('editCategoryName');

        form.action = `${categoryBaseUrl}/${id}`;
        input.value = name;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            if (input) {
                input.focus();
                input.select();
            }
        }, 50);
    }

    function closeEditModal() {
        const modal = document.getElementById('editCategoryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // --- Modal Hapus Kategori ---
    function openDeleteModal(id, name) {
        const modal = document.getElementById('deleteCategoryModal');
        const form = document.getElementById('deleteCategoryForm');
        const nameDisplay = document.getElementById('deleteCategoryNameDisplay');

        form.action = `${categoryBaseUrl}/${id}`;
        nameDisplay.textContent = `"${name}"`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteCategoryModal');
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
    ['addCategoryModal', 'editCategoryModal', 'deleteCategoryModal'].forEach(function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    if (modalId === 'addCategoryModal') closeAddModal();
                    if (modalId === 'editCategoryModal') closeEditModal();
                    if (modalId === 'deleteCategoryModal') closeDeleteModal();
                }
            });
        }
    });
</script>
@endsection
