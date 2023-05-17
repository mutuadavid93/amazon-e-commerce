//  see - https://pinia.vuejs.org/introduction.html#basic-example
// stores/counter.js
import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({ cart: [] }),
    // could also be defined as
    // state: () => ({ count: 0 })
    actions: {
        removeProductFromCart(productId) {
            this.cart.forEach((product, index) => {
                if (product.id === productId) {
                    this.cart.splice(index, 1);
                }
            });
        },
    },

    persist: true, // uses localStorage under the hood
});
