<template>
  <Head title="Address" />

  <AuthenticateLayout>
    <div class="mt-12"></div>
    <div class="max-w-[1000px] mx-auto text-3xl mb-10">Your Addresses</div>

    <!-- NOTE: gap-2 : is used to place the items next to each other instead of 
    `justify-between` which would tose the items to the extreme left and right of the container.
 -->
    <div class="max-w-[1000px] mx-auto flex gap-2 h-[270px]">
      <div class="border border-dotted border-gray-400 rounded-md w-1/3">
        <Link v-if="!$page.props.auth.address" :href="route('address_options.index')">
          <!-- TIP: place-items-center: aligns the content of the grid container 
        vertically and horizontally at the center i.e. Dead-center -->
          <div class="grid h-full place-items-center cursor-pointer">
            <div class="text-center">
              <!-- TIP: justify-center: aligns the child elements horizontally 
          at the center of the container. -->
              <div class="flex justify-center">
                <PlusIcon :size="50" />
              </div>
              <div class="font-bold text-2xl">Add Address</div>
            </div>
          </div>
        </Link>

        <div v-else class="grid h-full place-items-center">
          <div class="text-center">
            <div class="flex justify-center">
              <CheckCircleIcon  :size="50" />
            </div>
            <div class="font-bold text-2xl">Address is added</div>
          </div>
        </div>
      </div>

      <div
        v-if="$page.props.auth.address"
        class="relative border border-gray-400 rounded-md w-1/3 shadow-md"
      >
        <div
          class="flex items-center justify-start p-3 text-xs text-gray-600 font-extrabold border-b border-b-gray-400"
        >
          Default:
          <img class="h-3 mt-1.5 ml-2" src="/images/logo/AMAZON_LOGO_DARK.png" alt="" />
        </div>
        <div class="text-sm font-extrabold px-4 pt-4">
          {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
        </div>
        <div class="text-sm px-4">
          <div>{{ $page.props.auth.address.address1 }}</div>
          <div>{{ $page.props.auth.address.address2 }}</div>
          <div>{{ $page.props.auth.address.city }}</div>
          <div>{{ $page.props.auth.address.postalcode }}</div>
          <div>{{ $page.props.auth.address.country }}</div>
        </div>
        <div class="px-4 absolute bottom-0 pb-4">
          <Link
            :href="route('address_options.destroy', { id: $page.props.auth.address.id })"
            method="post"
            as="button"
            class="text-teal-700 text-sm font-extrabold hover:underline hover:text-red-700"
            >Remove</Link
          >
        </div>
      </div>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import { toRefs } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import MapMarkerOutlineIcon from "vue-material-design-icons/MapMarkerOutline.vue";
import PlusIcon from "vue-material-design-icons/Plus.vue";
import CheckCircleIcon from "vue-material-design-icons/CheckCircleOutline.vue";

// NOTE: `product` is passed from the controller.
// and it's similar to `$page.props.product` accessible in the template.
const props = defineProps({ product: Object });
const { product } = toRefs(props);
</script>

<style lang="scss" scoped></style>
