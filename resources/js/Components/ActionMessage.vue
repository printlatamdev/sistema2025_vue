<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-show="on" class="text-md text-white bg-green-500 w-full rounded-md m-2 p-1">
                <slot />
            </div>
        </transition>
    </div>
</template>
