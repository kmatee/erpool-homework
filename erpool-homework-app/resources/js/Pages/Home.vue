<script setup>
import { ref, defineEmits, defineProps, reactive } from 'vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
//import { ZiggyVue } from 'ziggy-vue';
import route from '@/../../vendor/tightenco/ziggy/src/js/index';



defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    categories: Array,
    products: Array,
});


const showingNavigationDropdown = ref(false);

/* const form = useForm({
                product_id: null,
            }); */

/* const submit = () => {
    form.post(route('cart.add'))
}; */


</script>

<script>

    export default {
        data() {
            return {
                form: {
                    product_id: null,
                    product_name: '',
                    product_price: 0,
                }
            }
        },
        methods: {
            submit(productId, productName, productPrice) {
                this.form.product_id = productId;
                this.form.product_name = productName;
                this.form.product_price = productPrice;

                console.log("Form before post:", this.form);
                this.$inertia.post('/cart', this.form);
            }
        },
    };
</script>

<template>
    <Head title="Home page" />
    <Banner/>
    <div v-if="canLogin" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-500 dark:hover:text-blue hidden sm:block">
        Dashboard</Link>

        <template v-else>
            <Link :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-500 dark:hover:text-grey-800">
            Log in</Link>

            <Link v-if="canRegister" :href="route('register')"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-500 dark:hover:text-grey-800">
            Register</Link>
        </template>
    </div>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('home')">
                        <ApplicationMark class="block h-9 w-auto" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('home')" :active="route().current('home')">
                            Home
                        </NavLink>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :href="route('cart.index')" :active="route().current('cart.index')">
                            Shopping Cart
                        </NavLink>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        @click="showingNavigationDropdown = !showingNavigationDropdown">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path
                                :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Home
                </ResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Shopping Cart
                </ResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </ResponsiveNavLink>
            </div>


            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div v-if="$page.props.auth.user" class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name">
                    </div>

                    <div>
                        <div v-if="$page.props.auth.user" class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div v-if="$page.props.auth.user" class="font-medium text-sm text-gray-500">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                </div>
                <template v-if="$page.props.auth.user">
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                            Profile
                        </ResponsiveNavLink>

                        <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')"
                            :active="route().current('api-tokens.index')">
                            API Tokens
                        </ResponsiveNavLink>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <ResponsiveNavLink as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </form>
                    </div>
                </template>
            </div>
        </div>
    </nav>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            <div v-for="prod in $page.props.products" :key="prod.id" class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
              <img class="w-full h-48" :src="prod.image_url"
                alt="Image" />
              <div class="px-6 py-4">
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-gray-700 uppercase">{{ prod.name }}</h4>
                <p class="leading-normal text-gray-700">{{ $page.props.categories.find(cat => cat.id === prod.category_id).name }}</p>
              </div>
              <div class="flex items-center justify-between p-4">
                <span class="text-xl text-gray-700">{{ prod.price }} Ft</span>
              </div>
              <form @submit.prevent="submit(prod.id, prod.name, prod.price)">
                <input type="hidden" name="product_id" v-model="form.product_id"/>
                <input type="hidden" name="product_name" v-model="form.product_name"/>
                <input type="hidden" name="product_price" v-model="form.product_price"/>
                <button type="submit" class="bg-white p-2 rounded-full relative">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve"
                        class="w-5 h-5 absolute bottom-2 left-2 bg-white hover:bg-green-200 rounded-full">
                        <defs>
                        </defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                            <path d="M 72.975 58.994 H 31.855 c -1.539 0 -2.897 -1.005 -3.347 -2.477 L 15.199 13.006 H 3.5 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 h 14.289 c 1.539 0 2.897 1.005 3.347 2.476 l 13.309 43.512 h 36.204 l 10.585 -25.191 h -6.021 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 H 86.5 c 1.172 0 2.267 0.587 2.915 1.563 s 0.766 2.212 0.312 3.293 L 76.201 56.85 C 75.655 58.149 74.384 58.994 72.975 58.994 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <circle cx="28.88" cy="74.33" r="6.16" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                            <circle cx="74.59" cy="74.33" r="6.16" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
                            <path d="M 62.278 19.546 H 52.237 V 9.506 c 0 -1.933 -1.567 -3.5 -3.5 -3.5 s -3.5 1.567 -3.5 3.5 v 10.04 h -10.04 c -1.933 0 -3.5 1.567 -3.5 3.5 s 1.567 3.5 3.5 3.5 h 10.04 v 10.04 c 0 1.933 1.567 3.5 3.5 3.5 s 3.5 -1.567 3.5 -3.5 v -10.04 h 10.041 c 1.933 0 3.5 -1.567 3.5 -3.5 S 64.211 19.546 62.278 19.546 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg>
                </button>
              </form>
            </div>
        </div>
      </div>
</template>