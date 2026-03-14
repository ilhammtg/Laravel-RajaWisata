<template>
  <div class="min-h-screen bg-gray-50 flex overflow-hidden">
    <!-- Sidebar -->
    <AdminSidebar 
      :isOpen="isSidebarOpen" 
      @close="isSidebarOpen = false" 
    />

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
      <!-- Header -->
      <AdminHeader 
        :title="pageTitle" 
        @toggle-sidebar="isSidebarOpen = true" 
      />

      <!-- Main Content -->
      <main class="flex-1 overflow-y-auto focus:outline-none custom-scrollbar p-4 sm:p-6 lg:p-10">
        <div class="max-w-7xl mx-auto">
          <slot />
        </div>
      </main>

      <!-- Global UI Components -->
      <Toast />
      <ConfirmModal ref="confirmModal" />
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div 
      v-if="isSidebarOpen" 
      @click="isSidebarOpen = false"
      class="fixed inset-0 z-30 bg-gray-900/50 backdrop-blur-sm lg:hidden transition-opacity duration-300"
    ></div>
  </div>
</template>

<script setup>
import { ref, computed, provide } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminSidebar from '@/components/Admin/Sidebar.vue';
import AdminHeader from '@/components/Admin/Header.vue';
import Toast from '@/components/Global/Toast.vue';
import ConfirmModal from '@/components/Global/ConfirmModal.vue';

const isSidebarOpen = ref(false);
const confirmModal = ref(null);

// Provide confirm dialog to children
provide('confirm', (options) => confirmModal.value.open(options));

const page = usePage();

const pageTitle = computed(() => {
  try {
    if (typeof route === 'undefined') return 'Panel Admin';
    if (route().current('admin.dashboard')) return 'Dashboard';
    if (route().current('admin.destinations.*')) return 'Manajemen Destinasi';
    if (route().current('admin.hotels.*')) return 'Manajemen Penginapan';
    if (route().current('admin.culinaries.*')) return 'Manajemen Kuliner';
    if (route().current('admin.events.*')) return 'Manajemen Event';
    if (route().current('admin.settings.*')) return 'Pengaturan Sistem';
  } catch (e) {
    console.warn('Navigation title error:', e);
  }
  return 'Panel Admin';
});
</script>

<style>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e5e7eb;
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #d1d5db;
}
</style>
