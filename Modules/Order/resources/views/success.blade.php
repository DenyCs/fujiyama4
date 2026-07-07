@extends('client::layouts.guest')

@section('title', 'Pesanan Berhasil — Fujiyama Ramen')

@section('content')
<div class="min-h-screen bg-neutral-950 pt-24 pb-16">
    <div class="max-w-2xl mx-auto px-4 text-center">
        {{-- Success Icon --}}
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-500/20 mb-6">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-900/30 border border-green-800 text-green-300 rounded-lg px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-white mb-3">Pesanan Berhasil!</h1>
        <p class="text-neutral-400 mb-8">Terima kasih telah memesan di Fujiyama Ramen. Berikut detail pesanan Anda:</p>

        {{-- Order Details Card --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6 text-left mb-8">
            <div class="flex items-center justify-between mb-6">
                <span class="text-neutral-400 text-sm">Kode Pesanan</span>
                <span class="text-xl font-bold text-orange-500 tracking-wider">{{ $order->order_code }}</span>
            </div>

            <div class="border-t border-neutral-800 pt-4 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-neutral-400">Nama</span>
                    <span class="text-white font-medium">{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-400">No. HP</span>
                    <span class="text-white font-medium">{{ $order->customer_phone }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-400">Metode Bayar</span>
                    <span class="text-white font-medium">{{ $order->payment_method === 'transfer' ? 'Transfer Bank' : 'Bayar di Tempat (COD)' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-400">Status</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-900/30 text-yellow-400 border border-yellow-800">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                @if($order->note)
                <div class="flex justify-between">
                    <span class="text-neutral-400">Catatan</span>
                    <span class="text-white font-medium">{{ $order->note }}</span>
                </div>
                @endif
            </div>

            {{-- Order Items --}}
            <div class="border-t border-neutral-800 mt-4 pt-4">
                <h3 class="text-sm font-semibold text-neutral-300 mb-3">Item Pesanan</h3>
                <div class="divide-y divide-neutral-800">
                    @foreach($order->items as $item)
                        <div class="py-2 flex justify-between items-center">
                            <div>
                                <p class="text-white text-sm">{{ $item->menu_name }}</p>
                                <p class="text-neutral-500 text-xs">{{ $item->qty }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="text-white text-sm font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-neutral-700 mt-3 pt-3 flex justify-between items-center">
                    <span class="text-lg font-bold text-white">Total</span>
                    <span class="text-lg font-bold text-orange-500">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('client.menu') }}"
                class="px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-semibold rounded-lg transition-colors duration-200">
                Pesan Lagi
            </a>
            <a href="{{ route('client.home') }}"
                class="px-6 py-3 bg-neutral-800 hover:bg-neutral-700 text-white font-semibold rounded-lg transition-colors duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection