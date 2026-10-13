@extends('layouts.admin')

@section('title', 'Manajemen Pengguna - RestoPOS')

@section('content')
<div class="flex flex-col w-full">
    <!-- Title & Action Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex flex-col">
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola hak akses dan akun karyawan restoran.</p>
        </div>
        <div>
            <button class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#10B981] hover:bg-[#059669] text-white text-sm font-semibold transition-all shadow-sm hover:shadow active:scale-[0.98]" id="btn-tambah-pengguna" type="button" onclick="openModal()">
                <span class="material-symbols-outlined text-[20px] font-bold">add</span>
                <span>Tambah Pengguna</span>
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="w-full bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col mt-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-400">NAMA PENGGUNA</th>
                        <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-400">EMAIL</th>
                        <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-400">PERAN</th>
                        <th class="py-4 px-6 text-xs font-semibold uppercase tracking-wider text-slate-400">STATUS</th>
                        <th class="py-4 px-6 text-right text-xs font-semibold uppercase tracking-wider text-slate-400">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Row 1: Dheka -->
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-sm font-bold shadow-xs">D</div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 leading-snug">Dheka Pratama</span>
                                    <span class="text-xs text-slate-400 font-normal">Super Admin Restoran</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6"><span class="text-sm text-slate-700 font-medium select-all">dheka.manager@restopos.id</span></td>
                        <td class="py-5 px-6"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100/60">Manajer</span></td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-2.5">
                                <button aria-checked="true" class="toggle-switch relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full p-0.5 transition-colors bg-[#10B981] focus:outline-none" onclick="toggleStatus(this)" role="switch" type="button">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow-xs transition-transform translate-x-4"></span>
                                </button>
                                <span class="status-label text-xs font-semibold text-[#10B981]">Aktif</span>
                            </div>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <div class="inline-flex items-center justify-end gap-1 text-slate-400">
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Edit Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Reset Kata Sandi" type="button">
                                    <span class="material-symbols-outlined text-[19px]">key</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2: Siti Nurhaliza -->
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-800 flex items-center justify-center text-sm font-bold shadow-xs">S</div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 leading-snug">Siti Nurhaliza</span>
                                    <span class="text-xs text-slate-400 font-normal">Shift Pagi</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6"><span class="text-sm text-slate-700 font-medium select-all">siti.kasir@restopos.id</span></td>
                        <td class="py-5 px-6"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100/60">Kasir</span></td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-2.5">
                                <button aria-checked="true" class="toggle-switch relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full p-0.5 transition-colors bg-[#10B981] focus:outline-none" onclick="toggleStatus(this)" role="switch" type="button">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow-xs transition-transform translate-x-4"></span>
                                </button>
                                <span class="status-label text-xs font-semibold text-[#10B981]">Aktif</span>
                            </div>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <div class="inline-flex items-center justify-end gap-1 text-slate-400">
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Edit Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Reset Kata Sandi" type="button">
                                    <span class="material-symbols-outlined text-[19px]">key</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3: Budi Santoso -->
                    <tr class="hover:bg-slate-50/60 transition-colors group">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-sm font-bold shadow-xs">B</div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 leading-snug">Budi Santoso</span>
                                    <span class="text-xs text-slate-400 font-normal">Shift Malam</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6"><span class="text-sm text-slate-700 font-medium select-all">budi.kasir@restopos.id</span></td>
                        <td class="py-5 px-6"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100/60">Kasir</span></td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-2.5">
                                <button aria-checked="true" class="toggle-switch relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full p-0.5 transition-colors bg-[#10B981] focus:outline-none" onclick="toggleStatus(this)" role="switch" type="button">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow-xs transition-transform translate-x-4"></span>
                                </button>
                                <span class="status-label text-xs font-semibold text-[#10B981]">Aktif</span>
                            </div>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <div class="inline-flex items-center justify-end gap-1 text-slate-400">
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Edit Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Reset Kata Sandi" type="button">
                                    <span class="material-symbols-outlined text-[19px]">key</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 4: Rian Ardiansyah -->
                    <tr class="hover:bg-slate-50/60 transition-colors group opacity-85">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-sm font-bold shadow-xs">R</div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 leading-snug">Rian Ardiansyah</span>
                                    <span class="text-xs text-slate-400 font-normal">Cadangan</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6"><span class="text-sm text-slate-700 font-medium select-all">rian.kasir@restopos.id</span></td>
                        <td class="py-5 px-6"><span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100/60">Kasir</span></td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-2.5">
                                <button aria-checked="false" class="toggle-switch relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full p-0.5 transition-colors bg-slate-200 focus:outline-none" onclick="toggleStatus(this)" role="switch" type="button">
                                    <span class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow-xs transition-transform translate-x-0"></span>
                                </button>
                                <span class="status-label text-xs font-semibold text-slate-400">Nonaktif</span>
                            </div>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <div class="inline-flex items-center justify-end gap-1 text-slate-400">
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Edit Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-slate-100 hover:text-slate-700 transition-colors" title="Reset Kata Sandi" type="button">
                                    <span class="material-symbols-outlined text-[19px]">key</span>
                                </button>
                                <button class="p-1.5 rounded-lg hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus Pengguna" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="py-5 px-6 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100 bg-slate-50/30">
            <div class="text-xs text-slate-500 font-normal">
                Menampilkan <span class="font-semibold text-slate-800">1 - 4</span> dari <span class="font-semibold text-slate-800">4</span> total pengguna
            </div>
            <div class="flex items-center gap-1.5">
                <button aria-label="Halaman Sebelumnya" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 cursor-not-allowed bg-transparent transition-colors" disabled="" type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </button>
                <button class="w-8 h-8 rounded-lg bg-[#10B981] text-white text-xs font-semibold flex items-center justify-center shadow-xs" type="button">1</button>
                <button aria-label="Halaman Berikutnya" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-300 cursor-not-allowed bg-transparent transition-colors" disabled="" type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div id="modal-tambah" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-100 relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-800">Tambah Pengguna Baru</h3>
            <button type="button" id="btn-close-modal" class="p-1 text-slate-400 hover:text-slate-600 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form class="mt-4 space-y-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan nama" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Email</label>
                <input type="email" placeholder="contoh@restopos.id" class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Peran</label>
                <select class="w-full px-3.5 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    <option value="kasir">Kasir</option>
                    <option value="manager">Manajer</option>
                </select>
            </div>
            <div class="pt-2 flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="px-4 py-2 text-sm bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleStatus(button) {
        const isChecked = button.getAttribute('aria-checked') === 'true';
        const thumb = button.querySelector('span');
        const label = button.parentElement.querySelector('.status-label');

        if (isChecked) {
            button.setAttribute('aria-checked', 'false');
            button.classList.remove('bg-[#10B981]');
            button.classList.add('bg-slate-200');
            thumb.classList.remove('translate-x-4');
            thumb.classList.add('translate-x-0');
            label.textContent = 'Nonaktif';
            label.classList.remove('text-[#10B981]');
            label.classList.add('text-slate-400');
        } else {
            button.setAttribute('aria-checked', 'true');
            button.classList.remove('bg-slate-200');
            button.classList.add('bg-[#10B981]');
            thumb.classList.remove('translate-x-0');
            thumb.classList.add('translate-x-4');
            label.textContent = 'Aktif';
            label.classList.remove('text-slate-400');
            label.classList.add('text-[#10B981]');
        }
    }

    const modal = document.getElementById('modal-tambah');
    const btnTambah = document.getElementById('btn-tambah-pengguna');
    const btnClose = document.getElementById('btn-close-modal');

    function openModal() {
        if (modal) modal.classList.remove('hidden');
    }

    function closeModal() {
        if (modal) modal.classList.add('hidden');
    }

    if (btnTambah) btnTambah.addEventListener('click', openModal);
    if (btnClose) btnClose.addEventListener('click', closeModal);
    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    }
</script>
@endsection
