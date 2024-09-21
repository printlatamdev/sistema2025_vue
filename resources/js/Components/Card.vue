<template>
    <div class="flex justify-between items-center p-5 cursor-pointer bg-white border border-gray-200 rounded-lg hover:bg-gray-100">
        <div class="">
            <h5 class="text-4xl font-bold tracking-tight text-gray-900">
                <slot name="title" />
            </h5>
            <p class="font-normal text-gray-700 text-sm">
                <slot name="description" />    
            </p>
        </div>
        <div>
            <slot name="icon" />
        </div>
    </div>
</template>
