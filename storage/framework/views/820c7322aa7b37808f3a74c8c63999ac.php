<!-- Create Room Modal -->
<div id="createRoomModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300"></div>

    <!-- Modal Container -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative w-full max-w-2xl rounded-2xl border border-white/10 bg-linear-to-br from-slate-950/90 via-slate-950/75 to-slate-900/60 p-8 shadow-2xl backdrop-blur-xl animate-in fade-in duration-300 max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button type="button" class="absolute right-6 top-6 text-slate-400 hover:text-white transition-colors" onclick="closeCreateRoomModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="mb-6 space-y-2.5 pr-8">
                <p class="text-[10px] font-semibold uppercase tracking-[0.36em] text-slate-500">Informasi Ruangan</p>
                <h3 class="text-2xl font-semibold tracking-tight leading-tight text-white">Tambah Ruangan Baru</h3>
                <p class="text-sm leading-relaxed text-slate-400">Mohon lengkapi detail ruangan agar proses peminjaman berjalan tertib dan transparan.</p>
            </div>

            <!-- Form -->
            <form id="createRoomForm" action="/admin/rooms" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>

                <!-- Nama Ruangan -->
                <div class="space-y-2">
                    <label for="modal_room_name" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Nama Ruangan <span class="text-rose-400">*</span></label>
                    <input type="text" id="modal_room_name" name="name" required
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Contoh: Lab Komputer 1">
                    <p class="text-xs text-rose-400 hidden" id="modal_room_name_error"></p>
                </div>

                <!-- Type & Capacity -->
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="modal_room_type" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Jenis Ruangan <span class="text-rose-400">*</span></label>
                        <div class="relative w-full">
                            <select id="modal_room_type" name="type" required
                                    class="block w-full appearance-none rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] pr-[50px] text-[13px] text-slate-100 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15">
                                <option value="" class="bg-slate-900 text-slate-400">Loading...</option>
                            </select>
                            <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-xs text-rose-400 hidden" id="modal_room_type_error"></p>
                    </div>

                    <div class="space-y-2">
                        <label for="modal_room_capacity" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Kapasitas <span class="text-rose-400">*</span></label>
                        <input type="number" id="modal_room_capacity" name="capacity" min="1" required
                               class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                               placeholder="Jumlah orang">
                        <p class="text-xs text-rose-400 hidden" id="modal_room_capacity_error"></p>
                    </div>
                </div>

                <!-- Location -->
                <div class="space-y-2">
                    <label for="modal_room_location" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Lokasi <span class="text-rose-400">*</span></label>
                    <input type="text" id="modal_room_location" name="location" required
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Contoh: Lantai 2, Gedung A">
                    <p class="text-xs text-rose-400 hidden" id="modal_room_location_error"></p>
                </div>

                <!-- Facilities -->
                <div class="space-y-2">
                    <label for="modal_room_facilities" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Fasilitas</label>
                    <textarea id="modal_room_facilities" name="facilities" rows="3"
                              class="w-full rounded-[20px] border border-slate-700/60 bg-slate-900/50 px-[18px] py-[14px] text-[13px] leading-relaxed text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15 min-h-[100px] resize-none"
                              placeholder="Contoh: Proyektor, AC, Whiteboard, 30 Komputer"></textarea>
                    <p class="text-xs text-rose-400 hidden" id="modal_room_facilities_error"></p>
                </div>

                <!-- Manager Selection -->
                <div class="space-y-2">
                    <label for="modal_room_managers" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Pengatur Ruangan (Room Managers)</label>
                    <input type="hidden" id="modal_room_manager_ids">
                    <div id="modal_room_managers_container" class="relative w-full">
                        <div id="modal_room_managers" class="block w-full max-h-[200px] overflow-y-auto rounded-2xl border border-slate-700/60 bg-slate-900/50 p-3 shadow-inner shadow-black/30 space-y-2">
                            <p class="text-xs text-slate-500 py-2 px-2">Memuat daftar peminjam...</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Pilih peminjam yang akan membantu mengelola ruangan ini dan memproses permintaan peminjaman.</p>
                    <p class="text-xs text-rose-400 hidden" id="modal_room_manager_ids_error"></p>
                </div>

                <!-- Status Toggle -->
                <div class="rounded-[22px] border border-slate-700/50 bg-slate-900/40 p-5 text-sm text-slate-200 shadow-inner shadow-black/30">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="space-y-1.5">
                            <span class="text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-400">Status Aktif</span>
                            <p class="text-[13px] font-semibold leading-tight text-white">Ruangan aktif (bisa dipinjam)</p>
                            <p class="text-[11px] leading-relaxed text-slate-500">Ruangan dapat dilihat dan dipilih untuk dipinjam.</p>
                        </div>
                        <div class="shrink-0">
                            <input type="hidden" name="is_active" value="0">
                            <label class="relative inline-flex h-[34px] w-[66px] cursor-pointer items-center">
                                <input type="checkbox" id="modal_room_is_active" name="is_active" value="1" class="peer sr-only" checked>
                                <span class="absolute inset-0 rounded-full bg-slate-600/60 shadow-inner shadow-black/30 transition-all duration-200 peer-checked:bg-yellow-400"></span>
                                <span class="absolute left-[3px] top-[3px] h-7 w-7 rounded-full bg-white shadow-md transition-all duration-200 peer-checked:translate-x-8 peer-checked:bg-slate-950"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 pt-4 sm:flex-row sm:items-center border-t border-slate-800/50">
                    <button type="submit" id="roomSubmitBtn" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-8 py-3.5 text-[13px] font-bold uppercase tracking-[0.08em] text-slate-950 shadow-lg shadow-yellow-500/25 transition-all duration-200 hover:bg-yellow-300 hover:shadow-yellow-500/35 focus:outline-none focus:ring-[3px] focus:ring-yellow-400/30">
                        Simpan Ruangan
                    </button>
                    <button type="button" onclick="closeCreateRoomModal()" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-600/70 bg-transparent px-8 py-3.5 text-[13px] font-bold uppercase tracking-[0.08em] text-slate-300 transition-all duration-200 hover:bg-slate-800/50 hover:border-slate-500/80 hover:text-white focus:outline-none focus:ring-[3px] focus:ring-slate-700/50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Load room types from database
async function loadRoomTypes() {
    try {
        const response = await fetch('/admin/api/room-types');
        const data = await response.json();
        
        if (data.success && Array.isArray(data.data)) {
            const select = document.getElementById('modal_room_type');
            const currentValue = select.value;
            
            // Clear existing options except first one
            select.innerHTML = '<option value="" class="bg-slate-900 text-slate-400">Pilih Jenis</option>';
            
            // Add room types
            data.data.forEach(roomType => {
                const option = document.createElement('option');
                option.value = roomType.name;
                option.textContent = roomType.label;
                option.className = 'bg-slate-900 text-white';
                select.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading room types:', error);
    }
}

// Load peminjam users for manager selection
async function loadCreateRoomManagers(selectedManagerIds = []) {
    const container = document.getElementById('modal_room_managers');
    if (!container) return;

    container.innerHTML = '<p class="text-xs text-slate-500 py-2 px-2">Memuat daftar peminjam...</p>';

    try {
        const response = await fetch('/admin/api/peminjam-users');
        const data = await response.json();

        if (data.success && Array.isArray(data.data) && data.data.length) {
            container.innerHTML = '';

            data.data.forEach(peminjam => {
                const checkboxId = `create_manager_${peminjam.id}`;
                const isSelected = selectedManagerIds.includes(peminjam.id);

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.id = checkboxId;
                checkbox.name = 'manager_ids[]';
                checkbox.value = peminjam.id;
                checkbox.checked = isSelected;
                checkbox.className = 'peer sr-only';

                const label = document.createElement('label');
                label.htmlFor = checkboxId;
                label.className = 'flex items-center gap-2 p-2 rounded-lg cursor-pointer text-sm text-slate-300 hover:bg-slate-700/50 transition-colors peer-checked:bg-yellow-400/20 peer-checked:text-yellow-400';
                label.innerHTML = `
                    <svg class="w-4 h-4 hidden peer-checked:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <svg class="w-4 h-4 peer-checked:hidden text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex-1">
                        <div class="font-medium">${peminjam.name}</div>
                        <div class="text-xs text-slate-500">${peminjam.email}</div>
                    </div>
                `;

                const wrapper = document.createElement('div');
                wrapper.appendChild(checkbox);
                wrapper.appendChild(label);
                container.appendChild(wrapper);
            });
        } else {
            container.innerHTML = '<p class="text-xs text-slate-500 py-2 px-2">Belum ada peminjam aktif yang dapat dijadikan pengatur ruangan.</p>';
        }
    } catch (error) {
        console.error('Error loading peminjam users:', error);
        container.innerHTML = '<p class="text-xs text-rose-400 py-2 px-2">Gagal memuat daftar peminjam.</p>';
    }
}

function openCreateRoomModal() {
    const modal = document.getElementById('createRoomModal');
    const form = document.getElementById('createRoomForm');
    
    // Reset form
    form.reset();
    document.getElementById('modal_room_is_active').checked = true;
    clearRoomErrors();
    
    // Load room types
    loadRoomTypes();
    // Load managers
    loadCreateRoomManagers();
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCreateRoomModal() {
    const modal = document.getElementById('createRoomModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function clearRoomErrors() {
    document.querySelectorAll('[id*="modal_room_"][id*="_error"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    document.querySelectorAll('#createRoomForm input, #createRoomForm select, #createRoomForm textarea').forEach(el => {
        el.classList.remove('border-rose-500/80', 'focus:border-rose-400', 'focus:ring-rose-400/40', 'focus:shadow-rose-500/20');
        el.classList.add('border-slate-700/60');
    });
}

// Close modal when clicking backdrop
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('createRoomModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateRoomModal();
            }
        });
    }

    // Load room types on page load
    loadRoomTypes();
    // Load managers on page load
    loadCreateRoomManagers();

    // Handle form submission
    const form = document.getElementById('createRoomForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            clearRoomErrors();

            const formData = new FormData(form);

            // Ensure is_active is properly set
            const isActiveCheckbox = document.getElementById('modal_room_is_active');
            formData.set('is_active', isActiveCheckbox.checked ? '1' : '0');

            const csrfToken = form.querySelector('input[name="_token"]').value;
            console.log('Submitting form with data:', Array.from(formData.entries()));

            try {
                const response = await fetch('/admin/rooms', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                });

                const contentType = response.headers.get('content-type') || '';
                let data;

                if (contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    const text = await response.text();
                    console.error('Non-JSON response body:', text);
                    throw new Error(`Invalid JSON response (status ${response.status})`);
                }

                console.log('Response status:', response.status, 'Data:', data);

                if (response.ok && data.success) {
                    alert('Ruangan berhasil ditambahkan!');
                    window.location.href = data.redirect;
                } else if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errorEl = document.getElementById(`modal_room_${field}_error`);
                        const inputEl = document.getElementById(`modal_room_${field}`);
                        if (errorEl) {
                            errorEl.textContent = data.errors[field][0];
                            errorEl.classList.remove('hidden');
                        }
                        if (inputEl) {
                            inputEl.classList.remove('border-slate-700/60');
                            inputEl.classList.add('border-rose-500/80', 'focus:border-rose-400', 'focus:ring-rose-400/40', 'focus:shadow-rose-500/20');
                        }
                    });
                } else {
                    alert('Terjadi kesalahan: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert('Gagal mengirim form. Silakan coba lagi. Error: ' + error.message);
            }
        });
    }
});
</script>
<?php /**PATH E:\Semester 4\ENG\ALP\Booking-Ruangan\resources\views/admin/modals/create-room-modal.blade.php ENDPATH**/ ?>