import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        count: window.__CART_COUNT__ || 0,

        async addItem(menuId, qty = 1) {
            try {
                const res = await fetch('/cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ menu_id: menuId, qty }),
                });
                const data = await res.json();
                if (data.success) {
                    this.count = data.count;
                    return true;
                }
            } catch (e) {
                console.error('Cart add error:', e);
            }
            return false;
        },

        setCount(n) {
            this.count = n;
        }
    });
});

Alpine.start();