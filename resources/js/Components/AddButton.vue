<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center py-1 px-2 bg-white border border-gray-300 rounded-r-md font-semibold text-md text-gray-700 hover:bg-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
