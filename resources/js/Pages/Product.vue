<template>
  <Head title="Product" />

  <AuthenticateLayout>
    <div class="mt-16"></div>

    <div class="max-w-[1200px] mx-auto flex gap-4 justify-between">
      <div class="w-2/5">
        <img :src="product.image" alt="" />
      </div>

      <div class="w-2/5">
        <div class="text-xl font-extrabold border-b border-b-gray-300 mb-2 pb-2">
          {{ product.title }}
        </div>
        <div>
          <div class="text-lg font-extrabold m-1">About this item</div>
          <div>{{ product.description }}</div>
        </div>
      </div>

      <div class="w-1/5">
        <div class="border border-gray-300 rounded-lg">
          <div class="my-2 mx-3 mb-2">
            <div class="flex items-center justify-center border-b border-gray-300 pb-1">
              <Link
                v-if="$page.props.auth.user"
                :href="route('address.index')"
                class="flex items-center text-xs font-extrabold text-teal-700 hover:text-red-600 cursor-pointer"
              >
                <MapMarkerOutlineIcon :size="17" /> Delivery to
                {{ $page.props.auth.user.first_name }} -
                {{ $page.props.auth.address.postalcode }}
              </Link>
              <Link
                v-else
                :href="route('login')"
                class="flex items-center text-xs font-extrabold text-teal-700 hover:text-red-600 cursor-pointer"
              >
                SIGN IN
              </Link>
            </div>

            <div class="flex items-center justify-between pt-2">
              <div class="text-red-600 text-sm font-bold">{{ product.price }}</div>
              <button
                :disabled="isAlreadyInCart"
                @click="addToCart(product)"
                class="bg-yellow-400 px-2 font-bold text-sm rounded-lg border shadow-sm cursor-pointer"
              >
                <span v-if="isAlreadyInCart">Item added</span>
                <span v-else>Add to cart</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import { computed, toRefs } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import MapMarkerOutlineIcon from "vue-material-design-icons/MapMarkerOutline.vue";

import { useCartStore } from "@/store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();

// NOTE: `cart` is state property from the store.
const { cart } = storeToRefs(cartStore);

// NOTE: `product` is passed from the controller.
// and it's similar to `$page.props.product` accessible in the template.
const props = defineProps({ product: Object });
const { product } = toRefs(props);

// TIP: Mutatating state directly in pinia e.g. `cart.value.push(_product)` is considered
// valid practice thus don't worry about it.
const addToCart = (_product) => {
  cart.value.push(_product);
};

const isAlreadyInCart = computed(() => {
  let result = cart.value.find((item) => item.id === product.value.id);
  if (result) return true;
  return false;
});
</script>

<style lang="scss" scoped></style>
