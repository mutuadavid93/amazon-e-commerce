<template>
  <Head title="Checkout" />

  <AuthenticateLayout>
    <div class="p-4 mt-2 max-w-[1250px] mx-auto text-3xl font-extrabold">Checkout</div>

    <div class="flex pt-4 max-w-[1250px] mx-auto">
      <!-- w-8/12: 66% -->
      <div class="w-8/12">
        <div
          class="flex items-stretch border-b border-gray-300 w-[calc(100%-100px)] pb-4 pl-4 mb-6"
        >
          <div class="text-gray-900 font-extrabold text-xl mr-12">Shipping Address</div>
          <div class="px-4 font-semibold">
            <div>
              {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
            </div>
            <div>{{ $page.props.auth.address.address1 }}</div>
            <div>{{ $page.props.auth.address.address2 }}</div>
            <div>{{ $page.props.auth.address.city }}</div>
            <div>{{ $page.props.auth.address.postalcode }}</div>
            <div>{{ $page.props.auth.address.country }}</div>
          </div>
        </div>
      </div>

      <!-- w-4/12: 33%. Thus it totals to 66% + 33% = 100% 
      
      TIP: The numerators should add up to 12. e.g. 8+4=12 But the denominator should always be 12.
      -->
      <div class="w-4/12 border border-gray-400 rounded-md py-4 px-2">
        <form>
          <div id="card-element">
            <!-- Stripe.js injects the Card Element Here... -->
          </div>

          <div
            class="flex justify-between text-xl text-red-700 font-extrabold border-y border-y-gray-300 my-3 p-2"
          >
            <div>Order total:</div>
            <!-- <div v-if="order">USD: {{ order.total_decimal }}</div> -->
          </div>
          <button
            id="submit"
            class="bg-yellow-400 hover:bg-yellow-500 rounded-md text-sm font-extrabold p-2"
          >
            <!-- <div v-if="isProcessing" id="button-text">Processing...</div>
            <div v-else id="button-text">Place your order in USD</div> -->
            <div id="button-text">Place your order in USD</div>
          </button>

          <p
            id="card-error"
            role="alert"
            class="text-red-700 text-center font-semibold"
          ></p>
        </form>
      </div>
    </div>

    <div class="w-[1200px] mx-auto text-xl font-bold pb-2 underline">Items</div>
    <div class="w-[1200px] mx-auto">
      <div class="flex items-center py-1">PRODUCT DETAILS HERE</div>
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
