<script setup>
import Card from '@/Components/Card.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
  <AppLayout title="Dashboard">
    <div class="w-full">
      <div class="grid grid-cols-5 gap-4">
        <Card>
          <template #title>25</template>
          <template #description>
            Registros de clientes
          </template>
          <template #icon>
            <div class="bg-green-200 px-2 py-1 rounded-md">
              <font-awesome-icon :icon="['fas', 'bolt']" class="" />
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AppLayout>
</template>
