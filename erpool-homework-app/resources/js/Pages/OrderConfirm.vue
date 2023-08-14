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
</script>


<script>
import AppLayout from '@/Layouts/AppLayout.vue';

    export default {
    components: { AppLayout },
}
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
      <body class="bg-gray-100">
        <div class="container mx-auto mt-10">
          <div class="flex shadow-md my-10">
            <div class="relative w-full bg-white px-10 py-10">
              <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Subtotal</h3>
              </div>
              <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" v-for="prod in $page.props.final_items">
                <div class="flex w-2/5"> <!-- product -->
                  <div class="w-20">
                    <img class="h-24" :src="prod.attributes.image" alt="image">
                  </div>
                  <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="font-bold text-sm">{{ prod.name }}</span>
                    <span class="font-bold text-sm">Qty: {{ prod.quantity }}</span>
                  </div>
                </div>
                <span class="text-center w-1/5 font-semibold text-sm">{{ prod.price }} Ft</span>
                <span v-if="prod.quantity >= 3 && prod.quantity < 5" class="text-center w-1/5 font-semibold text-sm">{{ (prod.price * prod.quantity) * 0.9}} Ft - (10% discount)</span>
                <span v-else-if="prod.quantity >= 5" class="text-center w-1/5 font-semibold text-sm">{{ (prod.price * prod.quantity) * 0.85}} Ft - (15% discount)</span>
                <span v-else class="text-center w-1/5 font-semibold text-sm">{{ prod.price * prod.quantity}} Ft</span>

              </div>
      
              <Link :href="route('cart.index')" class="flex font-semibold text-indigo-600 text-sm mt-10">
            
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                Back to Cart
              </Link>
              <span class="font-semibold uppercase absolute bottom-0 left-0"> Total: {{ $page.props.final_total }} Ft</span>
              
              <Link :href="route('thank')">
                <button class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase absolute bottom-0 right-0 w-1/5">Order</button>
              </Link>
            </div>
          </div>
        </div>
      </body>
</template>

