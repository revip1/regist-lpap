@extends('layouts.app')

@section('header-title', 'Registrasi Kelas')
@section('breadcrumb', 'Registrasi Kelas')

<style>
form div label {
  font-size: 14px;
}

.notif-empty {
  color: #f00;
  font-size: 12px;
  display: none;
}
</style>

@section('content')
<div class="container mb-4">
    <h5>Registrasi</h5>
    <form action="{{ route('user_details.store') }}" method="POST" id="registrasi">
        @csrf
        <div class="mb-4">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ old('name') }}" required>
            <span id="notif-name" class="notif-empty">Nama Lengkap belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="instance" class="form-label">Instansi/ Kampus</label>
            <input type="text" name="instance" id="instance" class="form-control form-control-sm" value="{{ old('instance') }}" required>
            <span id="notif-instance" class="notif-empty">Instansi/ Kampus belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="occupation" class="form-label">Pekerjaan</label>
            <!-- <input type="text" name="occupation" id="occupation" class="form-control form-control-sm" value="{{ old('occupation') }}" required> -->
            <select name="occupation" id="occupation" class="form-control form-control-sm" required>
              <option value="">Pilih Salah Satu</option>
              <?php
              $arr_pekerjaan = array("Mahasiswa", "PNS", "Karyawan Swasta");
              for($i = 0; $i < count($arr_pekerjaan); $i++): ?>
                <option <?=($arr_pekerjaan[$i] == old('occupation'))? "selected" : ""?>><?=$arr_pekerjaan[$i]?></option>
              <?php endfor; ?>
            </select>
            <span id="notif-occupation" class="notif-empty">Pekerjaan belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
            <span id="notif-email" class="notif-empty">E-mail belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <input type="text" name="address" id="address" class="form-control form-control-sm" value="{{ old('address') }}" required>
            <span id="notif-address" class="notif-empty">Alamat Lengkap belum diisi!</span>
        </div>
        <div class="mb-4">
            <label class="form-label">Jenis Identitas</label>
            <div class="d-flex gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="ktp" value="KTP" {{ old('identity_type') == 'KTP' ? 'checked' : '' }}>
                    <label class="form-check-label" for="ktp">KTP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="sim" value="SIM" {{ old('identity_type') == 'SIM' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sim">SIM</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="kp" value="KP" {{ old('identity_type') == 'KP' ? 'checked' : '' }}>
                    <label class="form-check-label" for="kp">KTM (Khusus Mahasiswa Aktif)</label>
                </div>
            </div>
            <span id="notif-identity_type" class="notif-empty">Jenis Identitas belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="identity_number" class="form-label">Nomor Identitas</label>
            <input type="text" name="identity_number" id="identity_number" class="form-control form-control-sm" value="{{ old('identity_number') }}">
            <span id="notif-identity_number" class="notif-empty">Nomor Identitas belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="phone_number" class="form-label">Nomor Telepon/ WhatsApp</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="{{ old('phone_number') }}" required>
            <span id="notif-phone_number" class="notif-empty">Nomor Telepon/ WhatsApp belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="program_id" class="form-label">Kelas</label>
            <select name="program_id" id="program_id" class="form-control" required>
                <option value="">Pilih Kelas</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
            <span id="notif-program_id" class="notif-empty">Kelas belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="reason_to_join" class="form-label">Alasan Mengikuti</label>
            <input type="text" name="reason_to_join" id="reason_to_join" class="form-control form-control-sm" value="{{ old('reason_to_join') }}">
            <span id="notif-reason_to_join" class="notif-empty">Alasan Mengikuti belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="information_source" class="form-label">Sumber Informasi</label>
            <input type="text" name="information_source" id="information_source" class="form-control form-control-sm" value="{{ old('information_source') }}">
            <span id="notif-information_source" class="notif-empty">Sumber Informasi belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="referral" class="form-label">Referral</label>
            <input type="text" name="referral" id="referral" class="form-control form-control-sm" value="{{ old('referral') }}" {{ optional($programs->firstWhere('id', old('program_id')))->referral_required == 'no' ? 'disabled' : '' }}>
            <span id="notif-referral" class="notif-empty">Referral belum diisi!</span>
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
{{-- @dd($errors) --}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ session("error") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const programSelect = document.getElementById('program_id');
        const referralInput = document.getElementById('referral');

        programSelect.addEventListener('change', function () {
            const selectedProgram = this.value;
            const programs = @json($programs); // Ambil data program dari Blade
            const selected = programs.find(p => p.id == selectedProgram);

            if (selected && selected.referral_required === 'no') {
                referralInput.value = '';
                referralInput.setAttribute('disabled', 'disabled');
            } else {
                referralInput.removeAttribute('disabled');
            }
        });
    });

    document.getElementById('registrasi').onsubmit = function(event) {
        let isValid = true;
        let notif = document.getElementsByClassName('notif-empty'),
            input = document.getElementsByTagName('input'),
            select = document.getElementsByTagName('select');

        // Sembunyikan semua notifikasi error
        for (let i = 0; i < notif.length; i++) {
            notif[i].style.display = 'none';
        }

        // Validasi input teks dan email
        for (let i = 0; i < input.length; i++) {
            if (
                (input[i].type == 'text' || input[i].type == 'email') && 
                input[i].value.trim() === '' &&
                !input[i].disabled // Abaikan input yang disabled
            ) {
                document.getElementById('notif-' + input[i].id).style.display = 'flex';
                isValid = false;
            }
        }

        // Validasi radio button identity_type
        let identityType = document.getElementsByName('identity_type');
        let isIdentityChecked = false;
        for (let j = 0; j < identityType.length; j++) {
            if (identityType[j].checked) {
                isIdentityChecked = true;
                break;
            }
        }

        if (!isIdentityChecked) {
            document.getElementById('notif-identity_type').style.display = 'flex';
            isValid = false;
        }

        // Validasi select
        for (let i = 0; i < select.length; i++) {
            if (select[i].type == 'select-one' && select[i].value === '') {
                document.getElementById('notif-' + select[i].id).style.display = 'flex';
                isValid = false;
            }
        }

        // Jika form tidak valid, hentikan submit
        if (!isValid) {
            event.preventDefault();
        }
    };
</script>
    

@endsection
