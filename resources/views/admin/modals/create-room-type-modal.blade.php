<!-- Create/Edit Room Type Modal -->
<div id="createRoomTypeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-black/70 backdrop-blur-md" id="roomTypeModalBackdrop"></div>

  <!-- Modal Container -->
  <div class="flex min-h-screen items-center justify-center p-4">
    <div class="relative w-full max-w-2xl rounded-2xl border border-white/10 bg-slate-900 shadow-2xl shadow-black/50">
      <!-- Close Button -->
      <button
        onclick="closeCreateRoomTypeModal()"
        class="absolute right-4 top-4 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-slate-800/80 text-slate-400 hover:bg-slate-700 hover:text-slate-200 transition-colors"
      >
        <i class="fas fa-times text-lg"></i>
      </button>

      <!-- Header -->
      <div class="border-b border-white/10 px-6 py-4">
        <h3 class="text-lg font-bold text-white" id="roomTypeModalTitle">Tambah Jenis Ruangan</h3>
        <p class="mt-1 text-sm text-slate-400" id="roomTypeModalSubtitle">Buat jenis ruangan baru untuk pilihan peminjaman</p>
      </div>

      <!-- Form Content - Scrollable -->
      <div class="max-h-[calc(90vh-200px)] overflow-y-auto">
        <form id="createRoomTypeForm" class="space-y-5 px-6 py-4">
          @csrf
          <input type="hidden" id="room_type_method" name="_method" value="POST">
          <input type="hidden" id="room_type_id" name="room_type_id" value="">

          <!-- Name Field -->
          <div class="space-y-2">
            <label for="modal_room_type_name" class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">
              Nama Jenis (untuk sistem) <span class="text-rose-400">*</span>
            </label>
            <input
              type="text"
              id="modal_room_type_name"
              name="name"
              placeholder="Contoh: laboratorium"
              class="w-full rounded-2xl border border-slate-700/70 bg-slate-800/50 px-4 py-3 text-white placeholder-slate-500 shadow-inner shadow-black/30 transition-all focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/30 focus:outline-none"
              required
            >
            <div id="modal_room_type_name_error" class="hidden rounded-lg bg-rose-500/15 border border-rose-500/30 px-3 py-2 text-xs text-rose-300"></div>
          </div>

          <!-- Label Field -->
          <div class="space-y-2">
            <label for="modal_room_type_label" class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">
              Label Tampilan <span class="text-rose-400">*</span>
            </label>
            <input
              type="text"
              id="modal_room_type_label"
              name="label"
              placeholder="Contoh: Laboratorium"
              class="w-full rounded-2xl border border-slate-700/70 bg-slate-800/50 px-4 py-3 text-white placeholder-slate-500 shadow-inner shadow-black/30 transition-all focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/30 focus:outline-none"
              required
            >
            <div id="modal_room_type_label_error" class="hidden rounded-lg bg-rose-500/15 border border-rose-500/30 px-3 py-2 text-xs text-rose-300"></div>
          </div>

          <!-- Description Field -->
          <div class="space-y-2">
            <label for="modal_room_type_description" class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">
              Deskripsi
            </label>
            <textarea
              id="modal_room_type_description"
              name="description"
              rows="3"
              placeholder="Contoh: Ruangan untuk praktikum dan eksperimen"
              class="w-full rounded-2xl border border-slate-700/70 bg-slate-800/50 px-4 py-3 text-white placeholder-slate-500 shadow-inner shadow-black/30 transition-all focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/30 focus:outline-none resize-none"
            ></textarea>
            <div id="modal_room_type_description_error" class="hidden rounded-lg bg-rose-500/15 border border-rose-500/30 px-3 py-2 text-xs text-rose-300"></div>
          </div>

          <!-- Status Toggle -->
          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <label for="modal_room_type_is_active" class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-300">
                Status Aktif
              </label>
              <div class="flex items-center gap-2">
                <span class="text-xs text-slate-400">Nonaktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                  <input type="hidden" name="is_active" value="0">
                  <input
                    type="checkbox"
                    id="modal_room_type_is_active"
                    name="is_active"
                    value="1"
                    class="peer sr-only"
                    checked
                  >
                  <div class="peer h-6 w-11 rounded-full bg-slate-700 shadow-inner shadow-black/30 transition-colors peer-checked:bg-yellow-400"></div>
                  <div class="absolute left-1 top-1 h-4 w-4 rounded-full bg-white shadow-md transition-transform peer-checked:translate-x-5"></div>
                </label>
              </div>
            </div>
            <p class="text-xs text-slate-400">Nonaktifkan jika jenis belum ingin ditampilkan pada pilihan peminjaman.</p>
            <div id="modal_room_type_is_active_error" class="hidden rounded-lg bg-rose-500/15 border border-rose-500/30 px-3 py-2 text-xs text-rose-300"></div>
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="flex gap-3 border-t border-white/10 bg-slate-800/50 px-6 py-4">
        <button
          type="button"
          onclick="submitCreateRoomTypeForm()"
          class="flex-1 rounded-xl bg-yellow-400 px-4 py-2.5 text-sm font-semibold text-slate-900 shadow-lg shadow-yellow-400/30 hover:bg-yellow-300 transition-colors"
        >
          <i class="fas fa-save mr-2"></i>Simpan Jenis
        </button>
        <button
          type="button"
          onclick="closeCreateRoomTypeModal()"
          class="flex-1 rounded-xl border border-slate-600 bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-300 hover:bg-slate-700 hover:text-white transition-colors"
        >
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                    document.querySelector('input[name="_token"]')?.value ||
                    '{{ csrf_token() }}';

  function openCreateRoomTypeModal(roomTypeId = null) {
    const modal = document.getElementById('createRoomTypeModal');
    const form = document.getElementById('createRoomTypeForm');
    const methodInput = document.getElementById('room_type_method');
    const idInput = document.getElementById('room_type_id');
    const title = document.getElementById('roomTypeModalTitle');
    const subtitle = document.getElementById('roomTypeModalSubtitle');

    form.reset();
    document.getElementById('modal_room_type_is_active').checked = true;
    clearRoomTypeErrors();

    if (roomTypeId) {
      // Edit mode - fetch room type data
      fetch(`/admin/room-types/${roomTypeId}/edit`, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          document.getElementById('modal_room_type_name').value = data.name;
          document.getElementById('modal_room_type_label').value = data.label;
          document.getElementById('modal_room_type_description').value = data.description || '';
          document.getElementById('modal_room_type_is_active').checked = data.is_active;
          methodInput.value = 'PUT';
          idInput.value = roomTypeId;
          title.textContent = 'Edit Jenis Ruangan';
          subtitle.textContent = 'Ubah informasi jenis ruangan';
          modal.classList.remove('hidden');
          document.body.style.overflow = 'hidden';
        })
        .catch(error => {
          console.error('Error fetching room type:', error);
          alert('Gagal memuat data jenis ruangan');
        });
    } else {
      // Create mode
      methodInput.value = 'POST';
      idInput.value = '';
      title.textContent = 'Tambah Jenis Ruangan';
      subtitle.textContent = 'Buat jenis ruangan baru untuk pilihan peminjaman';
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeCreateRoomTypeModal() {
    const modal = document.getElementById('createRoomTypeModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  }

  function clearRoomTypeErrors() {
    const errorFields = document.querySelectorAll('[id$="_error"]');
    errorFields.forEach(field => {
      field.classList.add('hidden');
      field.textContent = '';
    });
  }

  // Modal backdrop click to close
  const backdrop = document.getElementById('roomTypeModalBackdrop');
  if (backdrop) {
    backdrop.addEventListener('click', function(e) {
      if (e.target === this) {
        closeCreateRoomTypeModal();
      }
    });
  }

  // Form submission with AJAX
  const form = document.getElementById('createRoomTypeForm');
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    await submitCreateRoomTypeForm();
  });

  async function submitCreateRoomTypeForm() {
    const form = document.getElementById('createRoomTypeForm');
    const methodInput = document.getElementById('room_type_method');
    const idInput = document.getElementById('room_type_id');
    const formData = new FormData(form);

    clearRoomTypeErrors();

    let url = '/admin/room-types';
    let method = methodInput.value;

    if (method === 'PUT') {
      url = `/admin/room-types/${idInput.value}`;
      formData.append('_method', 'PUT');
    }

    try {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
      });

      if (response.status === 422) {
        // Validation errors
        const data = await response.json();
        if (data.errors) {
          Object.keys(data.errors).forEach(field => {
            const errorElement = document.getElementById(`modal_room_type_${field}_error`);
            if (errorElement) {
              errorElement.textContent = data.errors[field][0];
              errorElement.classList.remove('hidden');
            }
          });
        }
        return;
      }

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      if (data.success) {
        closeCreateRoomTypeModal();
        // Redirect to room types index
        window.location.href = data.redirect || '/admin/room-types';
      } else if (data.message) {
        alert(data.message);
      }
    } catch (error) {
      console.error('Error:', error);
      alert('Terjadi kesalahan saat menyimpan jenis ruangan');
    }
  }
</script>
