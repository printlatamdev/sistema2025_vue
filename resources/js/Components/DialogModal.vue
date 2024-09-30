<script setup>
import Modal from './Modal.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="">
            <div class="text-lg font-medium text-gray-900 px-3 p-2">
                <slot name="title" />
            </div>
            <hr>

            <div class="text-sm text-gray-600 px-5 py-3">
                <slot name="content" />
            </div>
        </div>

        <!--<div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
            <slot name="footer" />
        </div>-->
    </Modal>
</template>
