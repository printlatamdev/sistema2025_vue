<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="items-center justify-center p-2 text-xs uppercase bg-red-600 border border-transparent rounded-md font-semibold text-white  hover:bg-red-500 active:bg-red-700 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
