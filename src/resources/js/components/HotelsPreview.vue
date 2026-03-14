<template>
  <section id="hotel" class="py-20 bg-pala-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
        <div class="max-w-xl">
          <span class="text-pala font-semibold tracking-wider uppercase text-sm">Penginapan & Hotel</span>
          <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Istirahat dengan Nyaman
          </h2>
          <p class="mt-4 text-lg text-gray-600">
            Temukan tempat beristirahat terbaik setelah seharian mengeksplorasi alam Aceh Selatan yang mempesona.
          </p>
        </div>
      </div>

      <!-- Hotels Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div v-for="hotel in displayedHotels" :key="hotel.id" class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition overflow-hidden group">
          <div class="relative h-48 w-full overflow-hidden">
            <img :src="hotel.image_url" :alt="hotel.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold text-gray-800 flex items-center shadow-sm z-10">
              <span class="text-spice-gold mr-1">★</span> {{ hotel.rating }}
            </div>
            
            <!-- Favorite Toggle -->
            <button 
              @click.stop="toggleFavorite(hotel.id)"
              class="absolute top-3 left-3 w-10 h-10 rounded-xl flex items-center justify-center transition-all transform active:scale-95 shadow-lg backdrop-blur-md z-10"
              :class="isFavorited(hotel.id) ? 'bg-red-500 text-white' : 'bg-white/95 text-gray-400 hover:text-red-500'"
            >
               <svg class="w-5 h-5" :fill="isFavorited(hotel.id) ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
               </svg>
            </button>
          </div>
          <div class="p-5">
            <div class="text-xs text-gray-400 mb-1 flex items-center uppercase tracking-wider font-semibold">
              <span>{{ hotel.category }}</span> <span class="mx-2">•</span> <span>{{ hotel.location }}</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ hotel.name }}</h3>
            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ hotel.description }}</p>
            <div class="flex items-center justify-between border-t border-gray-50 pt-4 mt-auto">
              <div>
                <span class="text-sm text-gray-400">Mulai dari</span>
                <div class="font-bold text-pala">Rp {{ Number(hotel.price).toLocaleString('id-ID') }}<span class="text-xs font-normal text-gray-500">/malam</span></div>
              </div>
              <button @click="selectedHotel = hotel" class="w-8 h-8 rounded-full bg-pala-light text-pala flex items-center justify-center hover:bg-pala hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </button>
            </div>
          </div>
        </div>

      </div>

      <div v-if="hotels && hotels.length > 4" class="mt-12 text-center">
        <button @click="showAll = !showAll" class="inline-flex items-center px-6 py-3 border border-pala text-base font-medium rounded-full text-pala bg-transparent hover:bg-pala hover:text-white transition-colors shadow-sm">
          {{ showAll ? 'Sembunyikan' : 'Lihat Semua Penginapan' }}
          <svg :class="['w-4 h-4 ml-2 transition-transform', showAll ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
      </div>

      <!-- Detail Modal -->
      <div v-if="selectedHotel" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-md" @click="closeModal"></div>
        
        <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col lg:flex-row animate-in fade-in zoom-in duration-300">
          
          <!-- Close Button -->
          <button @click="closeModal" class="absolute top-6 right-6 z-20 p-3 bg-black/20 hover:bg-black/40 backdrop-blur-xl rounded-full text-white transition-all transform hover:scale-110 active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>

          <!-- Left Column: Immersive Gallery -->
          <div class="relative w-full lg:w-[50%] h-[350px] lg:h-auto shrink-0 bg-gray-900 overflow-hidden group">
            <Transition name="fade" mode="out-in">
              <img :key="activeImg || selectedHotel.image_url" :src="activeImg || selectedHotel.image_url" :alt="selectedHotel.name" class="w-full h-full object-cover">
            </Transition>
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>

            <!-- Thumbnail Navigator -->
            <div v-if="hasGallery" class="absolute bottom-6 left-6 right-6 z-10">
              <div class="flex gap-3 overflow-x-auto pb-3 snap-x no-scrollbar">
                <button 
                  @click="activeImg = selectedHotel.image_url"
                  class="relative shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 transition-all snap-start"
                  :class="activeImg === selectedHotel.image_url || activeImg === null ? 'border-spice-gold scale-105 shadow-lg shadow-spice-gold/30' : 'border-white/30 grayscale hover:grayscale-0'"
                >
                  <img :src="selectedHotel.image_url" class="w-full h-full object-cover">
                </button>
                <button 
                  v-for="(img, idx) in selectedHotel.gallery" :key="idx"
                  @click="activeImg = img"
                  class="relative shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 transition-all snap-start"
                  :class="activeImg === img ? 'border-spice-gold scale-105 shadow-lg shadow-spice-gold/30' : 'border-white/30 grayscale hover:grayscale-0'"
                >
                  <img :src="img" class="w-full h-full object-cover">
                </button>
              </div>
            </div>

            <!-- Image Badge -->
            <div v-if="hasGallery" class="absolute top-6 left-6 z-10">
               <span class="px-4 py-2 bg-black/40 backdrop-blur-md rounded-full text-[10px] font-black text-white uppercase tracking-widest border border-white/20">
                 {{ galleryCount }} Foto Properti
               </span>
            </div>
          </div>

          <!-- Right Column: Premium Content Area -->
          <div class="flex-1 flex flex-col overflow-hidden bg-white">
            <div class="overflow-y-auto custom-scrollbar flex-1">
              <div class="p-8 lg:p-12 space-y-10">
                <!-- Header Info -->
                <div class="space-y-4">
                  <div class="flex items-center gap-3">
                    <span class="px-2 py-0.5 bg-spice-gold rounded text-[10px] font-black uppercase text-black">★ {{ selectedHotel.rating }}</span>
                    <span class="px-4 py-1.5 bg-pala/10 text-pala rounded-full text-[10px] font-black uppercase tracking-wider border border-pala/20">
                       {{ selectedHotel.category }}
                    </span>
                  </div>
                  <h2 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight">
                    {{ selectedHotel.name }}
                  </h2>
                  <div class="flex items-center text-gray-400 font-bold uppercase tracking-[0.15em] text-[11px]">
                    <span class="mr-2 p-1.5 bg-gray-50 rounded-lg text-gray-500">📍</span> {{ selectedHotel.location }}
                  </div>
                </div>

                <!-- Price Highlight -->
                <div class="bg-pala/5 rounded-[2rem] p-8 border border-pala/10 flex items-center justify-between">
                   <div>
                     <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Harga Mulai Dari</p>
                     <p class="text-3xl font-black text-pala">Rp {{ Number(selectedHotel.price).toLocaleString('id-ID') }}<span class="text-xs font-normal text-gray-500 italic"> /malam</span></p>
                   </div>
                   <div class="text-right">
                      <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</span>
                      <span class="text-emerald-500 font-black uppercase tracking-widest text-xs">● Tersedia</span>
                   </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                   <h4 class="text-[10px] font-black text-pala uppercase tracking-[0.25em] border-l-4 border-pala pl-4">Fasilitas & Detail</h4>
                   <p class="text-gray-600 leading-relaxed whitespace-pre-line text-lg font-medium">
                     {{ selectedHotel.details || selectedHotel.description }}
                   </p>
                </div>

                <!-- Maps -->
                <div class="space-y-6 pt-6 border-t border-gray-100">
                  <div class="flex items-center justify-between mb-4">
                    <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.25em]">Lokasi Strategis</h4>
                    <a v-if="selectedHotel.location_url" :href="selectedHotel.location_url" target="_blank" class="text-xs font-black text-pala hover:text-pala-dark transition-colors uppercase tracking-widest flex items-center gap-2">
                       Akses Navigasi ↗️
                    </a>
                  </div>
                  
                  <div v-if="selectedHotel.map_iframe" v-html="selectedHotel.map_iframe" class="w-full aspect-[21/9] rounded-[2rem] overflow-hidden border border-gray-100 shadow-inner group-hover:shadow-md transition-shadow [&>iframe]:w-full [&>iframe]:h-full"></div>
                  <div v-else class="w-full aspect-[21/9] rounded-[2rem] bg-gray-50 flex flex-col items-center justify-center text-gray-300 border-2 border-dashed border-gray-100 italic">
                    <span class="text-3xl mb-2">🗺️</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Peta Interaktif Belum Tersedia</span>
                  </div>
                </div>

                <!-- Reviews Section -->
                <div class="space-y-8 pt-10 border-t border-gray-100 pb-20">
                   <div class="flex items-center justify-between">
                      <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.25em]">Ulasan Pengunjung</h4>
                      <div class="flex items-center gap-2">
                         <span class="text-xs font-bold text-gray-400">Rating Rata-rata:</span>
                         <span class="text-sm font-black text-spice-gold">{{ selectedHotel.rating || '0.0' }} / 5.0</span>
                      </div>
 
                   <!-- Reviews List -->
                   <div v-if="selectedHotel.reviews?.length > 0" class="space-y-4 max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
                      <div v-for="review in selectedHotel.reviews" :key="review.id" class="p-6 bg-gray-50 rounded-[2rem] border border-gray-100 hover:shadow-md transition-all">
                         <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                               <div class="w-10 h-10 rounded-full bg-pala/10 flex items-center justify-center text-pala font-black text-xs">
                                  {{ review.user.name.charAt(0).toUpperCase() }}
                               </div>
                               <div>
                                  <p class="text-[11px] font-black text-gray-900 uppercase tracking-widest">{{ review.user.name }}</p>
                                  <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ new Date(review.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</p>
                               </div>
                            </div>
                            <div class="flex gap-0.5 text-spice-gold">
                               <span v-for="i in 5" :key="i" class="text-sm">{{ i <= review.rating ? '★' : '☆' }}</span>
                            </div>
                         </div>
                         <p class="text-gray-600 text-sm leading-relaxed font-medium italic">"{{ review.comment }}"</p>
                      </div>
                   </div>
                   <div v-else class="text-center py-10 bg-gray-50 rounded-[2rem] border border-dashed border-gray-200">
                      <p class="text-sm text-gray-400 font-medium italic">Belum ada ulasan untuk penginapan ini. Jadilah yang pertama!</p>
                   </div>
                   </div>

                   <!-- Review Form (Only if logged in) -->
                   <div v-if="$page.props.auth?.user" class="bg-gray-50 p-6 rounded-3xl border border-gray-100 space-y-4">
                      <p class="text-xs font-bold text-gray-600">Bagikan pengalaman Anda:</p>
                      <div class="flex gap-2">
                         <button 
                           v-for="star in 5" :key="star" 
                           @click="reviewForm.rating = star"
                           class="text-2xl transition-all transform hover:scale-110"
                           :class="star <= reviewForm.rating ? 'text-spice-gold' : 'text-gray-200'"
                         >
                           ★
                         </button>
                      </div>
                      <textarea 
                        v-model="reviewForm.comment"
                        class="w-full rounded-2xl border-gray-200 text-sm focus:border-pala focus:ring-pala p-4 min-h-[100px]"
                        placeholder="Tulis pendapat Anda tentang tempat ini..."
                      ></textarea>
                      <button 
                        @click="submitReview"
                        :disabled="reviewForm.processing"
                        class="w-full py-3 bg-pala text-white font-black rounded-xl text-xs uppercase tracking-widest hover:bg-pala-dark transition-all disabled:opacity-50"
                      >
                        {{ reviewForm.processing ? 'Mengirim...' : 'Kirim Ulasan' }}
                      </button>
                   </div>
                   <div v-else class="p-8 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                      <p class="text-sm text-gray-400 font-medium italic mb-3">Silakan login untuk memberikan ulasan</p>
                      <Link href="/login" class="text-xs font-black text-pala uppercase tracking-widest hover:underline">Login Sekarang →</Link>
                   </div>
                </div>
              </div>
            </div>

            <!-- Footer Action Bar (Sticky) -->
            <div class="p-8 border-t border-gray-50 bg-gray-50/30 flex items-center justify-between">
               <div class="hidden sm:block">
                 <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Bagikan Pengalaman</p>
                 <div class="flex gap-4 mt-3 text-gray-400">
                   <!-- Facebook -->
                   <a href="#" class="hover:text-pala transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                   </a>
                   <!-- Instagram -->
                   <a href="#" class="hover:text-pala transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                   </a>
                   <!-- WhatsApp -->
                   <a href="#" class="hover:text-pala transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                   </a>
                 </div>
               </div>
               <div v-if="selectedHotel.location_url">
                  <a :href="selectedHotel.location_url" target="_blank" class="px-10 py-5 bg-pala text-white font-black rounded-2xl shadow-xl shadow-pala/30 hover:bg-pala-dark hover:scale-105 active:scale-95 transition-all text-sm uppercase tracking-[0.2em]">
                    🏡 Pesan Sekarang
                  </a>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  hotels: Array,
  user_favorites: {
    type: Array,
    default: () => []
  }
});

import { router, useForm, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const showAll = ref(false);
const selectedHotel = ref(null);
const activeImg = ref(null);

const reviewForm = useForm({
    reviewable_id: null,
    reviewable_type: 'Hotel',
    rating: 5,
    comment: ''
});

const isFavorited = (id) => {
    return props.user_favorites.includes(id);
};

const toggleFavorite = (id) => {
    if (!page.props.auth?.user) {
        router.get('/login');
        return;
    }

    router.post(route('favorites.toggle'), {
        favoritable_id: id,
        favoritable_type: 'Hotel'
    }, {
        preserveScroll: true,
        only: ['user_favorites']
    });
};

const submitReview = () => {
    reviewForm.reviewable_id = selectedHotel.value.id;
    reviewForm.post(route('reviews.store'), {
        preserveScroll: true,
        onSuccess: () => {
            reviewForm.reset('comment', 'rating');
        }
    });
};

const closeModal = () => {
    selectedHotel.value = null;
    activeImg.value = null;
};

const hasGallery = computed(() => {
    return selectedHotel.value?.gallery && selectedHotel.value.gallery.length > 0;
});

const galleryCount = computed(() => {
    if (!selectedHotel.value) return 0;
    return (selectedHotel.value.gallery?.length || 0) + 1;
});

const displayedHotels = computed(() => {
  if (!props.hotels) return [];
  // Show 4 initially because it's a 4-column layout
  return showAll.value ? props.hotels : props.hotels.slice(0, 4);
});
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #E5E7EB;
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #D1D5DB;
}

.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
