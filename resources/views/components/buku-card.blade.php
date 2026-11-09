<article class="book-card">
    
    <div class="book-cover">
        <img src="{{ $cover }}" alt="Sampul buku {{ $judul }}">
        <span class="book-category">{{ $kategori }}</span>
    </div>

    <div class="book-card-body">
        <h3>{{ $judul }}</h3>
        
        <p class="book-author">Oleh <strong>{{ $penulis }}</strong></p>
        <p class="book-desc">{{ \Illuminate\Support\Str::limit($deskripsi, 70) }}</p>
    </div>

    <div class="book-card-footer">
        <span class="book-year">Rilis: {{ $tahun }}</span>
        {{ $slot }}
    </div>

</article>

