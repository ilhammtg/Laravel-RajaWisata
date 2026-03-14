<template>
  <Teleport to="body">
    <TransitionGroup 
      tag="div" 
      class="fixed top-8 right-8 z-[100] space-y-4 pointer-events-none"
      enter-active-class="transition duration-500 ease-out"
      enter-from-class="translate-x-full opacity-0 scale-90"
      enter-to-class="translate-x-0 opacity-100 scale-100"
      leave-active-class="transition duration-300 ease-in"
      leave-from-class="translate-x-0 opacity-100 scale-100"
      leave-to-class="translate-x-full opacity-0 scale-90"
      move-class="transition duration-500 ease-in-out"
    >
      <div v-for="toast in toasts" :key="toast.id" 
        class="pointer-events-auto bg-gray-900 text-white rounded-[2rem] p-6 shadow-2xl border border-white/10 min-w-[320px] max-w-md flex items-start gap-5 group transform hover:scale-[1.02] transition-transform duration-300"
      >
        <!-- Icon Based on Type -->
        <div :class="[
          'flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg',
          toast.type === 'success' ? 'bg-emerald-500/20 text-emerald-400' :
          toast.type === 'error' ? 'bg-red-500/20 text-red-400' :
          toast.type === 'warning' ? 'bg-amber-500/20 text-amber-400' : 'bg-blue-500/20 text-blue-400'
        ]">
          <svg v-if="toast.type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
          <svg v-else-if="toast.type === 'error'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
          <svg v-else-if="toast.type === 'warning'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>

        <div class="flex-grow pt-1">
          <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-40 mb-1">
            {{ toast.type === 'success' ? 'Sukses' : toast.type === 'error' ? 'Masalah' : 'Informasi' }}
          </p>
          <p class="text-sm font-bold leading-tight tracking-tight">{{ toast.message }}</p>
        </div>

        <button @click="remove(toast.id)" class="text-gray-600 hover:text-white transition-colors p-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
    </TransitionGroup>
  </Teleport>
</template>

<script setup>
import { ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';

const toasts = ref([]);
const page = usePage();

const remove = (id) => {
  toasts.value = toasts.value.filter(t => t.id !== id);
};

const add = (message, type = 'success') => {
  if (!message) return;
  
  const id = Date.now();
  toasts.value.push({ id, message, type });
  
  setTimeout(() => {
    remove(id);
  }, 5000);
};

// Hubungkan dengan Inertia Flash Messages
watch(() => page.props.flash, (flash) => {
  if (flash.success) add(flash.success, 'success');
  if (flash.error) add(flash.error, 'error');
  if (flash.warning) add(flash.warning, 'warning');
  if (flash.info) add(flash.info, 'info');
  if (flash.message) add(flash.message, 'success');
}, { deep: true, immediate: true });

// Expose add method for manual usage
defineExpose({ add });
</script>
