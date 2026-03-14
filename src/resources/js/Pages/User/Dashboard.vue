<template>
  <TravelerProfileLayout :stats="{ favorites: favorites.length, reviews: reviews.length }">
    <Head title="Traveler Profile" />

    <div class="space-y-16">
       <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-4">
          <!-- Custom Tab Navigation -->
          <div class="flex items-center gap-2 p-1.5 bg-gray-50 rounded-[2.5rem] w-fit mx-auto lg:mx-0 border border-gray-100 shadow-inner">
             <button 
                v-for="tab in tabs" :key="tab.id"
                @click="activeTab = tab.id"
                class="px-8 py-3.5 rounded-[2.2rem] text-[11px] font-black uppercase tracking-[0.2em] transition-all duration-300"
                :class="activeTab === tab.id ? 'bg-white text-pala shadow-xl shadow-pala/10 border border-gray-100 scale-105' : 'text-gray-400 hover:text-gray-900'"
             >
                {{ tab.name }}
             </button>
          </div>

          <!-- Edit Profile Shortcut -->
          <Link :href="route('profile.edit')" class="flex items-center gap-3 px-6 py-4 bg-gray-900 text-white rounded-[2rem] hover:bg-pala transition-all shadow-xl shadow-black/10 group">
             <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
             <span class="text-[10px] font-black uppercase tracking-widest">Edit Profil & Akun</span>
          </Link>
       </div>

       <!-- Content Transition -->
       <div class="animate-in fade-in slide-in-from-bottom-8 duration-700">
          
          <!-- TAB: WISHLIST -->
          <div v-if="activeTab === 'wishlist'" class="space-y-10">
             <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 border-b border-gray-50 pb-8">
                <div>
                   <h2 class="text-3xl font-black text-gray-900 italic">Jelajah Impian</h2>
                   <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Simpan tempat impian Anda di sini</p>
                </div>
                <Link href="/" class="px-6 py-2.5 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-pala transition-colors shadow-lg shadow-black/10">Cari Destinasi Baru</Link>
             </div>

             <div v-if="favorites.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div v-for="fav in favorites" :key="fav.id" class="group relative bg-white rounded-[3rem] overflow-hidden border border-gray-50 shadow-sm hover:shadow-2xl transition-all h-[450px]">
                   <img :src="fav.favoritable.image_url" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" />
                   <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                   
                   <!-- Card Content -->
                   <div class="absolute inset-0 p-8 flex flex-col justify-between text-white">
                      <div class="flex justify-between items-start">
                         <span class="px-3 py-1 bg-white/10 backdrop-blur-md rounded-xl text-[9px] font-black uppercase tracking-widest border border-white/10 italic">{{ fav.favoritable_type.split('\\').pop() }}</span>
                         <button @click="removeFavorite(fav)" class="p-2.5 bg-red-500/80 backdrop-blur-md text-white rounded-xl hover:bg-red-500 transition-all transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                         </button>
                      </div>
                      
                      <div class="space-y-4">
                         <div class="flex items-center gap-2 text-spice-gold font-black text-xs">
                            <span v-for="i in 5" :key="i">{{ i <= fav.favoritable.rating ? '★' : '☆' }}</span>
                         </div>
                         <h3 class="text-2xl font-black italic tracking-tight">{{ fav.favoritable.name }}</h3>
                         <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center text-xs font-bold text-gray-300">
                               <span class="mr-1.5 opacity-50">📍</span> {{ fav.favoritable.location }}
                            </div>
                            <Link href="/" class="p-4 bg-white text-gray-900 rounded-full hover:bg-pala hover:text-white transition-all transform hover:rotate-12">
                               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </Link>
                         </div>
                      </div>
                   </div>
                </div>
             </div>

             <div v-else class="py-32 flex flex-col items-center justify-center text-center opacity-30 select-none grayscale">
                <span class="text-9xl mb-8">🧭</span>
                <p class="text-xl font-black uppercase tracking-widest">Belum ada jejak tersimpan</p>
             </div>
          </div>

          <!-- TAB: REVIEWS -->
          <div v-if="activeTab === 'reviews'" class="space-y-10">
             <div class="border-b border-gray-50 pb-8">
                <h2 class="text-3xl font-black text-gray-900 italic">Arsip Pengalaman</h2>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Ulasan jujur Anda untuk dunia</p>
             </div>

             <div v-if="reviews.length > 0" class="columns-1 md:columns-2 gap-8 space-y-8">
                <div v-for="review in reviews" :key="review.id" class="break-inside-avoid bg-gray-50 p-10 rounded-[3.5rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                   <div class="flex items-center justify-between mb-8">
                      <div class="flex items-center gap-3">
                         <div class="w-12 h-12 bg-gray-900 rounded-2xl flex items-center justify-center text-white font-black text-lg group-hover:bg-pala transition-colors">
                            {{ review.rating }}
                         </div>
                         <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1 italic">{{ review.reviewable_type.split('\\').pop() }}</p>
                            <h4 class="text-lg font-black text-gray-900 tracking-tight">{{ review.reviewable.name }}</h4>
                         </div>
                      </div>
                      <div class="flex text-spice-gold gap-0.5">
                         <span v-for="i in 5" :key="i" class="text-xs">{{ i <= review.rating ? '★' : '☆' }}</span>
                      </div>
                   </div>
                   <div class="relative">
                      <span class="absolute -top-6 -left-2 text-6xl text-gray-200 font-serif opacity-30">“</span>
                      <p class="text-gray-600 font-medium italic leading-relaxed text-lg mb-8 relative z-10">{{ review.comment }}</p>
                   </div>
                   <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest">{{ new Date(review.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</p>
                </div>
             </div>

             <div v-else class="py-32 flex flex-col items-center justify-center text-center opacity-30 select-none grayscale">
                <span class="text-9xl mb-8">✍️</span>
                <p class="text-xl font-black uppercase tracking-widest">Suara Anda belum terdengar</p>
             </div>
          </div>

       </div>
    </div>
  </TravelerProfileLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import TravelerProfileLayout from '@/Layouts/TravelerProfileLayout.vue';
import { ref, inject } from 'vue';

const props = defineProps({
  favorites: Array,
  reviews: Array,
});

const activeTab = ref('wishlist');

const tabs = [
   { id: 'wishlist', name: 'Wishlist' },
   { id: 'reviews', name: 'Ulasan' }
];

const confirm = inject('confirm');

const removeFavorite = async (fav) => {
    const ok = await confirm({
        title: 'Hapus Wishlist?',
        message: `Apakah Anda yakin ingin menghapus "${fav.favoritable.name}" dari daftar impian Anda?`,
        confirmText: 'Ya, Hapus',
        cancelText: 'Kembali'
    });

    if (ok) {
        router.post(route('favorites.toggle'), {
            favoritable_id: fav.favoritable_id,
            favoritable_type: fav.favoritable_type.split('\\').pop()
        }, {
            preserveScroll: true
        });
    }
};
</script>
