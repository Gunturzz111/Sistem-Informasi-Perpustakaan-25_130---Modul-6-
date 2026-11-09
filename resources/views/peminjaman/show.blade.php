
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ddd;
        }

        h2 {
            margin-top: 0;
        }

        .item {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #2563eb;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Detail Peminjaman</h2>

    <div class="item">
        <span class="label">ID Peminjaman:</span>
        {{ $peminjaman->id }}
    </div>

    <div class="item">
        <span class="label">Nama Anggota:</span>
        {{ $peminjaman->anggota->nama ?? '-' }}
    </div>

    <div class="item">
        <span class="label">Judul Buku:</span>
        {{ $peminjaman->buku->judul ?? '-' }}
    </div>

    <div class="item">
        <span class="label">Tanggal Peminjaman:</span>
        {{ $peminjaman->tanggal_pinjam?->format('d-m-Y') ?? '-' }}
    </div>

    <div class="item">
        <span class="label">Tanggal Pengembalian:</span>
        {{ $peminjaman->tanggal_kembali?->format('d-m-Y') ?? 'Belum dikembalikan' }}
    </div>

    <div class="item">
        <span class="label">Status:</span>
        {{ $peminjaman->status }}
    </div>

    <a href="{{ route('peminjaman.index') }}">
        Kembali ke Daftar Peminjaman
    </a>

</div>

</body>
</html>
