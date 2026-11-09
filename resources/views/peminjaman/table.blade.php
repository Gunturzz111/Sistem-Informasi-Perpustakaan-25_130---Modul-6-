<table><thead><tr><th>Anggota</th><th>Buku</th><th>Tanggal Pinjam</th><th>Status</th><th>Tanggal Kembali</th><th>Aksi</th></tr></thead><tbody>
@forelse($peminjamans as $item)
<tr>
<td>{{ $item->anggota->nama ?? '-' }}</td><td>{{ $item->buku->judul ?? '-' }}</td><td>{{ $item->tanggal_pinjam }}</td>
<td>{{ ucfirst($item->status ?? ($item->tanggal_kembali ? 'dikembalikan' : 'menunggu')) }}</td><td>{{ $item->tanggal_kembali ?? '-' }}</td>
<td>
@can('memproses persetujuan peminjaman')
@if(($item->status ?? 'menunggu') === 'menunggu')
<form method="POST" action="{{ route('peminjaman.approve',$item) }}">@csrf @method('PATCH')<button>Setujui</button></form>
@endif
@endcan
@can('mencatat pengembalian buku')
@if($item->status === 'disetujui')
<form method="POST" action="{{ route('peminjaman.return',$item) }}">@csrf @method('PATCH')<button>Kembalikan</button></form>
@endif
@endcan
</td></tr>
@empty<tr><td colspan="6">Belum ada data peminjaman.</td></tr>@endforelse
</tbody></table>
