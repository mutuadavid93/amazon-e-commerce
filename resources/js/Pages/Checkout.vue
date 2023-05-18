<template>
  <Head title="Checkout" />

  <AuthenticateLayout>
  {{ intent }}
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
import { computed, toRefs, onMounted, ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticateLayout from "@/Layouts/AuthenticatedLayout.vue";

import { useCartStore } from "@/store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();

// NOTE: `cart` is state property from the store.
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  intent: Object,
  order: Object,
});
const { intent } = toRefs(props);

// NOTE: since cart is a reactive property, wrapping it in computed property means
// whenever cart changes, total will be updated.
const total = computed(() => {
  let sum = cart.value.reduce((acc, item) => {
    return acc + item.price;
  }, 0);
  return sum > 0 ? sum.toFixed(2) : 0;
});

const totalWithoutDot = () => {
  let num = String(total.value).split(".").join("");
  return Number(num);
};

let stripe = null;
let elements = null;
let card = null;
let form = null;
let isProcessing = ref(false);
const data = useForm({ payment_intent: null });

onMounted(() => {
  // HINT: Always use the public key on the frontend.
  // i.e. see -
  stripe = Stripe(
    "pk_test_51N94o9A4mZ3T3Xysv5QABJ0IKYCfpiuCK7M1SolTPy3TllZrVEumt6ahKJ4L7RgpwAdwsbxP8ZXgT0wlpLILqY3T002f8FRJj4"
  );

  elements = stripe.elements();
  let style = {
    base: {
      color: "#32325d",
      fontFamily: "Arial, sans-serif",
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#32325d",
      },
    },
    invalid: {
      fontFamily: "Arial, sans-serif",
      color: "#fa755a",
      iconColor: "#fa755a",
    },
  };

  card = elements.create("card", { style: style });
  // Stripe injects an iframe into the DOM
  card.mount("#card-element");

  card.on("change", function (event) {
    // Disable the Pay button if there are no card details in the Element
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error
      ? event.error.message
      : "";
  });

  form = document.getElementById("payment-form");
  form?.addEventListener("submit", function (event) {
    event.preventDefault();
    // Complete payment when the submit button is clicked
    payWithCard(stripe, card, intent.value.client_secret);
  });
}); // End of onMounted

// Calls stripe.confirmCardPayment
// If the card requires authentication Stripe shows a pop-up modal to
// prompt the user to enter authentication details without leaving your page.
const payWithCard = (stripe, card, clientSecret) => {
  loading(true);
  stripe
    .confirmCardPayment(clientSecret, {
      payment_method: {
        card: card,
      },
    })
    .then(function (result) {
      if (result.error) {
        // Show error to your customer
        showError(result.error.message);
      } else {
        // The payment succeeded!
        orderComplete(result.paymentIntent.id);
      }
    });
};

// Shows a success message when the payment is complete
const orderComplete = (paymentIntentId) => {
  data.payment_intent = paymentIntentId;
  data.put("/checkout");
};

let showError = (errorMsgText) => {
  loading(false);
  let errorMsg = document.querySelector("#card-error");
  errorMsg.textContent = errorMsgText;
  setTimeout(function () {
    errorMsg.textContent = "";
  }, 4000);
};

let loading = function (isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("button").disabled = true;
    isProcessing.value = true;
  } else {
    document.querySelector("button").disabled = false;
    isProcessing.value = false;
  }
};
</script>

<style>
/* see - https://stripe.com/docs/payments/card-element?lang=php */
#card-element {
  border-radius: 4px 4px 0 0;
  padding: 12px;
  border: 1px solid rgba(50, 50, 93, 0.1);
  height: 44px;
  width: 100%;
  background: white;
}

#payment-request-button {
  margin-bottom: 32px;
}
</style>
