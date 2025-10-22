@extends('admin.layouts.app')

@section('title', 'Kelola Pengajuan Perubahan Password')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Pengajuan Perubahan Password</h1>
        <p class="text-gray-600 mt-2">Setujui atau tolak pengajuan perubahan password dari pengguna</p>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Pending Requests -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="bg-yellow-500 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Pengajuan Menunggu Persetujuan ({{ $pendingRequests->count() }})</h2>
        </div>
        <div class="p-6">
            @if ($pendingRequests->isEmpty())
                <p class="text-gray-500 text-center py-8">Tidak ada pengajuan yang menunggu persetujuan.</p>
            @else
                <div class="space-y-4">
                    @foreach ($pendingRequests as $request)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $request->user->name }}</h3>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ ucfirst($request->user->role) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Email: {{ $request->user->email }}</p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Diajukan: {{ $request->created_at->format('d M Y, H:i') }}
                                        ({{ $request->created_at->diffForHumans() }})
                                    </p>
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <!-- Approve Form -->
                                    <form action="{{ route('admin.password-change.approve', $request) }}" method="POST" class="inline">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui perubahan password untuk {{ $request->user->name }}?')"
                                        >
                                            <i class="fas fa-check mr-1"></i> Setujui
                                        </button>
                                    </form>

                                    <!-- Reject Form -->
                                    <button 
                                        type="button"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors"
                                        onclick="showRejectModal({{ $request->id }})"
                                    >
                                        <i class="fas fa-times mr-1"></i> Tolak
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Processed Requests -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-700 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Riwayat Pengajuan Terbaru</h2>
        </div>
        <div class="p-6">
            @if ($recentRequests->isEmpty())
                <p class="text-gray-500 text-center py-8">Belum ada riwayat pengajuan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diproses Oleh</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($recentRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($request->status === 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->processedBy->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->processed_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $request->admin_notes ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Alasan Penolakan</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Masukkan alasan penolakan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="admin_notes" 
                        id="admin_notes" 
                        rows="4" 
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Contoh: Password terlalu sederhana, silakan gunakan kombinasi yang lebih kuat."
                    ></textarea>
                    <p class="mt-1 text-xs text-gray-500">Alasan ini akan diberitahukan kepada pengguna.</p>
                </div>
                <div class="flex justify-end space-x-2">
                    <button 
                        type="button" 
                        onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none"
                    >
                        Tolak Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showRejectModal(requestId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/password-change-requests/${requestId}/reject`;
    modal.classList.remove('hidden');
}

function closeRejectModal() {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.reset();
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection
