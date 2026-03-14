<template>
  <div class="min-h-screen bg-gray-900 flex items-center justify-center px-4 overflow-hidden relative font-sans">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-0">
       <div class="absolute -right-20 -top-20 w-[600px] h-[600px] bg-pala/20 rounded-full blur-[120px] animate-pulse"></div>
       <div class="absolute -left-20 bottom-0 w-[400px] h-[400px] bg-indigo-500/10 rounded-full blur-[100px]"></div>
       <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    </div>

    <div class="relative z-10 text-center space-y-12 max-w-2xl transform transition-all duration-1000">
      <!-- Error Icon Container -->
      <div class="relative inline-block group">
        <div class="absolute inset-0 bg-gradient-to-br from-pala to-indigo-600 rounded-[3rem] blur-2xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
        <div class="relative bg-black/40 backdrop-blur-3xl border border-white/10 rounded-[4rem] p-12 lg:p-16 shadow-2xl">
           <div class="text-[120px] lg:text-[180px] font-black leading-none mb-4 italic bg-clip-text text-transparent bg-gradient-to-b from-white to-white/40 tracking-tighter">
             {{ status }}
           </div>
           <div class="h-2 w-24 bg-pala mx-auto rounded-full mb-8"></div>
           <h1 class="text-3xl lg:text-4xl font-black text-white italic tracking-tight">{{ title }}</h1>
        </div>
      </div>

      <div class="space-y-8">
        <p class="text-xl text-gray-400 font-medium leading-relaxed italic max-w-md mx-auto">
          {{ description }}
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
           <Link href="/" class="px-10 py-5 bg-white text-gray-900 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] transform hover:scale-105 hover:rotate-2 transition-all shadow-xl shadow-black/20">
              Kembali ke Beranda
           </Link>
           <button @click="back" class="px-10 py-5 bg-white/5 backdrop-blur-md border border-white/10 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-white/10 transition-all">
              Halaman Sebelumnya
           </button>
        </div>
      </div>

      <!-- Footer Help -->
      <div class="pt-12">
         <p class="text-[10px] font-black text-gray-500 uppercase tracking-[0.4em] mb-4">Butuh Bantuan?</p>
         <div class="flex items-center justify-center gap-6 text-gray-400">
            <a href="#" class="hover:text-pala transition-colors">Instagram</a>
            <span class="opacity-10">/</span>
            <a href="#" class="hover:text-pala transition-colors">WhatsApp</a>
            <span class="opacity-10">/</span>
            <a href="#" class="hover:text-pala transition-colors">Email</a>
         </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  status: Number,
});

const title = computed(() => {
  return {
    503: 'Layanan Terhenti Sejenak',
    500: 'Gangguan Pada Server',
    404: 'Jejak Tidak Ditemukan',
    403: 'Akses Dibatasi',
  }[props.status];
});

const description = computed(() => {
  return {
    503: 'Mohon maaf, kami sedang melakukan pemeliharaan rutin. Silakan kembali beberapa saat lagi untuk melanjutkan perjalanan Anda.',
    500: 'Sepertinya ada gangguan teknis pada sistem kami. Tim kami sedang berusaha memperbaikinya secepat mungkin.',
    404: 'Halaman yang Anda cari sudah berpindah atau tidak pernah ada. Mari kita kembali ke jalur yang benar.',
    403: 'Sepertinya Anda tidak memiliki izin untuk menjelajahi area ini. Silakan hubungi administrator jika ini adalah kesalahan.',
  }[props.status];
});

const back = () => {
  window.history.back();
};
</script>
