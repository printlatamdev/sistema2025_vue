<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'block border-l-4 items-center mt-1 bg-gray-700 hover:bg-gray-600 p-1 text-xs font-medium transition text-white duration-150 ease-in-out'
        : 'block items-center mt-1 p-1 text-xs hover:bg-gray-700 font-medium text-white transition duration-150 ease-in-out';
    });
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
