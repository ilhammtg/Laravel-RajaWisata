<template>
  <section id="event" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
        <div class="max-w-2xl">
          <span class="text-pala font-semibold tracking-wider uppercase text-sm">Kalender Event</span>
          <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Jangan Lewatkan
          </h2>
          <p class="mt-4 text-lg text-gray-500">
            Berbagai pagelaran budaya, festival, dan perayaan yang menjadikan Aceh Selatan semakin hidup dan meriah.
          </p>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Featured Event -->
        <div v-if="featuredEvent" @click="selectedEvent = featuredEvent" class="relative rounded-2xl overflow-hidden shadow-lg group cursor-pointer">
          <img :src="featuredEvent.image_url" :alt="featuredEvent.name" class="w-full h-full object-cover min-h-[400px] transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
          <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
          
          <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg p-3 text-center min-w-[70px] shadow-sm">
            <div class="text-sm font-bold text-pala uppercase">{{ getMonth(featuredEvent.date) }}</div>
            <div class="text-2xl font-extrabold text-gray-900">{{ getDay(featuredEvent.date) }}</div>
          </div>

          <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-500 text-white mb-3">
              {{ featuredEvent.category }}
            </span>
            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ featuredEvent.name }}</h3>
            <p class="text-gray-200 line-clamp-2 mb-4">{{ featuredEvent.description }}</p>
            <div class="flex items-center text-sm text-gray-300">
              <span class="mr-2">📍 {{ featuredEvent.location }}</span>
              <span>🕒 {{ featuredEvent.time }}</span>
            </div>
          </div>
        </div>

        <!-- Event List -->
        <div class="flex flex-col space-y-6">
          
          <div v-for="event in otherEvents" :key="event.id" @click="selectedEvent = event" class="group flex bg-spice-sand rounded-xl overflow-hidden hover:bg-pala-light transition-colors border border-gray-100 hover:border-pala-light hover:shadow-md cursor-pointer">
            <div class="w-1/3 min-w-[120px] relative">
              <img :src="event.image_url" :alt="event.name" class="w-full h-full object-cover">
            </div>
            <div class="p-5 flex-1 flex flex-col justify-center">
              <div class="flex items-center text-xs font-medium text-pala mb-1">
                <span>{{ formatDate(event.date) }}</span>
              </div>
              <h4 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-pala-dark transition-colors">{{ event.name }}</h4>
              <p class="text-sm text-gray-500 mb-2 line-clamp-1">{{ event.description }}</p>
              <div class="text-xs text-gray-400">📍 {{ event.location }}</div>
            </div>
          </div>

          <!-- See More Button inside list column -->
          <div v-if="events && events.length > 4" class="pt-2">
            <button @click="showAll = !showAll" class="text-pala font-bold hover:text-pala-dark flex items-center transition-colors">
              {{ showAll ? 'Sembunyikan Sebagian' : 'Lihat Semua Event' }}
              <svg :class="['w-5 h-5 ml-2 transition-transform', showAll ? 'rotate-180' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
          </div>

        </div>
      </div>

      <!-- Detail Modal -->
      <div v-if="selectedEvent" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-md" @click="closeModal"></div>
        
        <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col lg:flex-row animate-in fade-in zoom-in duration-300">
          
          <!-- Close Button -->
          <button @click="closeModal" class="absolute top-6 right-6 z-20 p-3 bg-black/20 hover:bg-black/40 backdrop-blur-xl rounded-full text-white transition-all transform hover:scale-110 active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>

          <!-- Left Column: Immersive Gallery -->
          <div class="relative w-full lg:w-[45%] h-[400px] lg:h-auto shrink-0 bg-gray-900 overflow-hidden group">
            <Transition name="fade" mode="out-in">
              <img :key="activeImg || selectedEvent.image_url" :src="activeImg || selectedEvent.image_url" :alt="selectedEvent.name" class="w-full h-full object-cover">
            </Transition>
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent pointer-events-none"></div>

            <!-- Thumbnail Navigator -->
            <div v-if="hasGallery" class="absolute bottom-6 left-6 right-6 z-10">
              <div class="flex gap-3 overflow-x-auto pb-3 snap-x no-scrollbar">
                <button 
                  @click="activeImg = selectedEvent.image_url"
                  class="relative shrink-0 w-20 h-28 rounded-2xl overflow-hidden border-2 transition-all snap-start"
                  :class="activeImg === selectedEvent.image_url || activeImg === null ? 'border-red-500 scale-105 shadow-lg shadow-red-500/30' : 'border-white/30 grayscale hover:grayscale-0'"
                >
                  <img :src="selectedEvent.image_url" class="w-full h-full object-cover">
                </button>
                <button 
                  v-for="(img, idx) in selectedEvent.gallery" :key="idx"
                  @click="activeImg = img"
                  class="relative shrink-0 w-20 h-28 rounded-2xl overflow-hidden border-2 transition-all snap-start"
                  :class="activeImg === img ? 'border-red-500 scale-105 shadow-lg shadow-red-500/30' : 'border-white/30 grayscale hover:grayscale-0'"
                >
                  <img :src="img" class="w-full h-full object-cover">
                </button>
              </div>
            </div>

            <!-- Image Badge -->
            <div v-if="hasGallery" class="absolute top-6 left-6 z-10">
               <span class="px-4 py-2 bg-black/40 backdrop-blur-md rounded-full text-[10px] font-black text-white uppercase tracking-widest border border-white/20">
                 {{ galleryCount }} Foto Poster & Event
               </span>
            </div>

            <!-- Event Date Sticker Over Image (Desktop) -->
            <div class="hidden lg:block absolute top-10 right-[-50px] rotate-45 bg-red-500 text-white px-20 py-2 shadow-2xl z-10 font-black uppercase tracking-[0.3em] text-[10px]">
               LIVE EVENT
            </div>
          </div>

          <!-- Right Column: Premium Content Area -->
          <div class="flex-1 flex flex-col overflow-hidden bg-white">
            <div class="overflow-y-auto custom-scrollbar flex-1">
              <div class="p-8 lg:p-12 space-y-10">
                <!-- Header Info -->
                <div class="space-y-4">
                  <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-red-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest leading-none">
                       {{ selectedEvent.category }}
                    </span>
                    <span v-if="selectedEvent.is_featured" class="px-3 py-1 bg-spice-gold text-black rounded-full text-[10px] font-black uppercase tracking-widest leading-none">
                       Unggulan
                    </span>
                  </div>
                  <h2 class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight uppercase tracking-tight">
                    {{ selectedEvent.name }}
                  </h2>
                </div>

                <!-- Event Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                   <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100">
                      <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal Pelaksanaan</p>
                      <p class="text-sm font-black text-gray-900">{{ formatDate(selectedEvent.date) }}</p>
                   </div>
                   <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100">
                      <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Waktu / Jam</p>
                      <p class="text-sm font-black text-gray-900">{{ selectedEvent.time }}</p>
                   </div>
                </div>

                <!-- Description -->
                <div class="space-y-4">
                   <h4 class="text-[10px] font-black text-pala uppercase tracking-[0.25em] border-l-4 border-pala pl-4">Rincian Acara</h4>
                   <p class="text-gray-600 leading-relaxed whitespace-pre-line text-lg font-medium">
                     {{ selectedEvent.details || selectedEvent.description }}
                   </p>
                </div>

                <!-- Maps -->
                <div class="space-y-6 pt-6 border-t border-gray-100">
                  <div class="flex items-center justify-between mb-4">
                    <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.25em]">Lokasi Penyelenggaraan</h4>
                    <span class="text-xs font-bold text-gray-400">📍 {{ selectedEvent.location }}</span>
                  </div>
                  
                  <div v-if="selectedEvent.map_iframe" v-html="selectedEvent.map_iframe" class="w-full aspect-[21/9] rounded-[2rem] overflow-hidden border border-gray-100 shadow-inner group-hover:shadow-md transition-shadow [&>iframe]:w-full [&>iframe]:h-full"></div>
                  <div v-else class="w-full aspect-[21/9] rounded-[2rem] bg-gray-50 flex flex-col items-center justify-center text-gray-300 border-2 border-dashed border-gray-100 italic">
                    <span class="text-3xl mb-2">🗺️</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Peta Interaktif Belum Tersedia</span>
                  </div>
                </div>

                <!-- Tips -->
                <div class="p-5 bg-amber-50 rounded-2xl border border-amber-100 flex gap-4">
                   <span class="text-xl">💡</span>
                   <p class="text-xs text-amber-700 font-medium leading-relaxed italic">
                     *Datanglah lebih awal untuk mendapatkan posisi terbaik. Pastikan membawa perlengkapan yang sesuai dengan tema event.
                   </p>
                </div>
              </div>
            </div>

            <!-- Footer Action Bar -->
            <div class="p-8 border-t border-gray-50 bg-gray-50/30 flex items-center justify-between">
               <div class="hidden sm:block">
                 <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Bagikan Pengalaman</p>
                 <div class="flex gap-4 mt-3 text-gray-400">
                   <!-- Facebook -->
                   <a href="#" class="hover:text-red-500 transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                   </a>
                   <!-- Instagram -->
                   <a href="#" class="hover:text-red-500 transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                   </a>
                   <!-- WhatsApp -->
                   <a href="#" class="hover:text-red-500 transition-all transform hover:scale-110">
                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                   </a>
                 </div>
               </div>
               <div v-if="selectedEvent.location_url">
                  <a :href="selectedEvent.location_url" target="_blank" class="px-10 py-5 bg-gray-900 text-white font-black rounded-2xl shadow-xl shadow-gray-900/30 hover:bg-black hover:scale-105 active:scale-95 transition-all text-sm uppercase tracking-[0.2em]">
                    📍 Navigasi Sekarang
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
  events: Array,
});

const showAll = ref(false);
const selectedEvent = ref(null);
const activeImg = ref(null);

const closeModal = () => {
    selectedEvent.value = null;
    activeImg.value = null;
};

const hasGallery = computed(() => {
    return selectedEvent.value?.gallery && selectedEvent.value.gallery.length > 0;
});

const galleryCount = computed(() => {
    if (!selectedEvent.value) return 0;
    return (selectedEvent.value.gallery?.length || 0) + 1;
});

const featuredEvent = computed(() => props.events.find(e => e.is_featured) || props.events[0]);
const otherEvents = computed(() => {
    if (!props.events) return [];
    const others = props.events.filter(e => e.id !== featuredEvent.value?.id);
    return showAll.value ? others : others.slice(0, 3);
});

const getMonth = (dateStr) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleString('id-ID', { month: 'short' });
};

const getDay = (dateStr) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.getDate();
};

const formatDate = (dateStr) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
};
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
