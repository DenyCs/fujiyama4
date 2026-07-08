@extends('client::layouts.guest')

@section('title', 'Keranjang Belanja — Fujiyama Ramen')

@section('content')
 <div x-data="cartPage()" class="min-h-screen pt-20 pb-16 bg-white dark:bg-neutral-950">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-black font-['Noto_Sans_JP'] text-neutral-900 dark:text-white mb-2">Keranjang</h1>
            <p class="text-neutral-600 dark:text-neutral-400">Review pesananmu sebelum checkout.</p>
        </div>

        <!-- Empty Cart (hidden when items exist) -->
        <div x-show="items.length === 0" x-cloak class="text-center py-20">
            <div class="text-6xl mb-6">🛒</div>
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-white mb-3">Keranjang Kosong</h2>
            <p class="text-neutral-500 mb-8">Sepertinya kamu belum menambahkan menu apapun.</p>
            <a href="{{ route('client.home') }}#menu-unggulan"
                class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 hover:bg-orange-500 text-white font-semibold rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Lihat Menu
            </a>
        </div>

        <!-- Cart Items (hidden when empty) -->
        <template x-if="items.length > 0">
        <div>
            <!-- Cart Table -->
            <div class="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl overflow-hidden mb-8 shadow-sm dark:shadow-none">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-neutral-200 dark:border-neutral-800">
                                <th class="text-left px-6 py-4 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Menu</th>
                                <th class="text-center px-6 py-4 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Harga</th>
                                <th class="text-center px-6 py-4 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Jumlah</th>
                                <th class="text-center px-6 py-4 text-xs font-semibold text-neutral-500 uppercase tracking-wider">Subtotal</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="item in items" :key="item.id">
                            <tr class="border-b border-neutral-200/50 dark:border-neutral-800/50 hover:bg-neutral-100 dark:hover:bg-neutral-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-xl bg-orange-600/20 flex items-center justify-center text-2xl flex-shrink-0 overflow-hidden">
                                            <img x-show="item.image" :src="'/storage/menus/' + item.image" :alt="item.name" class="w-full h-full object-cover">
                                            <span x-show="!item.image">🍜</span>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-bold text-neutral-900 dark:text-white" x-text="item.name"></h3>
                                            <p class="text-xs text-neutral-500" x-text="item.category"></p>
                                            <p x-show="item.note" class="text-xs text-orange-400 mt-1" x-text="'Catatan: ' + item.note"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-neutral-700 dark:text-neutral-300" x-text="formatRupiah(item.price)"></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button @click="decreaseQty(item.id)"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-500 dark:text-neutral-400 hover:text-orange-400 transition-colors text-lg font-bold leading-none">
                                            −
                                        </button>
                                        <span class="w-10 h-8 flex items-center justify-center text-sm font-semibold text-neutral-900 dark:text-white bg-neutral-100 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 rounded-lg"
                                            x-text="item.qty"></span>
                                        <button @click="increaseQty(item.id)"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-500 dark:text-neutral-400 hover:text-orange-400 transition-colors text-lg font-bold leading-none">
                                            +
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-bold text-orange-600 dark:text-orange-400" x-text="formatRupiah(item.subtotal)"></td>
                                <td class="px-6 py-4 text-center">
                                    <button @click="removeItem(item.id)"
                                        class="p-2 text-neutral-400 hover:text-red-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary & Checkout -->
            <div class="flex flex-col md:flex-row justify-end gap-6">
                <div class="bg-white dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 rounded-2xl p-6 w-full md:w-80 shadow-sm dark:shadow-none">
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-neutral-200 dark:border-neutral-800">
                        <span class="text-sm text-neutral-500 dark:text-neutral-400">Total Item</span>
                        <span class="text-sm font-semibold text-neutral-900 dark:text-white" x-text="totalItems"></span>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-bold text-neutral-900 dark:text-white">Total</span>
                        <span class="text-2xl font-black text-orange-600 dark:text-orange-400" x-text="totalText"></span>
                    </div>
                    <a href="{{ route('order.checkout') }}"
                        class="block w-full text-center py-3 bg-orange-600 hover:bg-orange-500 text-white font-bold rounded-xl transition-colors">
                        Lanjutkan Checkout
                    </a>
                    <a href="{{ route('client.home') }}#menu-unggulan"
                        class="block w-full text-center mt-3 py-3 bg-neutral-100 dark:bg-neutral-800 hover:bg-neutral-200 dark:hover:bg-neutral-700 text-neutral-600 dark:text-neutral-300 text-sm font-medium rounded-xl transition-colors">
                        ← Lanjutkan Belanja
                    </a>
                </div>
            </div>
        </div>
        </template>
    </div>
</div>

@push('scripts')
<script>
function cartPage() {
    return {
        items: @json($cartItems),
        totalItems: {{ $cart->items->sum('qty') }},
        total: {{ $cart->total }},

        get totalText() {
            return this.formatRupiah(this.total);
        },

        async increaseQty(itemId) {
            const item = this.items.find(i => i.id === itemId);
            if (!item || item.qty >= 99) return;
            await this.updateQty(itemId, item.qty + 1);
        },

        async decreaseQty(itemId) {
            const item = this.items.find(i => i.id === itemId);
            if (!item || item.qty <= 1) return;
            await this.updateQty(itemId, item.qty - 1);
        },

        async updateQty(itemId, newQty) {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            try {
                const res = await fetch(`/cart/${itemId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ qty: newQty })
                });
                const data = await res.json();
                if (data.success) {
                    // Update item in array → Alpine reactivity re-renders the row
                    const item = this.items.find(i => i.id === itemId);
                    if (item) {
                        item.qty = newQty;
                        item.subtotal = item.price * newQty;
                    }
                    // Refresh total from server response (authoritative)
                    this.total = parseInt(data.total.replace(/\D/g, ''));
                    this.totalItems = data.count;
                    // Sync badge
                    this.syncCartBadge(data.count);
                }
            } catch (e) {
                console.error('Error updating qty:', e);
            }
        },

        async removeItem(itemId) {
            if (!confirm('Hapus item ini dari keranjang?')) return;
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            try {
                const res = await fetch(`/cart/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    },
                });
                const data = await res.json();
                if (data.success) {
                    // Remove item from array → Alpine reactivity removes the row
                    this.items = this.items.filter(i => i.id !== itemId);
                    this.total = parseInt(data.total.replace(/\D/g, ''));
                    this.totalItems = data.count;
                    // Sync badge
                    this.syncCartBadge(data.count);
                }
            } catch (e) {
                console.error('Error removing item:', e);
            }
        },

        syncCartBadge(count) {
            // Update the global Alpine cart store count
            if (window.Alpine && Alpine.store('cart')) {
                Alpine.store('cart').count = count;
            }
        },

        formatRupiah(value) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        }
    }
}
</script>
@endpush
@endsection