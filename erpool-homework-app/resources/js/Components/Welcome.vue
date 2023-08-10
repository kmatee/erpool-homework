<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <!-- <div v-if="$page.props.user.roles.includes('admin')">
                Admin only page
            </div> -->
        </div>
        <div class="mt-4">
            {{ $page.props }}
        </div>
    </div>

        
</template>
