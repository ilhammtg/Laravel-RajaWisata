<template>
  <div class="min-h-screen bg-white font-sans flex flex-col pb-20 lg:pb-0">
    <!-- Main Top Navbar (Global) -->
    <Navbar />

    <!-- Unique Immersive Header -->
    <header class="relative pt-32 pb-24 px-4 sm:px-8 overflow-hidden bg-gray-900 text-white">
      <!-- Animated Background Elements -->
      <div class="absolute inset-0 z-0">
         <div class="absolute -right-20 -top-20 w-[600px] h-[600px] bg-pala/20 rounded-full blur-[120px] animate-pulse"></div>
         <div class="absolute -left-20 bottom-0 w-[400px] h-[400px] bg-indigo-500/10 rounded-full blur-[100px]"></div>
         <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
      </div>

      <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center md:items-end justify-between gap-8">
         <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
            <!-- Profile Frame -->
            <div class="relative group">
               <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-[2.5rem] bg-gradient-to-br from-pala to-indigo-600 p-1 shadow-2xl shadow-pala/30 overflow-hidden transform group-hover:rotate-3 transition-transform duration-500">
                  <div class="w-full h-full bg-white rounded-[2.3rem] flex items-center justify-center text-5xl font-black text-pala overflow-hidden">
                     <img v-if="$page.props.auth.user.avatar_url" :src="$page.props.auth.user.avatar_url" class="w-full h-full object-cover" />
                     <div v-else>{{ $page.props.auth.user.name.charAt(0) }}</div>
                  </div>
               </div>
               <div class="absolute -bottom-2 -right-2 bg-emerald-500 p-3 rounded-2xl border-4 border-gray-900 shadow-lg">
                  <div class="w-3 h-3 bg-white rounded-full animate-ping"></div>
               </div>
            </div>

            <div class="space-y-2">
               <div class="flex items-center gap-3 justify-center md:justify-start">
                  <span class="px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest border border-white/10">ID Wisatawan #{{ $page.props.auth.user.id.toString().padStart(4, '0') }}</span>
                  <span class="flex items-center gap-1.5 text-[10px] font-bold text-gray-400">
                     <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span> Online Sekarang
                  </span>
               </div>
               <h1 class="text-4xl lg:text-6xl font-black tracking-tight leading-none italic">{{ $page.props.auth.user.name }}</h1>
               <div class="flex items-center gap-4 text-sm text-gray-400 font-medium justify-center md:justify-start">
                  <span class="flex items-center gap-1">📍 Aceh Selatan Explorer</span>
                  <span class="opacity-20">|</span>
                  <span class="flex items-center gap-1">✨ Member Sejak {{ new Date($page.props.auth.user.created_at).getFullYear() }}</span>
               </div>
            </div>
         </div>

         <!-- Header Statistics -->
         <div class="flex items-center gap-4 sm:gap-6">
            <div class="text-center bg-white/5 backdrop-blur-xl border border-white/10 p-5 rounded-[2rem] min-w-[100px] hover:bg-white/10 transition-colors">
               <span class="block text-2xl font-black text-white italic mb-1">{{ stats.favorites || 0 }}</span>
               <span class="block text-[9px] font-black uppercase tracking-widest text-gray-400">Wishlist</span>
            </div>
            <div class="text-center bg-white/5 backdrop-blur-xl border border-white/10 p-5 rounded-[2rem] min-w-[100px] hover:bg-white/10 transition-colors">
               <span class="block text-2xl font-black text-white italic mb-1">{{ stats.reviews || 0 }}</span>
               <span class="block text-[9px] font-black uppercase tracking-widest text-gray-400">Ulasan</span>
            </div>
            
            <!-- Desktop Profile Settings -->
            <Link :href="route('profile.edit')" class="hidden lg:flex flex-col items-center justify-center bg-white/10 hover:bg-white/20 border border-white/10 p-5 rounded-[2rem] min-w-[100px] transition-all group">
               <svg class="w-6 h-6 text-white group-hover:text-pala mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
               <span class="text-[9px] font-black uppercase tracking-widest text-white">Profil</span>
            </Link>

            <!-- Desktop Logout -->
            <button @click="logout" class="hidden lg:flex flex-col items-center justify-center bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 p-5 rounded-[2rem] min-w-[100px] transition-all group">
               <svg class="w-6 h-6 text-red-400 group-hover:text-red-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
               <span class="text-[9px] font-black uppercase tracking-widest text-red-500">Keluar</span>
            </button>
         </div>
      </div>
    </header>

    <!-- Content Section -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-8 py-12">
       <div class="bg-white">
          <slot />
       </div>
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <nav class="fixed bottom-6 left-6 right-6 z-50 lg:hidden">
       <div class="bg-gray-900/90 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-3 shadow-2xl shadow-black/20 flex items-center justify-around">
          <Link 
             v-for="item in menuItems" :key="item.name"
             :href="item.href"
             class="flex flex-col items-center gap-1 px-4 py-2 rounded-2xl transition-all"
             :class="isActive(item.pattern) ? 'text-pala bg-white/5' : 'text-gray-400 hover:text-white'"
          >
             <div v-html="item.icon" class="w-6 h-6"></div>
             <span class="text-[8px] font-black uppercase tracking-widest">{{ item.shortName }}</span>
          </Link>
          <button @click="logout" class="flex flex-col items-center gap-1 px-4 py-2 text-red-400 hover:text-red-300">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
             <span class="text-[8px] font-black uppercase tracking-widest text-red-500">Keluar</span>
          </button>
       </div>
    </nav>
    
    <footer class="hidden lg:block py-12 bg-gray-50 border-t border-gray-100 mt-20">
       <div class="max-w-7xl mx-auto px-8 text-center space-y-4">
          <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">© {{ new Date().getFullYear() }} Raja Wisata Aceh Selatan • Traveler Profile Experience</p>
       </div>
    </footer>

    <!-- Global UI Components -->
    <Toast />
    <ConfirmModal ref="confirmModal" />
  </div>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Toast from '../components/Global/Toast.vue';
import ConfirmModal from '../components/Global/ConfirmModal.vue';
import { computed, ref, provide } from 'vue';

const confirmModal = ref(null);
provide('confirm', (options) => confirmModal.value.open(options));

const props = defineProps({
   stats: {
      type: Object,
      default: () => ({ favorites: 0, reviews: 0 })
   }
});

const page = usePage();

const menuItems = [
   { 
      name: 'Beranda Profil', 
      shortName: 'Home',
      href: route('user.dashboard'), 
      pattern: 'user.dashboard',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>'
   },
   { 
      name: 'Explore', 
      shortName: 'Explore',
      href: '/', 
      pattern: 'home',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
   },
   { 
      name: 'Profil Saya', 
      shortName: 'Profil',
      href: route('profile.edit'), 
      pattern: 'profile.edit',
      icon: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>'
   }
];

const isActive = (pattern) => {
   return route().current() === pattern;
};

const logout = () => {
   router.post(route('logout'));
};
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
