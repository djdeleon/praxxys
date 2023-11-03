<template>
  <div class="h-screen flex justify-center items-center">
    <div class="w-screen">
      <h1
        class="mb-4 mx-auto text-2xl font-extrabold tracking-tight leading-none text-center text-gray-900 md:text-5xl lg:text-4xl dark:text-white"
      >
        Edit Product
      </h1>

      <div
        class="mx-auto max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
      >
        <form class="space-y-6" @submit="handleProductSubmit" enctype="multipart/form-data">
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
              v-model="product.name"
            />
          </div>

          <label
            for="small"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Categories</label
          >
          <select
            v-model="product.category_id"
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
            for="description"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Description</label
          >
          <textarea
            v-model="product.description"
            id="description"
            rows="4"
            class="block p-2.5 !mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Enter product's description..."
          ></textarea>

          <div class="flex justify-center">
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
import { computed, onMounted } from "vue";

import { useRouter } from "vue-router";

const router = useRouter();

onMounted(() => {
  store.dispatch('product', useRouter().currentRoute.value.params.id);
  store.dispatch("categories");
})

const product = computed(() => store.state.product);

const categories = computed(() => store.state.categories);

const handleProductSubmit = (e) => {
  e.preventDefault();

  const payload = {
    id: product.value.id,
    name: product.value.name,
    description: product.value.description,
    category_id: product.value.category_id,
  }
  store.dispatch('editProduct', payload);

  router.push('/');
}
</script>