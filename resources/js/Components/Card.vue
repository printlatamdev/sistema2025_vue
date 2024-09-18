<template>
    <div class="flex justify-between p-5 bg-white border border-gray-200 rounded-lg">
        <div class="">
            <h5 class="text-4xl font-bold tracking-tight text-gray-900">
                <slot name="title" />
            </h5>
            <p class="font-normal text-gray-600 text-sm">
                <slot name="description" />    
            </p>
        </div>
        <div>
            <slot name="icon" />
        </div>
    </div>
</template>
