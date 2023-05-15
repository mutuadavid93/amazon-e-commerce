<template>
  <Head title="Category" />

  <AuthenticateLayout>
    <div class="w-full p-1 pt-2 mb-6">
      <div class="text-[27px] font-extrabold">{{ $page.props.category_name.name }}</div>
      <div class="text-sm font-bold">
        Shop home entertainment, TVs, home audio, headphones, cameras, accessories and
        more
      </div>
    </div>

    <div class="border border-gray-300 rounded-lg text-sm py-3.5 px-10 mb-4">
      1-{{ $page.props.category_by_id.length }} of over
      {{ $page.props.category_by_id.length }} results for
      {{ $page.props.category_name.name }}
    </div>

    <div class="grid grid-cols-4 gap-1">
      <div v-for="product in $page.props.category_by_id" :key="product" class="m-1">
        <Product :product="product" />
      </div>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Product from "@/Components/ProductItem.vue";
</script>

<style lang="scss" scoped></style>
