<!-- Edit User Modal -->
<div id="editUserModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300"></div>

    <!-- Modal Container -->
    <div class="flex min-h-screen items-center justify-center p-4 relative z-50">
        <div class="relative w-full max-w-2xl rounded-2xl border border-white/10 bg-linear-to-br from-slate-950/90 via-slate-950/75 to-slate-900/60 p-8 shadow-2xl backdrop-blur-xl animate-in fade-in duration-300 overflow-visible">
            <!-- Close Button -->
            <button type="button" class="absolute right-6 top-6 text-slate-400 hover:text-white transition-colors" onclick="closeEditUserModal()">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="mb-8 space-y-2.5">
                <h3 class="text-2xl font-semibold tracking-tight leading-tight text-white">Edit Pengguna</h3>
                <p class="text-sm leading-relaxed text-slate-400">Ubah data pengguna untuk menjaga informasi tetap mutakhir.</p>
            </div>

            <!-- Form -->
            <form id="editUserForm" action="#" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <input type="hidden" id="editUserId" value="">

                <!-- Nama Lengkap -->
                <div class="space-y-2">
                    <label for="edit_name" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Nama Lengkap <span class="text-rose-400">*</span></label>
                    <input type="text" id="edit_name" name="name" required
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Nama Lengkap">
                    <p class="text-xs text-rose-400 hidden" id="edit_name_error"></p>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="edit_email" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Email <span class="text-rose-400">*</span></label>
                    <input type="email" id="edit_email" name="email" required
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Email">
                    <p class="text-xs text-rose-400 hidden" id="edit_email_error"></p>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="edit_password" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Password Baru</label>
                    <input type="password" id="edit_password" name="password"
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Password" minlength="8">
                    <p class="text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.</p>
                    <p class="text-xs text-rose-400 hidden" id="edit_password_error"></p>
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-2">
                    <label for="edit_password_confirmation" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Konfirmasi Password Baru</label>
                    <input type="password" id="edit_password_confirmation" name="password_confirmation"
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="Konfirmasi Password" minlength="8">
                    <p class="text-xs text-rose-400 hidden" id="edit_password_confirmation_error"></p>
                </div>

                <!-- No. Telepon -->
                <div class="space-y-2">
                    <label for="edit_phone" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">No. Telepon</label>
                    <input type="text" id="edit_phone" name="phone"
                           class="w-full rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] text-[13px] text-slate-100 placeholder-slate-500 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15"
                           placeholder="No. Telepon">
                    <p class="text-xs text-rose-400 hidden" id="edit_phone_error"></p>
                </div>

                <!-- Role -->
                <div class="space-y-2">
                    <label for="edit_role" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Role <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="edit_role" name="role" required
                                class="block w-full appearance-none rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] pr-[50px] text-[13px] text-slate-100 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15 relative z-10">
                            <option value="" class="bg-slate-900 text-slate-400">Pilih Role</option>
                            <option value="peminjam" class="bg-slate-900 text-white">Peminjam</option>
                            <option value="kepala_sekolah" class="bg-slate-900 text-white">Kepala Sekolah</option>
                            <option value="cleaning_service" class="bg-slate-900 text-white">Cleaning Service</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-xs text-rose-400 hidden" id="edit_role_error"></p>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="edit_status" class="block text-[10px] font-semibold uppercase tracking-[0.28em] text-slate-300/90">Status <span class="text-rose-400">*</span></label>
                    <div class="relative w-full">
                        <select id="edit_status" name="status" required
                                class="block w-full appearance-none rounded-full border border-slate-700/60 bg-slate-900/50 px-[18px] py-[13px] pr-[50px] text-[13px] text-slate-100 shadow-inner shadow-black/30 backdrop-blur-sm transition-all duration-200 focus:border-yellow-400/80 focus:ring-[3px] focus:ring-yellow-400/20 focus:shadow-yellow-500/15 relative z-10">
                            <option value="active" class="bg-slate-900 text-white">Aktif</option>
                            <option value="inactive" class="bg-slate-900 text-white">Tidak Aktif</option>
                        </select>
                        <span class="pointer-events-none absolute right-4 top-1/2 flex h-6 w-6 -translate-y-1/2 items-center justify-center rounded-full bg-slate-800/70 text-slate-300 shadow-inner shadow-black/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3.5 w-3.5">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-xs text-rose-400 hidden" id="edit_status_error"></p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 pt-6 sm:flex-row sm:items-center border-t border-slate-800/50">
                    <button type="submit" id="submitEditBtn" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-8 py-3.5 text-[13px] font-bold uppercase tracking-[0.08em] text-slate-950 shadow-lg shadow-yellow-500/25 transition-all duration-200 hover:bg-yellow-300 hover:shadow-yellow-500/35 focus:outline-none focus:ring-[3px] focus:ring-yellow-400/30">
                        Update User
                    </button>
                    <button type="button" onclick="closeEditUserModal()" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-600/70 bg-transparent px-8 py-3.5 text-[13px] font-bold uppercase tracking-[0.08em] text-slate-300 transition-all duration-200 hover:bg-slate-800/50 hover:border-slate-500/80 hover:text-white focus:outline-none focus:ring-[3px] focus:ring-slate-700/50">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditUserModal(userId) {
    const modal = document.getElementById('editUserModal');
    const form = document.getElementById('editUserForm');
    
    // Show loading state
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Fetch user data
    fetch(`/admin/users/${userId}/edit`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data) {
            const user = data.data;
            document.getElementById('editUserId').value = user.id;
            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_phone').value = user.phone || '';
            document.getElementById('edit_role').value = user.role;
            document.getElementById('edit_status').value = user.status;
            
            form.action = `/admin/users/${user.id}`;
            clearEditErrors();
        } else {
            alert('Failed to load user data: ' + (data.message || 'Unknown error'));
            closeEditUserModal();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal memuat data user');
        closeEditUserModal();
    });
}

function closeEditUserModal() {
    const modal = document.getElementById('editUserModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function clearEditErrors() {
    document.querySelectorAll('[id*="edit_"][id*="_error"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    document.querySelectorAll('#editUserModal input, #editUserModal select').forEach(el => {
        el.classList.remove('border-rose-500/80', 'focus:border-rose-400', 'focus:ring-rose-400/40', 'focus:shadow-rose-500/20');
        el.classList.add('border-slate-700/60');
    });
}

// Close modal when clicking backdrop
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editUserModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditUserModal();
            }
        });
    }

    // Handle form submission
    const form = document.getElementById('editUserForm');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            clearEditErrors();

            const formData = new FormData(form);
            const userId = document.getElementById('editUserId').value;

            try {
                const response = await fetch(`/admin/users/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alert('User berhasil diupdate!');
                    window.location.href = data.redirect;
                } else if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errorEl = document.getElementById(`edit_${field}_error`);
                        const inputEl = document.getElementById(`edit_${field}`);
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
                console.error('Error:', error);
                alert('Gagal mengirim form. Silakan coba lagi.');
            }
        });
    }
});
</script>
