@extends('layouts.admin')

@section('title', 'Manajemen Pengguna - RestoPOS')

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

    <!-- Error Alert Notification -->
    @if (session('error'))
        <div id="alertErrorSession" class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 flex items-center justify-between shadow-xs transition-all animate-in fade-in duration-200" role="alert">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                </div>
                <div>
                    <p class="font-title-sm text-sm font-semibold">Peringatan</p>
                    <p class="font-body-sm text-xs text-red-700">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('alertErrorSession').remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100/60 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <!-- Validation Error Alert -->
    @if ($errors->any())
        <div id="alertValidation" class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 flex items-center justify-between shadow-xs transition-all animate-in fade-in duration-200" role="alert">
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
            <button type="button" onclick="document.getElementById('alertValidation').remove()" class="text-red-600 hover:text-red-800 p-1 rounded-lg hover:bg-red-100/60 transition-colors">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <!-- Title & Action Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">Manajemen Pengguna</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-0.5">Kelola hak akses akun manajer dan kasir restoran Anda.</p>
        </div>
        <div>
            <button type="button" onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-title-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                <span>Tambah Pengguna</span>
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="w-full bg-surface-container-lowest rounded-2xl shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant">
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold min-w-[220px]" scope="col">Nama Pengguna</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Email</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Peran</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Status</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold text-right w-28" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    @forelse ($users as $user)
                        <tr class="hover:bg-surface-container-low/60 transition-colors group">
                            <!-- Name & Initial -->
                            <td class="py-4 px-6 align-middle">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm shadow-xs shrink-0 {{ $user->role === 'manager' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2">
                                            <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">{{ $user->name }}</span>
                                            @if (auth()->id() === $user->id)
                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">Anda</span>
                                            @endif
                                        </div>
                                        <span class="font-body-sm text-body-sm text-on-surface-variant text-xs">ID #{{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="py-4 px-6 align-middle">
                                <span class="font-body-md text-sm text-on-surface select-all">{{ $user->email }}</span>
                            </td>

                            <!-- Role Badge -->
                            <td class="py-4 px-6 align-middle">
                                @if ($user->role === 'manager')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Manajer</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        <span>Kasir</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Status Pill -->
                            <td class="py-4 px-6 align-middle">
                                @if ($user->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-label-md text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Aktif</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 font-label-md text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        <span>Nonaktif</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 align-middle text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button" 
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            onclick="openEditModal(this)"
                                            class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" 
                                            title="Edit Pengguna">
                                        <span class="material-symbols-outlined text-[19px]">edit</span>
                                    </button>

                                    <!-- Quick Toggle Status Form -->
                                    <form method="POST" action="{{ route('pengguna.toggleStatus', $user->id) }}" class="inline">
                                        @csrf
                                        @method('PUT')
                                        @if (auth()->id() === $user->id)
                                            <button type="button" disabled class="p-2 rounded-xl text-slate-300 cursor-not-allowed" title="Tidak dapat menonaktifkan akun sendiri">
                                                <span class="material-symbols-outlined text-[19px]">lock</span>
                                            </button>
                                        @elseif ($user->is_active)
                                            <button type="submit" 
                                                    class="p-2 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" 
                                                    title="Nonaktifkan Pengguna">
                                                <span class="material-symbols-outlined text-[19px]">person_off</span>
                                            </button>
                                        @else
                                            <button type="submit" 
                                                    class="p-2 rounded-xl text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 transition-colors" 
                                                    title="Aktifkan Pengguna">
                                                <span class="material-symbols-outlined text-[19px]">check_circle</span>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-slate-400">group_off</span>
                                    <p class="font-title-sm text-sm font-semibold text-on-surface">Belum ada pengguna</p>
                                    <p class="font-body-sm text-xs text-on-surface-variant">Klik tombol "Tambah Pengguna" untuk menambahkan staf restoran.</p>
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
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $users->count() > 0 ? '1 - ' . $users->count() : '0' }}</span>
                <span class="font-body-sm text-body-sm text-on-surface-variant">dari</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">{{ $users->count() }} total pengguna</span>
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
<!-- MODAL TAMBAH PENGGUNA                       -->
<!-- ========================================== -->
<div id="addUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150 my-8">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Tambah Pengguna Baru</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Daftarkan akun kasir atau manajer restoran</p>
                </div>
            </div>
            <button type="button" onclick="closeAddModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('manager.pengguna.store') }}">
            @csrf
            <div class="p-6 flex flex-col gap-4">
                <!-- Nama Lengkap -->
                <div>
                    <label for="addUserName" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="addUserName" 
                           name="name" 
                           required 
                           placeholder="Contoh: Siti Nurhaliza" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Email -->
                <div>
                    <label for="addUserEmail" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Email Login <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="addUserEmail" 
                           name="email" 
                           required 
                           placeholder="contoh@restopos.id" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Peran (Role) -->
                <div>
                    <label for="addUserRole" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Peran / Hak Akses <span class="text-red-500">*</span>
                    </label>
                    <select id="addUserRole" 
                            name="role" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface bg-white shadow-xs transition-all">
                        <option value="kasir" selected>Kasir (Akses Kasir POS)</option>
                        <option value="manager">Manajer (Akses Penuh Dashboard)</option>
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label for="addUserPassword" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input type="password" 
                           id="addUserPassword" 
                           name="password" 
                           required 
                           minlength="6"
                           placeholder="Minimal 6 karakter" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-surface-container-low/50 border-t border-surface-container-low flex items-center justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 rounded-xl font-title-sm text-sm font-semibold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ========================================== -->
<!-- MODAL EDIT PENGGUNA                         -->
<!-- ========================================== -->
<div id="editUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto transition-all">
    <div class="bg-surface-container-lowest rounded-2xl shadow-2xl border border-slate-100 w-full max-w-md overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150 my-8">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-surface-container-low flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100 text-emerald-700">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </div>
                <div>
                    <h3 class="font-title-sm text-title-sm text-on-surface font-bold">Edit Pengguna</h3>
                    <p class="font-body-sm text-xs text-on-surface-variant">Perbarui profil, peran, atau status pengguna</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-on-surface-variant hover:text-on-surface p-1 rounded-lg hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Form -->
        <form id="editUserForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6 flex flex-col gap-4">
                <!-- Nama Lengkap -->
                <div>
                    <label for="editUserName" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="editUserName" 
                           name="name" 
                           required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Email -->
                <div>
                    <label for="editUserEmail" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Email Login <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="editUserEmail" 
                           name="email" 
                           required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                </div>

                <!-- Peran (Role) -->
                <div>
                    <label for="editUserRole" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Peran / Hak Akses <span class="text-red-500">*</span>
                    </label>
                    <select id="editUserRole" 
                            name="role" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface bg-white shadow-xs transition-all">
                        <option value="kasir">Kasir (Akses Kasir POS)</option>
                        <option value="manager">Manajer (Akses Penuh Dashboard)</option>
                    </select>
                </div>

                <!-- Password (Optional) -->
                <div>
                    <label for="editUserPassword" class="block font-title-sm text-sm font-semibold text-on-surface mb-1.5">
                        Kata Sandi Baru
                    </label>
                    <input type="password" 
                           id="editUserPassword" 
                           name="password" 
                           minlength="6"
                           placeholder="Kosongkan jika tidak ingin mengubah password" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent text-body-md font-medium text-on-surface placeholder:text-slate-400 bg-white shadow-xs transition-all">
                    <p class="text-[11px] text-on-surface-variant mt-1">Biarkan kosong untuk mempertahankan kata sandi saat ini.</p>
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

<!-- JavaScript Interactivity -->
<script>
    const userBaseUrl = "{{ url('/manager/pengguna') }}";

    // --- Modal Tambah Pengguna ---
    function openAddModal() {
        const modal = document.getElementById('addUserModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('addUserName');
            if (input) input.focus();
        }, 50);
    }

    function closeAddModal() {
        const modal = document.getElementById('addUserModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        const form = modal.querySelector('form');
        if (form) form.reset();
    }

    // --- Modal Edit Pengguna ---
    function openEditModal(button) {
        const modal = document.getElementById('editUserModal');
        const form = document.getElementById('editUserForm');
        
        const id = button.dataset.id;
        const name = button.dataset.name;
        const email = button.dataset.email;
        const role = button.dataset.role;

        form.action = `${userBaseUrl}/${id}`;

        document.getElementById('editUserName').value = name || '';
        document.getElementById('editUserEmail').value = email || '';
        document.getElementById('editUserRole').value = role || 'kasir';
        document.getElementById('editUserPassword').value = '';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            const input = document.getElementById('editUserName');
            if (input) {
                input.focus();
                input.select();
            }
        }, 50);
    }

    function closeEditModal() {
        const modal = document.getElementById('editUserModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close on Escape key
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });

    // Close when clicking on backdrop
    ['addUserModal', 'editUserModal'].forEach(function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    if (modalId === 'addUserModal') closeAddModal();
                    if (modalId === 'editUserModal') closeEditModal();
                }
            });
        }
    });
</script>
@endsection
