<template>
  <Head title="Checkout Success" />

  <AuthenticateLayout>
    <div class="mt-10 m-6 max-w-xl mx-auto text-3xl font-extrabold">Checkout Success</div>

    <!-- TIP: max-w-xl mx-auto: This classes define container width -->
    <div class="max-w-xl mx-auto">
      <div class="flex flex-col p-5 rounded-lg shadow bg-white">
        <div class="flex flex-col items-center text-center">
          <div class="inline-block p-4 bg-green-100 rounded-full">
            <CheckIcon :size="100" fillColor="#7CFC00" />
          </div>

          <h2 class="mt-2 font-semibold text-2xl text-gray-800">Success</h2>

          <p class="mt-2 text-lg font-bold text-gray-600 leading-relaxed">
            Your order is on the way. Thank you for shopping with us.
          </p>
        </div>

        <Link :href="route('dashboard')" class="items-center mt-3">
          <button
            class="flex-1 px-4 py-2 ml-2 bg-yellow-500 hover:bg-yellow-500 text-green-900 font-bold rounded-md"
          >
            <div>Back to Dashboard</div>
          </button>
        </Link>
      </div>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import { computed, onMounted, toRefs } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import CheckIcon from "vue-material-design-icons/Check.vue";

import { useCartStore } from "@/store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();

// NOTE: `cart` is state property from the store.
const { cart } = storeToRefs(cartStore);

onMounted(() => {
  // NOTE: Clear the cart after successful checkout.
  cart.value = [];
});
</script>

<style lang="scss" scoped></style>
