<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'block w-full p-2 border-l-4 border-gray-400 text-start text-sm font-medium text-white bg-gray-600 transition duration-150 ease-in-out'
        : 'block w-full p-1 border-l-4 border-transparent text-start text-sm font-medium text-white hover:text-gray-800 hover:bg-gray-500 hover:border-gray-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" :class="classes" class="w-full text-start">
            <slot />
        </button>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
