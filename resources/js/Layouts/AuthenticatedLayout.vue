<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import MapMarkerOutlineIcon from "vue-material-design-icons/MapMarkerOutline.vue";
import MenuDownIcon from "vue-material-design-icons/MenuDown.vue";
import MagnifyIcon from "vue-material-design-icons/Magnify.vue";
import CartMinusIcon from "vue-material-design-icons/CartMinus.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div class="min-w-[1150px] bg-gray-100 h-full">
    <div
      class="flex items-center bg-gray-900 h-[60px] py-2 fixed z-50 min-w-[1150px] w-full"
    >
      <div class="flex">
        <!-- NOTE: Link component is from inertia -->
        <Link
          class="text-white h-50px p-2 pt-3 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
        >
          AMAZON
        </Link>
      </div>

      <div
        class="text-white h-50px p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
      >
        <div class="flex items-center justify-center">
          <MapMarkerOutlineIcon class="pt-2 -ml-1" fillColor="#F5F5F5" />

          <div>
            <div class="text-[13px] text-gray-300 font-extrabold">
              <div>Delivery to John Doe</div>
            </div>

            <div class="text-[15px] text-white-300 -mt-1.5 font-extrabold">
              <div>London SW2 SW2</div>
            </div>
          </div>
        </div>
      </div>

      <!-- grow translates to flex-grow: 1; allows the item to grow and take up any remaining space in the 
flex container after all other flex items have taken up their specified widths -->
      <div class="flex grow items-center h-[45px] px-1">
        <div
          class="flex items-center justify-center bg-gray-100 border-r border-r-gray-300 font-extrabold text-[11px] text-gray-600 w-[60px] h-[40px] rounded-l-md cursor-pointer"
        >
          <div class="pt-[3px]">All</div>

          <!-- TIP:  -mr-2: move the icon 8px to the right.

          focus:ring-0 removes the blue outline when the input is focused. 
          i.e. it's like the input is not focused 
           -->
          <MenuDownIcon fillColor="#5E5E5E" :size="20" class="-mr-2" />
        </div>

        <input
          type="text"
          class="block w-full border-none border-transparent focus:border-transparent focus:ring-0"
        />

        <!-- NOTE:  p-[5px] on below div adds h-[40px] to make h-[45px] -->
        <div class="cursor-pointer bg-orange-300 p-[5px] px-2 rounded-r-md">
          <MagnifyIcon :size="30" />
        </div>
      </div>

      <div class="flex">
        <div
          class="h-50px p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
        >
          <!-- justify-center: aligns the flex items along the horizontal axis at the center of the container. -->
          <div class="flex items-center justify-center mt-2.5 px-1">
            <img src="https://via.placeholder.com/35x20" alt="" />

            <!-- -mt-2 -mr-0.5: move the text upword to align with prev element and push it closer to the right -->
            <div class="text-[15px] text-white -mt-2 -mr-0.5 font-extrabold">EN</div>
            <MenuDownIcon fillColor="#C2C2C2" :size="20" class="-mt-1.5 pr-1 -mr-4" />
          </div>
        </div>

        <div
          class="h-50px p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
        >
          <div class="flex items-center justify-center">
            <div>
              <div class="text-[12px] text-white font-extrabold">
                Hello, <span>sign in</span>
              </div>
              <div class="flex items-center">
                <div class="text-[15px] text-white -mt-1.5 font-extrabold">
                  Account & List
                </div>
                <MenuDownIcon fillColor="#C2C2C2" :size="20" class="-mt-1 pr-1 -mr-4" />
              </div>
            </div>
          </div>
        </div>

        <div
          class="h-50px p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
        >
          <div class="flex items-center justify-center">
            <div>
              <div class="text-[12px] text-white font-extrabold">Returns</div>
              <div class="flex items-center">
                <div class="text-[15px] text-white -mt-1.5 font-extrabold">& Orders</div>
              </div>
            </div>
          </div>
        </div>

        <div
          class="relative h-50px p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100 cursor-pointer"
        >
          <!-- NOTE: div can also have span parent -->
          <span
            class="absolute text-center right-[21px] w-[14px] top-0 rounded-full text-[20px]"
          >
            <div class="text-orange-400 font-extrabold bg-gray-900 h-[16px]">0</div>
          </span>
          <div class="flex items-center justify-center">
            <CartMinusIcon fillColor="#FCFCFC" :size="40" class="-mt-0.5" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>