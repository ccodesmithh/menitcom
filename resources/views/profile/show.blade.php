@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.penulis')

@section('title', 'Profil Anda')

@section('content')
<div class="container mt-4">
	<div class="row g-4">
		{{-- Left column: avatar + quick action --}}
		<div class="col-md-4">
			<div class="card shadow-sm">
				<div class="card-body text-center">
					<img id="avatarPreview"
						src="{{ $user->avatar ? asset('uploads/avatar/'.$user->avatar) : asset('default-avatar.png') }}"
						alt="Avatar"
						class="rounded-circle mb-3"
						style="width:150px;height:150px;object-fit:cover;">
					<h5 class="card-title mb-1">{{ $user->name }}</h5>
					<p class="text-muted mb-1 small">{{ $user->email }}</p>
					<span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>

					<div class="mt-3 d-grid">
						<a href="{{ route('profile.edit') }}" class="btn btn-primary">Ubah Profil</a>
					</div>
				</div>
			</div>
		</div>

		{{-- Right column: details + delete card --}}
		<div class="col-md-8">
			<div class="card shadow-sm mb-3">
				<div class="card-header bg-light">
					<h6 class="mb-0">Informasi Akun</h6>
				</div>
				<div class="card-body">
					<p class="mb-2"><strong>Nama:</strong> {{ $user->name }}</p>
					<p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
					<p class="mb-0"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
				</div>
			</div>

			<div class="card shadow-sm border-danger">
				<div class="card-header bg-danger text-white">
					<h6 class="mb-0">Hapus Akun</h6>
				</div>
				<div class="card-body">
					<p class="text-muted small">Akun Anda akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan. Berita yang Anda buat tidak akan dihapus, namun Anda tidak dapat mengaksesnya kembali.</p>

					<form method="POST" action="{{ route('profile.destroy') }}">
						@csrf
						@method('DELETE')

						<div class="mb-3">
							<label for="delete_password" class="form-label small">Konfirmasi Password</label>
							<input type="password" name="password" id="delete_password" class="form-control @error('password') is-invalid @enderror" required>
							@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="d-flex gap-2">
							<button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#helpDelete" aria-expanded="false">Bantuan</button>
							<button type="submit" class="btn btn-danger ms-auto" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini? Semua akses akan hilang secara permanen.')">Hapus Akun</button>
						</div>

						<div class="collapse mt-2" id="helpDelete">
							<div class="card card-body p-2 small text-muted">Jika Anda ingin menjaga data, pertimbangkan untuk nonaktif saja atau menghubungi admin.</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');
    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarPreview.setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endpush
@endsection
