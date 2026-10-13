@extends('layouts.admin')

@section('title', 'Daftar Menu - RestoPOS')

@section('content')
<div class="flex flex-col w-full">
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
            <button class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-on-primary font-title-sm text-title-sm font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all" type="button" style="background-color: rgb(5, 150, 105); color: rgb(255, 255, 255);">
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
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold min-w-[260px]" scope="col">Nama Menu</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Kategori</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Harga</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold" scope="col">Status</th>
                        <th class="py-3.5 px-6 font-label-caps text-label-caps uppercase tracking-wider font-semibold text-right w-28" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low">
                    <!-- Row 1: Nasi Goreng Spesial -->
                    <tr class="hover:bg-surface-container-low/60 transition-colors group">
                        <td class="py-4 px-6 align-middle">
                            <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-secondary-container/20 flex items-center justify-center shadow-xs">
                                <img class="w-full h-full object-cover" data-alt="Traditional Indonesian special fried rice plated attractively with a sunny side up fried egg on top, shredded chicken breast, cucumber slice and crispy prawn crackers, warm natural culinary lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuArnEpBXT-nGhis8CxjS8VkecKkt6FSzK9rXfLyhPLMVUMP8DHEUQcpM9kPN_O6NV4sumBV2pFTKwhT0t_C7xEIOPPw3kBnkYCnf5IQb-5CYiKERNygTj1_Cmb5_-2W031lgjCefyMmIkyZXxnR6R4QKsl9_Q0Hl6i7Cv_2L_B-81dS8NG2cse-th4c4zYAPiAaWjKfYjlgAg5X3O196ryc969kdF3d5CbZhfEW-WFFQVVH1gDp3UJb">
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">Nasi Goreng Spesial</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1 mt-0.5">Porsi reguler + telur mata sapi & ayam suwir</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-on-surface font-label-md text-label-md font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                <span>Makanan Utama</span>
                            </span>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold font-mono tracking-tight">Rp 35.000</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input checked="" class="sr-only peer" onchange="toggleAvailability(this)" type="checkbox">
                                    <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary shadow-inner" style="background-color: rgb(217, 227, 246);"></div>
                                </label>
                                <span class="font-label-md text-label-md font-semibold text-primary status-text" style="color: rgb(5, 150, 105);">Tersedia</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2: Ayam Bakar Madu -->
                    <tr class="hover:bg-surface-container-low/60 transition-colors group">
                        <td class="py-4 px-6 align-middle">
                            <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-secondary-fixed/30 flex items-center justify-center shadow-xs">
                                <img class="w-full h-full object-cover" data-alt="Succulent Indonesian grilled chicken glazed with savory honey and sweet soy sauce, charred edges, served with sambal and lime wedge on banana leaf, warm appetizing food photography" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDsUU7l2EXdJ0ygDAxjjMmz93jHsqi7ewmw_lg82pu2RfdJMORrm5Xo8JuIxuLVaabICTL7tq4h8bUU-9Eo6q_oZyF_CUcOh_YKbLrYZHXlOny401pzSRWv-7WWeQFcfQDjg_QTra3J86xMka4PkcnCGRJp8lbKDzj2pibdS1t-tEtzkHETUhqrT7s19R3h6DNQ_I1w7ZPOCM2oMaGW1BO98w9XUwQZiGZekD_t1XRS6e-LUfCpfto">
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">Ayam Bakar Madu</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1 mt-0.5">Ayam bakar bumbu madu khas Resto</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-on-surface font-label-md text-label-md font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                <span>Makanan Utama</span>
                            </span>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold font-mono tracking-tight">Rp 42.000</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input checked="" class="sr-only peer" onchange="toggleAvailability(this)" type="checkbox">
                                    <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary shadow-inner"></div>
                                </label>
                                <span class="font-label-md text-label-md font-semibold text-primary status-text" style="color: rgb(5, 150, 105);">Tersedia</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3: Es Teh Manis Jumbo -->
                    <tr class="hover:bg-surface-container-low/60 transition-colors group">
                        <td class="py-4 px-6 align-middle">
                            <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-tertiary-fixed/30 flex items-center justify-center shadow-xs">
                                <img class="w-full h-full object-cover" data-alt="Refreshing iced sweet Indonesian jasmine tea served in a tall clear glass mug with ice cubes and condensation droplets, fresh mint garnish, bright ambient daylight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAshe6ZpjtqaAfcGth-kCPtobEeOCKaexR-x-YCZcmSAh76-DD2zxzKyEAqZVuvZWyjuOz-V_wq1uQxmU6ntiWSIwCR1NxoRlfnxvdel-0vd6OOM1xEqZgejfeJpYl2gGQa-EO4P-dUUVwCVKd_eSBNLeTcRU9cwuf7C81LijMJIHxQxZPU-YtEINRx_JoZBGtETdWJ6KN1KHRsJ2k19AqWcEyZd0a8Pu12LITWF5pfhUwTS4U-gje">
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">Es Teh Manis Jumbo</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1 mt-0.5">Minuman dingin segar 500ml</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-tertiary-fixed/40 text-tertiary font-label-md text-label-md font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
                                <span>Minuman</span>
                            </span>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold font-mono tracking-tight">Rp 8.000</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input checked="" class="sr-only peer" onchange="toggleAvailability(this)" type="checkbox">
                                    <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary shadow-inner"></div>
                                </label>
                                <span class="font-label-md text-label-md font-semibold text-primary status-text" style="color: rgb(5, 150, 105);">Tersedia</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 4: Sop Buntut Gurih (Out of Stock) -->
                    <tr class="hover:bg-surface-container-low/60 transition-colors group opacity-85">
                        <td class="py-4 px-6 align-middle">
                            <div class="relative w-12 h-12 rounded-xl overflow-hidden bg-error-container/30 flex items-center justify-center shadow-xs">
                                <img class="w-full h-full object-cover grayscale-[30%]" data-alt="Traditional Indonesian oxtail soup served hot in a porcelain bowl, clear aromatic spiced broth with tender braised meat, carrots, and fried shallots, steam rising, gourmet restaurant setup" src="https://lh3.googleusercontent.com/aida-public/AB6AXuADajXy55FXIOorC6x01XOLwaILQxaK3fg7P9022AjIwhReucCFFFSQaqzIKLaS8jTLIJNrIkfQc6Gg57Shdqhvm6UK9FgUSBU-9MkfVwuc8v-4CQlWzEyYtqmU32TFgUPtgCtVqgOhMEy0XQxIRrmdmDCWjIFGFsmsfyj71Go0Qhzn6vBUfpzvgpJqryohadhYFcDqoiMm1Yhft5Aa0lEs-f3f0sn6DqSxmNygGLozJ4WBAr_5QWHE">
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <span class="font-title-sm text-title-sm text-on-surface font-bold group-hover:text-primary transition-colors">Sop Buntut Gurih</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider bg-error-container text-error">Stok Kosong</span>
                                </div>
                                <span class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1 mt-0.5">Kuah rempah kuah bening daging pilihan</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-high text-on-surface font-label-md text-label-md font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                <span>Makanan Utama</span>
                            </span>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-title-sm text-title-sm text-on-surface font-bold font-mono tracking-tight">Rp 65.000</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle">
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input class="sr-only peer" onchange="toggleAvailability(this)" type="checkbox">
                                    <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary shadow-inner"></div>
                                </label>
                                <span class="font-label-md text-label-md font-semibold text-on-surface-variant status-text">Habis</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 align-middle text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Edit Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">edit</span>
                                </button>
                                <button class="p-2 rounded-xl text-on-surface-variant hover:text-error hover:bg-error-container/40 transition-colors" title="Hapus Menu" type="button">
                                    <span class="material-symbols-outlined text-[19px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="py-4 px-6 bg-surface-container-lowest flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-surface-container-low">
            <div class="flex items-center gap-2">
                <span class="font-body-sm text-body-sm text-on-surface-variant">Menampilkan</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">1 - 4</span>
                <span class="font-body-sm text-body-sm text-on-surface-variant">dari</span>
                <span class="font-body-sm text-body-sm font-bold text-on-surface">4 total menu</span>
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

<script>
    function toggleAvailability(checkbox) {
        const parentRow = checkbox.closest('tr');
        const label = parentRow.querySelector('.status-text');
        if (checkbox.checked) {
            label.textContent = 'Tersedia';
            label.classList.remove('text-on-surface-variant');
            label.classList.add('text-primary');
            parentRow.classList.remove('opacity-85');
        } else {
            label.textContent = 'Habis';
            label.classList.remove('text-primary');
            label.classList.add('text-on-surface-variant');
            parentRow.classList.add('opacity-85');
        }
    }
</script>
@endsection
