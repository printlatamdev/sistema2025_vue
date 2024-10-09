<script setup>
import Modal from './Modal.vue';
import ActionMessage from '@/Components/ActionMessage.vue';

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
           <div class="flex justify-between items-center bg-blue-50 px-3 p-2">
                <div class="text-lg font-medium text-gray-900">
                    <slot name="title" />
                </div>
                <div class="cursor-pointer" @click="close">
                    <font-awesome-icon :icon="['fas', 'rectangle-xmark']" class="text-xl text-gray-600"/>
                </div>
           </div>
           <div class="">
                <slot name="alert" />
            </div>
            <div class="text-sm text-gray-600 p-7">
                <slot name="content" />
            </div>
        </div>
        <!--<div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
            <slot name="footer" />
        </div>-->
    </Modal>
</template>
