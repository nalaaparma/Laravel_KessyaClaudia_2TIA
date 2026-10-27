
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata CV</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #eeeae6;
            padding: 30px 15px;
            margin: 0;
            color: #51443e;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: #fffdf9;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px #00000012;
        }

        h1 {
            color: #604438;
            text-align: center;
            margin-top: 0;
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

        input[type="text"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 11px;
            margin-top: 5px;
            border: 1px solid #d8c8bb;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: 2px solid #b99b89;
        }

        .photo-preview {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #e8ded5;
            display: block;
            margin: 12px 0;
        }

        .help {
            display: block;
            font-size: 12px;
            color: #806f65;
            margin-top: 7px;
        }

        .delete-photo {
            background: #fff0ee;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
        }

        .delete-photo label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
            margin: 0;
        }

        .delete-photo input[type="checkbox"] {
            width: auto;
            margin: 0;
        }

        .error {
            color: #b42318;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        button,
        .back {
            display: inline-block;
            padding: 12px 18px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #76574a;
            color: white;
        }

        button:hover {
            background: #604438;
        }

        .back {
            background: #e8ded5;
            color: #51443e;
        }

        .back:hover {
            background: #d8c8bb;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Biodata CV</h1>
    <p class="subtitle">Perbarui informasi dan foto profil kamu.</p>

    @if (session('success'))
        <p style="color:green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div class="error">
            <strong>Data belum berhasil disimpan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('biodata.update', $data->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input
                type="text"
                name="nama"
                id="nama"
                value="{{ old('nama', $data->nama) }}"
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
                value="{{ old('email', $data->email) }}"
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telepon">Telepon</label>
            <input
                type="text"
                name="telepon"
                id="telepon"
                value="{{ old('telepon', $data->telepon) }}"
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
            >{{ old('alamat', $data->alamat) }}</textarea>
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
                value="{{ old('pendidikan', $data->pendidikan) }}"
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
                placeholder="Contoh: HTML, CSS, Laravel"
            >{{ old('keahlian', $data->keahlian) }}</textarea>
            <small class="help">
                Pisahkan beberapa keahlian dengan tanda koma.
            </small>
            @error('keahlian')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Diri</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                placeholder="Ceritakan tentang diri kamu"
            >{{ old('deskripsi', $data->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bagian Foto Profil -->
        <div class="form-group">
            <label for="foto">Foto Profil</label>

            @if ($data->foto)
                <p>Foto yang sedang digunakan:</p>

                <img
                    src="{{ asset('storage/' . $data->foto) }}"
                    alt="Foto profil {{ $data->nama }}"
                    class="photo-preview"
                >

                <div class="delete-photo">
                    <label>
                        <input
                            type="checkbox"
                            name="hapus_foto"
                            value="1"
                        >
                        Hapus foto saat ini
                    </label>
                </div>
            @else
                <p>Belum ada foto profil.</p>
            @endif

            <label for="foto">Pilih Foto Baru</label>
            <input
                type="file"
                name="foto"
                id="foto"
                accept="image/jpeg,image/png,image/webp"
            >

            <small class="help">
                Format JPG, PNG, atau WEBP. Ukuran maksimal 2 MB.
                Kosongkan jika tidak ingin mengganti foto.
            </small>

            @error('foto')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">
            <button type="submit">Simpan Perubahan</button>

            <a href="{{ route('biodata.index') }}" class="back">
                Kembali
            </a>
        </div>

    </form>

</div>

</body>
</html>
