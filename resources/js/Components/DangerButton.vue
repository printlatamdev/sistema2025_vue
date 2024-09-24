<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center justify-center py-1 px-2 bg-red-600 border border-transparent rounded-md font-semibold text-md text-white  hover:bg-red-500 active:bg-red-700 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
