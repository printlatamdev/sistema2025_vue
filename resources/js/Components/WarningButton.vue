<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="items-center p-2 text-xs uppercase bg-yellow-300 rounded-md font-semibold text-gray-800 hover:bg-yellow-400 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
