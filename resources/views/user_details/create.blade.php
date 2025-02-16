@extends('layouts.app')

@section('header-title', 'Registrasi Kelas')
@section('breadcrumb', 'Registrasi Kelas')

<style>
form div label, form p {
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
        @guest
        <input type="hidden" id="user_type" value="guest" />
        <div class="mb-4">
            <label for="name" class="form-label">Nama Lengkap *</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ old('name') }}" required>
            <span id="notif-name" class="notif-empty">Nama Lengkap belum diisi!</span>
        </div>
        <div class="mb-4">
            <label class="form-label">Jenis Kelamin *</label>
            <div class="d-flex gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_laki_laki" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="gender_laki_laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_perempuan" value="2" {{ old('identity_type') == '2' ? 'checked' : '' }}>
                    <label class="form-check-label" for="gender_perempuan">Perempuan</label>
                </div>
            </div>
            <span id="notif-gender" class="notif-empty">Jenis Kelamin belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="last_education" class="form-label">Pendidikan Terakhir *</label>
            <select name="last_education" id="last_education" class="form-control form-control-sm" required>
              <option value="">Pilih Salah Satu</option>
              <?php
              $arr_pendidikan = array("SMA/SMK", "S1", "S2");
              for($i = 0; $i < count($arr_pendidikan); $i++): ?>
                <option <?=($arr_pendidikan[$i] == old('last_education'))? "selected" : ""?>><?=$arr_pendidikan[$i]?></option>
              <?php endfor; ?>
            </select>
            <span id="notif-last_education" class="notif-empty">Pendidikan Terakhir belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="occupation" class="form-label">Status *</label>
            <!-- <input type="text" name="occupation" id="occupation" class="form-control form-control-sm" value="{{ old('occupation') }}" required> -->
            <select name="occupation" id="occupation" class="form-control form-control-sm" required>
              <option value="">Pilih Salah Satu</option>
              <?php
              $arr_pekerjaan = array("Mahasiswa", "PNS", "Guru", "Karyawan Swasta", "Lainnya");
              for($i = 0; $i < count($arr_pekerjaan); $i++): ?>
                <option <?=($arr_pekerjaan[$i] == old('occupation'))? "selected" : ""?>><?=$arr_pekerjaan[$i]?></option>
              <?php endfor; ?>
            </select>
            <span id="notif-occupation" class="notif-empty">Status belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="instance" class="form-label">Instansi/ Kampus *</label>
            <input type="text" name="instance" id="instance" class="form-control form-control-sm" value="{{ old('instance') }}" required>
            <span id="notif-instance" class="notif-empty">Instansi/ Kampus belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
            <span id="notif-email" class="notif-empty">E-mail belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="address" class="form-label">Alamat Lengkap *</label>
            <input type="text" name="address" id="address" class="form-control form-control-sm" value="{{ old('address') }}" required>
            <span id="notif-address" class="notif-empty">Alamat Lengkap belum diisi!</span>
        </div>
        <div class="mb-4">
            <label class="form-label">Jenis Identitas *</label>
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
                    <label class="form-check-label" for="kp">KTM(Mahasiswa Aktif)</label>
                </div>
            </div>
            <span id="notif-identity_type" class="notif-empty">Jenis Identitas belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="identity_number" class="form-label">Nomor Identitas *</label>
            <input type="text" name="identity_number" id="identity_number" class="form-control form-control-sm" value="{{ old('identity_number') }}">
            <span id="notif-identity_number" class="notif-empty">Nomor Identitas belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="phone_number" class="form-label">Nomor Telepon/ WhatsApp *</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="{{ old('phone_number') }}" required>
            <span id="notif-phone_number" class="notif-empty">Nomor Telepon/ WhatsApp belum diisi!</span>
        </div>
        @endguest
        <div class="mb-4">
            <label for="program_id" class="form-label">Kelas *</label>
            <select name="program_id" id="program_id" class="form-control" required>
                <option value="">Pilih Kelas</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" data-referral="{{ $program->referral_required }}">{{ $program->name }}</option>
                @endforeach
            </select>
            <span id="notif-program_id" class="notif-empty">Kelas belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="batch_id" class="form-label">Sesi *</label>
            <select name="batch_id" id="batch_id" class="form-control" required>
                <option value="">Pilih Salah Satu</option>
            </select>
            <span id="notif-batch_id" class="notif-empty">Sesi belum dipilih!</span>
        </div>
        <div class="mb-4">
            <label for="place" class="form-label">Tempat Pelaksanaan *</label>
            <select name="place" id="place" class="form-control" required>
                <option value="">Pilih Salah Satu</option>
            </select>
            <span id="notif-place" class="notif-empty">Tempat Pelaksanaan belum dipilih!</span>
        </div>
        @if(Auth::check() && Auth::user()->role == 'company')
        <input type="hidden" id="user_type" name="user_type" value="company" />
        <input type="hidden" id="instance" name="instance" value="{{ Auth::user()->instance }}" />
        <input type="hidden" id="email" name="email" value="{{ Auth::user()->email }}" />
          <div class="mb-4">
              <label for="number_of_participants" class="form-label">Jumlah Peserta *</label>
              <input type="number" name="number_of_participants" id="number_of_participants" class="form-control form-control-sm" onkeyup="changeJmlPeserta(this)" required />
              <span id="notif-number_of_participants" class="notif-empty">Jumlah Peserta belum diisi!</span>
          </div>
          <div id="formInput-company"></div>
        @endif
        <div class="mb-4">
            <label for="reason_to_join" class="form-label">Alasan Mengikuti *</label>
            <input type="text" name="reason_to_join" id="reason_to_join" class="form-control form-control-sm" value="{{ old('reason_to_join') }}">
            <span id="notif-reason_to_join" class="notif-empty">Alasan Mengikuti belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="information_source" class="form-label">Sumber Informasi *</label>
            <select name="information_source" id="information_source" class="form-control form-control-sm" required>
              <option value="">Pilih Salah Satu</option>
              <?php
              $arr_source = array("E-mail", "Guru", "Teman", "Instagram", "WhatsApp");
              for($i = 0; $i < count($arr_source); $i++): ?>
                <option <?=($arr_source[$i] == old('information_source'))? "selected" : ""?>><?=$arr_source[$i]?></option>
              <?php endfor; ?>
            </select>
            <span id="notif-information_source" class="notif-empty">Sumber Informasi belum diisi!</span>
        </div>
        <div class="mb-4">
            <label for="referral" class="form-label">Referral</label>
            <input type="text" name="referral" id="referral" class="form-control form-control-sm" value="{{ old('referral') }}" {{ optional($programs->firstWhere('id', old('program_id')))->referral_required == 'no' ? 'disabled' : '' }}>
            <span id="notif-referral" class="notif-empty">Referral belum diisi!</span>
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

        <p class="mt-4">Keterangan<br />*) Harus diisi</p>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
  function changeJmlPeserta(e) {
      let formCompany = document.getElementById('formInput-company'),
          divParent = document.createElement('div'),
          h5 = document.createElement('h5'),
          div = document.createElement('div'),
          label = document.createElement('label'),
          input = document.createElement('input'),
          span = document.createElement('span')

      setTimeout(function() {
        if (e.value != "" && e.value > 0) {
          let str_form = ''
          for (let i = 0; i < e.value; i++) {
            if (i > 0) {
              formCompany.innerHTML = ""
              divParent = document.createElement('div')
              div = document.createElement('div'),
              label = document.createElement('label'),
              input = document.createElement('input')
            }

            h5.innerText = "Peserta " + (i+1)
            divParent.append(h5)

            label.className = "form-label"
            label.innerText = "Nama Lengkap *"
            input.type = "text"
            input.id = "nama-" + (i+1)
            input.name = "nama-" + (i+1)
            input.className = "form-control form-control-sm"
            span.id = "notif-nama-" + (i+1)
            span.className = "notif-empty"
            span.innerText = "Nama Lengkap belum diisi!"
            div.className = "mb-4"
            div.append(label)
            div.append(input)
            div.append(span)
            divParent.append(div)

            div = document.createElement('div'),
            label = document.createElement('label'),
            input = document.createElement('input')
            span = document.createElement('span')
            label.className = "form-label"
            label.innerText = "Jabatan *"
            input.type = "text"
            input.id = "jabatan-" + (i+1)
            input.name = "jabatan-" + (i+1)
            input.className = "form-control form-control-sm"
            span.id = "notif-jabatan-" + (i+1)
            span.className = "notif-empty"
            span.innerText = "Jabatan belum diisi!"
            div.className = "mb-4"
            div.append(label)
            div.append(input)
            div.append(span)
            divParent.append(div)

            div = document.createElement('div'),
            label = document.createElement('label'),
            input = document.createElement('input'),
            span = document.createElement('span')
            label.className = "form-label"
            label.innerText = "No. Handphone *"
            input.type = "text"
            input.id = "no_handphone-" + (i+1)
            input.name = "no_handphone-" + (i+1)
            input.className = "form-control form-control-sm"
            span.id = "notif-no_handphone-" + (i+1)
            span.className = "notif-empty"
            span.innerText = "No. Handphone belum diisi!"
            div.className = "mb-4"
            div.append(label)
            div.append(input)
            div.append(span)
            divParent.append(div)

            str_form += divParent.outerHTML
          }

          formCompany.innerHTML = str_form
        } else if (e.value == "") {
          formCompany.innerHTML = ""
        }
      }, 700)
    }

    document.getElementById('batch_id').onchange = function(e) {
      let row = {},
          id = 0,
          data = []
      for (let i = 0; i < e.target.length; i++) {
        row = e.target[i]

        if (row.selected) {
          data = JSON.parse(row.dataset.places)
          console.log(data);
          
        }
      }

      for (let i = 0; i < data.length; i++) {
        let option = document.createElement('option')

        option.innerText = data[i]

        document.getElementById('place').append(option)
      }
    }

    document.getElementById('program_id').onchange = function(e) {
      let row = {},
          id = 0,
          data = <?=$batch?>


      for (let i = 0; i < e.target.length; i++) {
        row = e.target[i]

        if (row.selected) {
          id = row.value

          if(row.dataset.referral == 'no'){
            document.getElementById('referral').disabled = true
          }
        }
      }

      for (let i = 0; i < data.length; i++) {
        if (data[i].program_id == id) {
          let option = document.createElement('option')

          option.value = data[i].id
          option.innerText = data[i].name
          option.dataset.places = data[i].program_type

          document.getElementById('batch_id').append(option)
        }
      }
    }
    

    document.getElementById('registrasi').onsubmit = function(event) {
      let isValid = true;
      let notif = document.getElementsByClassName('notif-empty'),
          input = document.getElementsByTagName('input'),
          select = document.getElementsByTagName('select');
    
      for (let i = 0; i < notif.length; i++) {
        notif[i].style.display = 'none';
      }
    
      for (let i = 0; i < input.length; i++) {
        if ((input[i].type == 'text' || input[i].type == 'email') && input[i].value.trim() === '') {
          document.getElementById('notif-' + input[i].id).style.display = 'flex';
          isValid = false;
        }
      }
    
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
