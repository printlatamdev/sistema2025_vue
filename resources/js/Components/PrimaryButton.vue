<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="items-center py-1 px-2 bg-gray-800 border border-transparent rounded-md font-semibold text-md text-white  hover:bg-gray-700  active:bg-gray-900 disabled:opacity-50 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
