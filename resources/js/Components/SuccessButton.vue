<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center py-1 px-2 bg-green-500 border  rounded-md font-semibold text-sm text-white hover:bg-green-60 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
