<template>
  <div class="h-screen flex justify-center items-center">
    <div class="w-screen">
      <h1
        class="mb-4 mx-auto text-2xl font-extrabold tracking-tight leading-none text-center text-gray-900 md:text-5xl lg:text-4xl dark:text-white"
      >
        Create Product
      </h1>

      <!-- Stepper -->
      <div class="mx-auto w-[25%]">
        <ol class="flex items-center w-full mb-5">
          <li
            class="flex w-full items-center text-blue-600 dark:text-blue-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block dark:after:border-blue-800"
          >
            <span
              class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 dark:bg-blue-800 shrink-0"
            >
              <svg
                class="w-3.5 h-3.5 text-blue-600 lg:w-4 lg:h-4 dark:text-blue-300"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 16 12"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M1 5.917 5.724 10.5 15 1.5"
                />
              </svg>
            </span>
          </li>
          <li
            :class="styleStep2Border"
          >
            <span
              :class="styleStep2Circle"
            >
              <svg
                :class="styleStep2Icon"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 16"
              >
                <path
                  d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"
                />
              </svg>
            </span>
          </li>
          <li class="flex items-center">
            <span
              :class="styleStep3Circle"
            >
              <svg
                :class="styleStep3Icon"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 18 20"
              >
                <path
                  d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"
                />
              </svg>
            </span>
          </li>
        </ol>
      </div>

      <div
        class="mx-auto max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
        v-show="currentStep === 1"
      >
        <div class="text-center text-sm font-medium text-red-500">
          {{ error }}
        </div>
        <div class="space-y-6">
          <div>
            <label
              for="name"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Name</label
            >
            <input
              type="text"
              name="name"
              id="name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
              placeholder="Enter product's name"
              required
              v-model="products.name"
            />
          </div>

          <label
            for="small"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Categories</label
          >
          <select
            v-model="products.category_id"
            id="small"
            class="block w-full !mt-1 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option 
              v-for="(category, key) in categories" 
              :value="category.id"
              :key="key"
            >
            {{ category.name }}
            </option>
          </select>

          <label
            for="message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Description</label
          >
          <textarea
            v-model="products.description"
            id="message"
            rows="4"
            class="block p-2.5 !mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Enter product's description..."
          ></textarea>

          <div class="flex justify-center">
            <button
              type="button"
              class="w-[50%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              @click="nextStep"
            >
              Next
            </button>
          </div>
        </div>
      </div>

      <div
        class="mx-auto max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
        v-show="currentStep === 2"
      >
        <div class="mb-2 text-center text-sm font-medium text-red-500">
          {{ error }}
        </div>
        <div class="space-y-6">
          <label
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="multiple_files"
            >Select product's images</label
          >
          <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files"
            type="file"
            multiple

            @change="event => products.images = event.target.files"
          />

          <div class="flex justify-between gap-5">
            <button
              type="button"
              class="w-[50%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              @click="previousStep"
            >
              Back
            </button>
            <button
              type="button"
              class="w-[50%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              @click="nextStep"
            >
              Next
            </button>
          </div>
        </div>
      </div>

      <div
        class="mx-auto max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
        v-show="currentStep === 3"
      >
        <div class="mb-2 text-center text-sm font-medium text-red-500">
          {{ error }}
        </div>
        <form class="space-y-6" @submit="handleProductSubmit" enctype="multipart/form-data">
          <label
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="multiple_files"
            >Select Date & Time</label
          >
          <VueCtkDateTimePicker
            v-model="products.date_time"
          ></VueCtkDateTimePicker>

          <div class="flex justify-between gap-5">
            <button
              type="button"
              class="w-[50%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              @click="previousStep"
            >
              Back
            </button>
            <button
              type="submit"
              class="w-[50%] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import store from "../../js/store";
import { ref, computed, reactive } from "vue";

import { useRouter } from "vue-router";

const router = useRouter();

import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";

const styleStep2Icon = computed(() => {
  return currentStep.value === 2 || currentStep.value === 3 ? 'w-3.5 h-3.5 text-blue-600 lg:w-4 lg:h-4 dark:text-blue-300' : 'w-4 h-4 text-gray-500 lg:w-5 lg:h-5 dark:text-gray-100';
});

const styleStep2Border = computed(() => {
  return currentStep.value === 2 || currentStep.value === 3
    ? `flex w-full items-center text-blue-600 dark:text-blue-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block dark:after:border-blue-800`
    : `flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700`
})

const styleStep2Circle = computed(() => {
  return currentStep.value === 2 || currentStep.value === 3
    ? 'flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 dark:bg-blue-800 shrink-0'
    : 'flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0'
})

const styleStep3Icon = computed(() => {
  return currentStep.value === 3 ? 'w-3.5 h-3.5 text-blue-600 lg:w-4 lg:h-4 dark:text-blue-300' : 'w-4 h-4 text-gray-500 lg:w-5 lg:h-5 dark:text-gray-100';
});

const styleStep3Circle = computed(() => {
  return currentStep.value === 3 
    ? 'flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 dark:bg-blue-800 shrink-0'
    : 'flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0'
})

const categories = [
  {
    id: 1,
    name: 'category 1',
  },
  {
    id: 2,
    name: 'category 2',
  },
  {
    id: 3,
    name: 'category 3',
  },
]

const error = ref('');

const products = reactive({
  name: "",
  category_id: 0,
  description: "",
  images: [],
  date_time: '',
});

const currentStep = ref(1);

const previousStep = () => {
  error.value = ''
  currentStep.value--
}

const nextStep = () => {
  if (currentStep.value === 1) {
    if (products.name == "" || products.category_id == 0 || products.description == "") {
      error.value = 'All fields are required.';
    } else {
      currentStep.value++
      error.value = '';
    }
  } else if (currentStep.value === 2) {
    if (!products.images.length) {
      error.value = 'Image field is required.';
    } else {
      currentStep.value++
      error.value = '';
    }
  }
}

const handleProductSubmit = (e) => {
  e.preventDefault();

  if (products.date_time == "") {
    error.value = 'Date Time field is required.';
  } else {
    currentStep.value++
    error.value = '';

    store.dispatch('createProduct', products);

    router.push('/');
  }
}
</script>