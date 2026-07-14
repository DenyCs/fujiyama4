@extends('admin::layouts.master')

@section('title', 'Konten Section')
@section('page-title', 'Konten Section')
@section('page-subtitle', 'Kelola judul, subtitle, dan badge teks pada section landing page.')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Konten Section</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.section-content.update') }}" method="POST">
            @csrf

            @php
                $fields = [
                    'menu_unggulan' => ['label' => 'Menu Unggulan', 'default_badge' => "Chef's Selection", 'default_title' => 'Menu Unggulan', 'default_subtitle' => 'Pilihan terbaik dari dapur kami, dibuat dengan bahan segar dan penuh cita rasa.'],
                    'tentang_kami' => ['label' => 'Tentang Kami', 'default_badge' => 'Tentang Fujiyama Ramen', 'default_title' => 'Cerita Kami', 'default_subtitle' => 'Dari hati untuk setiap mangkuk yang tersaji.'],
                    'galeri_foto' => ['label' => 'Galeri Foto', 'default_badge' => '📸 Momen di Fujiyama', 'default_title' => 'Galeri Foto', 'default_subtitle' => 'Intip keseruan di balik layar dan suasana hangat di Fujiyama Ramen.'],
                    'lokasi_jam_buka' => ['label' => 'Lokasi & Jam Buka', 'default_badge' => 'Kunjungi Kami', 'default_title' => 'Lokasi & Jam Buka', 'default_subtitle' => ''],
                    'testimoni' => ['label' => 'Testimoni', 'default_badge' => '', 'default_title' => 'Apa Kata *Pelanggan* Kami', 'default_subtitle' => 'Setiap mangkuk punya cerita. Simak pengalaman para pelanggan setia kami.'],
                    'event_promo' => ['label' => 'Event & Promo', 'default_badge' => 'Event & Promo', 'default_title' => 'Jangan Lewatkan Keseruannya!', 'default_subtitle' => 'Ikuti event spesial dan promo menarik dari Fujiyama Ramen.'],
                    'faq' => ['label' => 'FAQ', 'default_badge' => 'Pertanyaan yang Sering Diajukan', 'default_title' => 'FAQ', 'default_subtitle' => 'Semua yang perlu kamu tahu tentang Fujiyama Ramen.'],
                ];
            @endphp

            @foreach($fields as $key => $field)
                @php
                    $section = $sections->get($key);
                    $badge = old("sections.$key.badge_text", $section->badge_text ?? $field['default_badge']);
                    $title = old("sections.$key.title", $section->title ?? $field['default_title']);
                    $subtitle = old("sections.$key.subtitle", $section->subtitle ?? $field['default_subtitle']);
                @endphp
                <div class="card mb-3 shadow-sm border">
                    <div class="card-header bg-light">
                        <strong>{{ $field['label'] }}</strong>
                        <small class="text-muted ms-2">(section_key: <code>{{ $key }}</code>)</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Badge Text</label>
                            <input type="text" class="form-control" name="sections[{{ $key }}][badge_text]" value="{{ $badge }}" placeholder="Teks badge kecil di atas judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sections[{{ $key }}][title]" value="{{ $title }}" required>
                            <small class="text-muted">Gunakan <code>*kata*</code> untuk memberi efek gradient (contoh: Apa Kata *Pelanggan* Kami)</small>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Subtitle</label>
                            <textarea class="form-control" name="sections[{{ $key }}][subtitle]" rows="2">{{ $subtitle }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Semua
                </button>
            </div>
        </form>
    </div>
</div>
@endsection