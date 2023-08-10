<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Basic info about users and products
            </h2>
        </template>

        <div class="py-12">
            <!--Products table-->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg">
                <h3 class="font-semibold text-gray-800 leading-tight py-5">
                    Products
                </h3>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-100">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-400 dark:text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="prod in products" :key="prod.id" class="bg-white border-b dark:bg-gray-500 dark:border-gray-700">
                            <td class="px-6 py-4">{{ prod.name }}</td>
                            <td class="px-6 py-4">{{ prod.price }}</td>
                            <td class="px-6 py-4">{{ prod.category_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--Users table-->
            <div v-if="$page.props.user.roles.includes('admin')" class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg">
                <h3 class="font-semibold text-gray-800 leading-tight pt-16 pb-5">
                    Users
                </h3>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-100">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-400 dark:text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-500 dark:border-gray-700">
                            <td class="px-6 py-4">{{ user.name }}</td>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">{{moment(user.created_at).format('YYYY-MM-DD - h:m')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import moment from 'moment';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
export default {
    data() {
        return {
            moment: moment
        }
    },
    props: ['products', 'categories', 'users'],
    components: {
        AppLayout
    },
}
</script>