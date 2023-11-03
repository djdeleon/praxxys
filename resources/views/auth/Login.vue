<template>
    <div class="h-screen flex justify-center items-center">
        <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in to {{ appName }}
            </h2>

            <p v-show="errorResponse" class="text-red-500 font-semibold text-sm text-center !-mb-5 !mt-4">{{ errorResponse }}</p>

            <form class="mt-8 space-y-6" @submit.prevent="login()">
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input 
                        type="text" 
                        name="login" 
                        id="username" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Enter username" 
                        required
                        v-model="user.login"
                    >
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter password" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        required
                        v-model="user.password"
                    >
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                id="remember" 
                                aria-describedby="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" 
                                v-model="user.remember"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-500 dark:text-gray-400">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import router from '../../js/router';
import store from '../../js/store';

import { ref, reactive } from 'vue';

const appName = import.meta.env.VITE_APP_NAME;

const user = reactive({
    login: '',
    password: '',
    remember: false,
});

const errorResponse = ref('');

const login = () => {
    store.dispatch('login', user)
    .then(() => {
        router.push('/');
    }).catch(error => {
        errorResponse.value = error.response.data.error;
    });
}
</script>