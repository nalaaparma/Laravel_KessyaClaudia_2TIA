
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah CV</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            background: #eeeae6;
            font-family: Arial, sans-serif;
            color: #51443e;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: #fffdf9;
            border-radius: 12px;
            box-shadow: 0 5px 20px #00000012;
        }

        h1 {
            margin-top: 0;
            color: #604438;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #927567;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #d8c8bb;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: 2px solid #b99b89;
            border-color: #76574a;
        }

        .help {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #806f65;
        }

        .error {
            color: #b42318;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .save {
            background: #76574a;
            color: white;
            flex: 1;
        }

        .back {
            background: #e8ded5;
            color: #51443e;
        }

        .save:hover {
            background: #604438;
        }

        .back:hover {
            background: #d8c8bb;
        }

        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Tambah CV</h1>
    <p class="subtitle">Lengkapi informasi diri untuk membuat Curriculum Vitae.</p>

    @if ($errors->any())
        <div style="background:#fff0ee; padding:12px; margin-bottom:20px; border-radius:6px;">
            <strong>Periksa kembali data kamu:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biodata.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input
                type="text"
                name="nama"
                id="nama"
                value="{{ old('nama') }}"
                placeholder="Masukkan nama lengkap"
                required
            >
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                placeholder="contoh@email.com"
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon</label>
            <input
                type="text"
                name="telepon"
                id="telepon"
                value="{{ old('telepon') }}"
                placeholder="Masukkan nomor telepon"
            >
            @error('telepon')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea
                name="alamat"
                id="alamat"
                placeholder="Masukkan alamat kamu"
            >{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="pendidikan">Pendidikan</label>
            <input
                type="text"
                name="pendidikan"
                id="pendidikan"
                value="{{ old('pendidikan') }}"
                placeholder="Contoh: D3 Teknik Informatika"
            >
            @error('pendidikan')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="keahlian">Keahlian</label>
            <textarea
                name="keahlian"
                id="keahlian"
                placeholder="Pisahkan setiap keahlian dengan koma. Contoh: HTML, CSS, Laravel"
            >{{ old('keahlian') }}</textarea>
            <small class="help">Pisahkan setiap keahlian menggunakan tanda koma (,).</small>
            @error('keahlian')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Profil / Tentang Saya</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                placeholder="Ceritakan tentang diri, minat, dan tujuan kamu"
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto Profil</label>
            <input
                type="file"
                name="foto"
                id="foto"
                accept="image/jpeg,image/png,image/webp"
            >
            <small class="help">
                Format JPG, PNG, atau WEBP. Ukuran maksimal 2 MB.
            </small>
            @error('foto')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">
            <a href="{{ route('biodata.index') }}" class="btn back">
                Kembali
            </a>

            <button type="submit" class="btn save">
                Simpan CV
            </button>
        </div>

    </form>

</div>

</body>
</html>
