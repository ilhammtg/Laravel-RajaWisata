<template>
  <Teleport to="body">
    <Transition 
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-if="show" class="fixed inset-0 z-[110] flex items-center justify-center px-4 overflow-hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-md" @click="close"></div>
        
        <!-- Modal -->
        <div class="relative bg-white rounded-[3rem] shadow-2xl p-8 lg:p-12 w-full max-w-lg overflow-hidden border border-gray-100 animate-in zoom-in-95 duration-300">
           <!-- Decor -->
           <div class="absolute -right-16 -top-16 w-48 h-48 bg-gray-50 rounded-full blur-3xl opacity-50"></div>
           
           <div class="relative z-10 text-center space-y-8">
              <!-- Header Icon -->
              <div class="w-24 h-24 mx-auto rounded-[2rem] bg-gray-900 flex items-center justify-center text-white shadow-xl shadow-black/10">
                 <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
              </div>

              <div>
                 <h3 class="text-3xl font-black text-gray-900 italic mb-2 tracking-tight">{{ title || 'Konfirmasi Tindakan' }}</h3>
                 <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">{{ message || 'Apakah Anda yakin ingin melakukan tindakan ini?' }}</p>
              </div>

              <div class="flex flex-col sm:flex-row gap-4 pt-4">
                 <button @click="confirm" class="flex-grow py-5 bg-red-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 transition-all shadow-xl shadow-red-500/20">
                    {{ confirmText || 'Ya, Lanjutkan' }}
                 </button>
                 <button @click="close" class="flex-grow py-5 bg-gray-100 text-gray-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">
                    {{ cancelText || 'Batalkan' }}
                 </button>
              </div>
           </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref } from 'vue';

const show = ref(false);
const title = ref('');
const message = ref('');
const confirmText = ref('');
const cancelText = ref('');
let resolveCallback = null;

const open = (options = {}) => {
  title.value = options.title || '';
  message.value = options.message || '';
  confirmText.value = options.confirmText || '';
  cancelText.value = options.cancelText || '';
  show.value = true;
  
  return new Promise((resolve) => {
    resolveCallback = resolve;
  });
};

const close = () => {
  show.value = false;
  if (resolveCallback) resolveCallback(false);
};

const confirm = () => {
  show.value = false;
  if (resolveCallback) resolveCallback(true);
};

defineExpose({ open });
</script>
