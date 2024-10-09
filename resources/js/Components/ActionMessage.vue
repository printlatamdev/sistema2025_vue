<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="on" class="text-sm text-green-700 bg-green-200 w-full py-2 px-3 border-t-4 border-green-300">
                <slot />
            </div>
        </transition>
    </div>
</template>
