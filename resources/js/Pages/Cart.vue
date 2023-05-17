<template>
  <Head title="Cart" />

  <AuthenticateLayout>
    <div class="flex gap-4">
      <div class="w-full bg-white p-4 mt-4">
        <div class="border-b">
          <div class="text-[27px] font-semibold">Shopping cart</div>
          <div class="text-sm w-full flex justify-end items-center">Price</div>
        </div>

        <div v-if="!cart.length" class="text-center font-bold text-2xl py-20">
          <div class="flex justify-center mb-4">
            <CartOffIcon :size="50" />
          </div>
          Your Amazon Cart is empty
        </div>

        <div v-else class="flex border-b" v-for="product in cart" :key="product">
          <img :src="product.image" class="h-[180px] mt-4 mb-4" alt="" />
          <div class="flex justify-between mb-4">
            <div class="pl-8 py-10 relative">
              <div class="text-gray-900 pb-2 -mt-4 font-bold text-[18px]">
                {{ product.title }}
              </div>
              <span>{{ product.description.substring(0, 180) }}...</span>
              <div class="text-teal-600 py-2">In Stock</div>
              <div class="text-teal-600 absolute bottom-0 mb-4 flex items-center">
                <div
                  @click="removeFromCart(product.id)"
                  class="text-sm hover:underline hover:text-red-700 cursor-pointer"
                >
                  Delete
                </div>
              </div>
            </div>

            <div class="py-10 justify-end">
              <div class="font-bold pl-20">{{ product.price }}</div>
            </div>
          </div>
        </div>

        <div class="font-extrabold text-[18px] pt-4 text-right">
          Subtotal (Items: {{ cart.length }}) : ${{ total }}
        </div>
      </div>

      <div class="bg-white w-[350px] p-4 mt-4 h-48">
        <div class="text-sm text-green-700">
          Welcome to Amazon! FREE Delivery on your first order to UK or Ireland. Select
          this option at checkout.
        </div>
        <div class="font-extrabold text-[18px] pt-4">
          Subtotal (Items: {{ cart.length }}) : ${{ total }}
        </div>
        <Link
          :disabled="Number(total) == 0.0"
          :class="
            Number(total) == 0.0 ? 'bg-gray-400' : 'bg-yellow-400 hover:bg-yellow-400'
          "
          class="block mt-4 w-full text-center py-1 font-bold text-sm rounded-lg border shadow-sm cursor-pointer"
          href="/"
        >
          Proceed to Checkout
        </Link>

        <!-- Return below code when checkout route is created.
        
        method="post"
        as="button"
        :href="
            $page.props.auth.user != null
              ? route('checkout.index', {
                  total: totalWithoutDot(),
                  totalDecimal: total,
                  items: cart,
                })
              : route('login')
          "
         -->
      </div>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import { computed, toRefs } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import CartOffIcon from "vue-material-design-icons/CartOff.vue";

import { useCartStore } from "@/store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();

// NOTE: `cart` is state property from the store.
const { cart } = storeToRefs(cartStore);

const removeFromCart = (_id) => {
  cartStore.removeProductFromCart(_id);
};

// NOTE: since cart is a reactive property, wrapping it in computed property means
// whenever cart changes, total will be updated.
const total = computed(() => {
  let sum = cart.value.reduce((acc, item) => {
    return acc + item.price;
  }, 0);
  return sum > 0 ? sum.toFixed(2) : 0;
});

// const totalWithoutDot = () => {
//   let num = String(total.value).split(".").join("");
//   return Number(num);
// };
</script>

<style lang="scss" scoped></style>
