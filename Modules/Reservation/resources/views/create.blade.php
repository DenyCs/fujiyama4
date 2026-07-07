@extends('client::layouts.guest')

@section('title', 'Reservasi Meja — Fujiyama Ramen')

@section('content')
<div class="min-h-screen bg-neutral-950 pt-24 pb-16">
    <div class="max-w-2xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-white mb-2">Reservasi Meja</h1>
        <p class="text-neutral-400 mb-8">Pesan meja terlebih dahulu untuk pengalaman makan yang lebih nyaman.</p>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
            @if ($errors->any())
                <div class="mb-4 bg-red-900/30 border border-red-800 text-red-300 rounded-lg p-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-neutral-300 mb-1">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Masukkan nama Anda" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-neutral-300 mb-1">Nomor HP / WhatsApp *</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Contoh: 08123456789" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="reservation_date" class="block text-sm font-medium text-neutral-300 mb-1">Tanggal *</label>
                            <input type="date" id="reservation_date" name="reservation_date" value="{{ old('reservation_date') }}"
                                class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                required>
                        </div>
                        <div>
                            <label for="reservation_time" class="block text-sm font-medium text-neutral-300 mb-1">Jam *</label>
                            <input type="time" id="reservation_time" name="reservation_time" value="{{ old('reservation_time') }}"
                                class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                required>
                        </div>
                    </div>

                    <div>
                        <label for="guest_count" class="block text-sm font-medium text-neutral-300 mb-1">Jumlah Orang *</label>
                        <select id="guest_count" name="guest_count"
                            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            required>
                            <option value="" disabled {{ old('guest_count') ? '' : 'selected' }}>-- Pilih Jumlah --</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('guest_count') == $i ? 'selected' : '' }}>{{ $i }} Orang</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="note" class="block text-sm font-medium text-neutral-300 mb-1">Catatan (opsional)</label>
                        <textarea id="note" name="note" rows="3"
                            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Contoh: Area non-smoking, kursi bayi, dll.">{{ old('note') }}</textarea>
                    </div>
                </div>

                <div class="bg-orange-900/20 border border-orange-800 rounded-lg p-4 mt-4">
                    <p class="text-orange-300 text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        Konfirmasi reservasi akan dikirim melalui WhatsApp.
                    </p>
                </div>

                <button type="submit"
                    class="mt-6 w-full bg-green-600 hover:bg-green-500 text-white font-semibold py-3 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Reservasi via WhatsApp
                </button>
            </form>
        </div>

        {{-- Pre-order Cart Summary --}}
        <div class="mt-8 bg-neutral-900 border border-neutral-800 rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                Pre-Order Menu (Opsional)
            </h2>

            @if ($cart->items->isEmpty())
                <div class="text-neutral-400 text-sm py-4 text-center border border-dashed border-neutral-700 rounded-lg">
                    Belum ada menu dipilih. <a href="{{ route('client.menu') }}" class="text-orange-400 hover:text-orange-300 underline">Pilih menu dulu</a> jika ingin pre-order.
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($cart->items as $item)
                        <div class="flex items-center justify-between bg-neutral-800 rounded-lg p-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-white text-sm font-medium truncate">{{ $item->menu->name }}</p>
                                <p class="text-neutral-400 text-xs">{{ $item->qty }}x — Rp {{ number_format($item->menu->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="text-orange-400 font-semibold text-sm ml-4 flex-shrink-0">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    <div class="border-t border-neutral-700 pt-3 flex justify-between items-center">
                        <span class="text-white font-semibold">Total Pre-Order</span>
                        <span class="text-orange-400 font-bold text-lg">
                            Rp {{ number_format($cart->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('cart.index') }}" class="block text-center text-sm text-orange-400 hover:text-orange-300 mt-1">
                        Edit keranjang →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
