<template>
  <Head title="Address" />

  <AuthenticateLayout>
    <div class="mt-8"></div>
    <div class="max-w-[500px] mx-auto text-md">
      <div>Add a new address</div>

      <form action="">
        <div class="text-[15px] -mb-1.5 font-extrabold">Country</div>
        <!-- prettier-ignore -->
        <select
          name="country"
          id="country"
          class="w-full border border-gray-300 rounded-lg shadow-md py-1.5 px-4 
          bg-gray-200 hover:bg-gray-300 cursor-pointer focus:border-orange-400 
          focus:ring-orange-400"
        >
          <option selected value="United Kingdom">United Kingdom</option>
          <option value="United States">United States</option>
          <option value="Germany">Germany</option>
          <option value="France">France</option>
        </select>

        <div class="mt-4">
          <InputLabel class="-mb-1.5" value="First name" />
          <TextIput class="mt-1 block w-full py-1.5 px-4" required />
        </div>

        <div class="mt-3">
          <InputLabel class="-mb-1.5" value="Last name" />
          <TextIput class="mt-1 block w-full py-1.5 px-4" required />
        </div>

        <div class="mt-3">
          <InputLabel class="-mb-1.5" value="Address" />
          <TextIput
            class="mt-1 block w-full py-1.5 px-4 placeholder:text-sm"
            required
            placeholder="Address line 1"
          />

          <TextIput
            class="mt-1 block w-full py-1.5 px-4 placeholder:text-sm"
            required
            placeholder="Address line 2"
          />
        </div>

        <div class="mt-3">
          <div class="flex gap-2">
            <div class="w-full">
              <InputLabel class="-mb-1.5" value="City" />
              <TextIput
                class="mt-1 block w-full py-1.5 px-4 placeholder:text-sm"
                required
                placeholder="City"
              />
            </div>

            <div class="w-full">
              <InputLabel class="-mb-1.5" value="Postcode" />
              <TextIput
                class="mt-1 block w-full py-1.5 px-4 placeholder:text-sm"
                required
                placeholder="Postcode"
              />
            </div>
          </div>
        </div>

        <div class="mt-6">
          <button
            class="bg-yellow-400 w-1/2 px-3 font-bold text-[14px] rounded-lg shadow-sm cursor-pointer"
          >
            Add address
          </button>
        </div>
      </form>
    </div>
  </AuthenticateLayout>
</template>

<script setup>
import { toRefs } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";
import MapMarkerOutlineIcon from "vue-material-design-icons/MapMarkerOutline.vue";
import PlusIcon from "vue-material-design-icons/Plus.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextIput from "@/Components/TextInput.vue";
</script>

<style lang="scss" scoped></style>
