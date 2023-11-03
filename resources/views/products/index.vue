<template>
  <div class="p-4 sm:ml-64">
    <div class="p-4">
      <div class="flex justify-between items-center">
        <h1
          class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-center text-gray-900 md:text-5xl lg:text-4xl dark:text-white"
        >
          Products List
        </h1>
        <router-link :to="{ name: 'ProductCreate' }">
          <button
            type="button"
            class="px-3 py-2 text-xs font-medium text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800"
          >
            Create
          </button>
        </router-link>
      </div>

      <form>
        <div class="flex">
          <label
            for="search-dropdown"
            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
            >Your Email</label
          >
          <button
            id="dropdown-button"
            data-dropdown-toggle="dropdown"
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
            type="button"
						@click="showCategoryDropdown = true"
          >
            {{ searchCategory }}
            <svg
              class="w-2.5 h-2.5 ml-2.5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 10 6"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 4 4 4-4"
              />
            </svg>
          </button>
          <div
            id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
          >
            <ul
              class="py-2 text-sm text-gray-700 dark:text-gray-200"
              aria-labelledby="dropdown-button"
							v-show="showCategoryDropdown"
            >
              <li
								v-for="category in categories"
								:key="category.id"
							>
                <button
                  type="button"
                  class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
									:value="category.name"
									@click="handleCategoryFilter"
                >
                  {{ category.name }}
                </button>
              </li>
            </ul>
          </div>
          <div class="relative w-full">
            <input
              type="search"
              id="search-dropdown"
              class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
              placeholder="Search products..."
							v-model="searchProductKeyword"
            />
            <button
              type="button"
              class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
							@click="handleSearchProduct"
            >
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
              <span class="sr-only">Search</span>
            </button>
          </div>
        </div>
      </form>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-10">
        <table
          class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
          v-if="products.data"
        >
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">Category</th>
							<th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
							</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
							v-for="product in products.data"
							:key="product.id"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ product.id }}
              </th>
              <td class="px-6 py-4">{{ product.name }}</td>
              <td class="px-6 py-4">{{ product.description }}</td>
              <td class="px-6 py-4">{{ categories[product.category_id-1]?.name }}</td>
              <td class="px-6 py-4 text-right">
                <div class="flex gap-1">
                  <router-link
                    :to="{ path: `/products/edit/${product.id}`}"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                  >
                    Edit
                  </router-link>
                  <div @click="handleDeleteProduct(product.id)" class="font-medium cursor-pointer text-red-600 dark:text-red-500 hover:underline">Delete</div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="flex justify-center" v-else>
          <div class="px-6 py-4 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">No product found.</div>
        </div>
      </div>

      <nav class="flex flex-col items-center">
				<div class="text-sm text-gray-700 dark:text-gray-400">
						Showing page <span class="font-semibold text-gray-900 dark:text-white">{{ products.current_page }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ products.last_page }}</span> Entries 
				</div>
        <ul class="inline-flex -space-x-px text-sm mt-1">
          <li 
            v-for="(link, key) in products.links" 
            :key="key"
          >
            <button 
              :disabled="link.url === null ? true : false"
              :class="paginationStyle(link.active)"
              :aria-current="link.active ? `page` : ''"
              @click="handlePageTransition(link)"
            >{{ link.label.replaceAll('&amp;laquo;', '').replaceAll('&amp;raquo;', '') }}
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { onMounted, computed, ref } from "vue";
import store from "../../js/store";

onMounted(() => {
  store.dispatch("searchProduct", filters);
  store.dispatch("categories");
});

const searchCategory = ref('Categories');

const searchProductKeyword = ref('');

const showCategoryDropdown = ref(false);

const products = computed(() => store.state.products);

const categories = computed(() => store.state.categories);

const paginationStyle = (linkActive) => {
  return linkActive ? 'flex items-center justify-center px-3 h-8 ml-0 leading-tight text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' : 'flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
}

const filters = {
	category: '',
	search: '',
  link: '',
}

const handleCategoryFilter = (e) => {
	searchCategory.value = e.target.value;
	showCategoryDropdown.value = false;
	filters.category = e.target.value;

  store.dispatch("searchProduct", filters);
}

const handleSearchProduct = () => {
	filters.search = searchProductKeyword.value;
  store.dispatch("searchProduct", filters);
}

const handlePageTransition = (link) => {
  filters.link = link.url.replace('/?', '');
  store.dispatch("searchProduct", filters);
}

const handleDeleteProduct = (id) => {
  store.dispatch("deleteProduct", id);
}
</script>
