<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center p-2 bg-white border border-gray-300 rounded-r-md font-semibold text-xs text-gray-700 hover:bg-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
