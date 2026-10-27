
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - Curriculum Vitae</title>

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

        .cv {
            max-width: 900px;
            margin: auto;
            background: #fffdf9;
            padding: 45px;
            box-shadow: 0 5px 20px #00000012;
        }

        .actions {
            max-width: 900px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            background: #76574a;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .delete {
            background: #a94442;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            border-bottom: 2px solid #d8c8bb;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 38px;
            margin: 0 0 8px;
            color: #604438;
            overflow-wrap: anywhere;
        }

        .subtitle {
            font-size: 19px;
            color: #927567;
        }

        .photo {
            width: 145px;
            height: 145px;
            border-radius: 50%;
            object-fit: cover;
            background: #e8ded5;
            flex-shrink: 0;
        }

        .columns {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 35px;
        }

        section {
            margin-bottom: 26px;
            overflow-wrap: anywhere;
        }

        h2 {
            font-size: 17px;
            color: #76574a;
            margin: 0 0 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        p, li {
            font-size: 14px;
            line-height: 1.7;
        }

        p {
            margin-top: 0;
        }

        ul {
            padding-left: 20px;
            margin-top: 5px;
        }

        .contact p {
            margin-bottom: 10px;
        }

        .entry {
            border-bottom: 1px solid #e9dfd6;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }

        .empty {
            text-align: center;
            padding: 40px 10px;
        }

        .entry-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .cv {
                padding: 22px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column-reverse;
            }

            h1 {
                font-size: 29px;
            }

            .photo {
                width: 115px;
                height: 115px;
            }

            .columns {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .actions {
                flex-wrap: wrap;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .actions, .entry-actions {
                display: none;
            }

            .cv {
                box-shadow: none;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="actions">
        <a href="{{ route('biodata.create') }}" class="btn">
            + Tambah Biodata
        </a>

        <button onclick="window.print()" class="btn">
            Cetak CV
        </button>
    </div>

    <main class="cv">

        @if(session('success'))
            <p style="color:green;">
                {{ session('success') }}
            </p>
        @endif

        @forelse($biodata as $data)

            <article class="entry">

                <header class="header">
                    <div>
                        <h1>{{ $data->nama }}</h1>
                        <div class="subtitle">Curriculum Vitae</div>
                    </div>

                    @if($data->foto)
                        <img
                            src="{{ asset('storage/' . $data->foto) }}"
                            alt="Foto {{ $data->nama }}"
                            class="photo"
                        >
                    @else
                        <div class="photo"
                             style="display:flex;align-items:center;
                             justify-content:center;font-size:48px;
                             color:#76574a;">
                            {{ strtoupper(substr($data->nama, 0, 1)) }}
                        </div>
                    @endif
                </header>

                <div class="columns">

                    <div>
                        <section>
                            <h2>Profil</h2>
                            <p>
                                {{ $data->deskripsi ?: 'Belum ada deskripsi profil.' }}
                            </p>
                        </section>

                        <section>
                            <h2>Pendidikan</h2>
                            <p>
                                {{ $data->pendidikan ?: 'Belum diisi' }}
                            </p>
                        </section>

                        <section>
                            <h2>Keahlian</h2>
                            @if($data->keahlian)
                                <ul>
                                    @foreach(explode(',', $data->keahlian) as $skill)
                                        <li>{{ trim($skill) }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Belum ada keahlian yang ditambahkan.</p>
                            @endif
                        </section>
                    </div>

                    <div>
                        <section class="contact">
                            <h2>Kontak</h2>
                            <p>☎ {{ $data->telepon ?: 'Belum diisi' }}</p>
                            <p>✉ {{ $data->email ?: 'Belum diisi' }}</p>
                            <p>⌖ {{ $data->alamat ?: 'Belum diisi' }}</p>
                        </section>

                        <section>
                            <h2>Informasi Diri</h2>
                            <p>
                                Nama: {{ $data->nama }}<br>
                                Email: {{ $data->email ?: '-' }}<br>
                                Telepon: {{ $data->telepon ?: '-' }}
                            </p>
                        </section>
                    </div>

                </div>

                <div class="entry-actions">
                    <a href="{{ route('biodata.edit', $data->id) }}"
                       class="btn">Edit CV</a>

                    <form action="{{ route('biodata.destroy', $data->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus biodata ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete">
                            Hapus
                        </button>
                    </form>
                </div>

            </article>

        @empty
            <div class="empty">
                <h2>Belum Ada Biodata</h2>
                <p>Silakan tambahkan biodata untuk membuat CV kamu.</p>
                <a href="{{ route('biodata.create') }}" class="btn">
                    Buat CV Sekarang
                </a>
            </div>
        @endforelse

    </main>

</body>
</html>
