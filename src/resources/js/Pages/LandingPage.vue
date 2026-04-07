<template>
  <Head title="Jelajahi Keindahan Aceh Selatan" />

  <div class="min-h-screen flex flex-col font-sans">
    <Navbar />
    
      <main class="flex-grow">
      <Hero :destinations="destinations" :hero_destinations="hero_destinations" />

      <!-- Personalized Sections for Authenticated Users -->
      <section v-if="$page.props.auth?.user && (user_favorites.list.length > 0 || user_reviews.length > 0)" class="bg-white py-12 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           <div class="flex flex-col lg:flex-row gap-12">
              <!-- Quick Wishlist -->
              <div v-if="user_favorites.list.length > 0" class="flex-1 space-y-6">
                 <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                       <span class="text-red-500 text-lg">❤️</span> Wishlist Saya
                    </h3>
                    <Link :href="route('user.dashboard')" class="text-[10px] font-black text-pala uppercase tracking-widest hover:underline">Lihat Dashboard →</Link>
                 </div>
                 <div class="flex gap-4 overflow-x-auto pb-4 no-scrollbar">
                    <div v-for="fav in user_favorites.list.slice(0, 5)" :key="fav.id" class="shrink-0 w-48 group">
                       <div class="relative h-24 rounded-2xl overflow-hidden mb-2">
                          <img :src="fav.favoritable.image_url" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                          <div class="absolute inset-0 bg-black/20"></div>
                       </div>
                       <p class="text-xs font-bold text-gray-900 truncate">{{ fav.favoritable.name }}</p>
                       <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest">{{ fav.favoritable_type.split('\\').pop() }}</p>
                    </div>
                 </div>
              </div>

              <!-- Quick Reviews -->
              <div v-if="user_reviews.length > 0" class="lg:w-1/3 space-y-6">
                 <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                       <span class="text-spice-gold text-lg">⭐</span> Ulasan Terakhir
                    </h3>
                 </div>
                 <div class="space-y-4">
                    <div v-for="review in user_reviews" :key="review.id" class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                       <div class="flex items-center justify-between mb-2">
                          <p class="text-[10px] font-black text-gray-900 truncate max-w-[120px]">{{ review.reviewable.name }}</p>
                          <div class="flex text-spice-gold gap-0.5">
                             <span v-for="i in 5" :key="i" class="text-[8px]">{{ i <= review.rating ? '★' : '☆' }}</span>
                          </div>
                       </div>
                       <p class="text-[11px] text-gray-500 italic line-clamp-1">"{{ review.comment }}"</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
      </section>

      <div ref="lazyRoot">
        <template v-if="belowFoldVisible">
          
          <Suspense>
            <template #default>
              <LazyDestinations :destinations="destinations" :user_favorites="user_favorites.destinations" />
            </template>
            <template #fallback>
              <div class="h-64 bg-gray-100 animate-pulse flex items-center justify-center">
                <span class="text-gray-400">Memuat Destinasi...</span>
              </div>
            </template>
          </Suspense>

          <Suspense>
            <template #default>
              <LazyHotels :hotels="hotels" :user_favorites="user_favorites.hotels" />
            </template>
            <template #fallback>
              <div class="h-64 bg-gray-50 animate-pulse mb-8" />
            </template>
          </Suspense>

          <Suspense>
            <template #default>
              <LazyCulinaries :culinaries="culinaries" :user_favorites="user_favorites.culinaries" />
            </template>
            <template #fallback>
              <div class="h-64 bg-white animate-pulse mb-8" />
            </template>
          </Suspense>

          <section class="bg-pala-dark py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                  <div class="text-4xl font-extrabold mb-2">{{ settings?.stats_destinations }}</div>
                  <div class="text-pala-light font-medium tracking-wide">Destinasi</div>
                </div>
                <div>
                  <div class="text-4xl font-extrabold mb-2">{{ settings?.stats_culinary }}</div>
                  <div class="text-pala-light font-medium tracking-wide">Kuliner</div>
                </div>
                <div>
                  <div class="text-4xl font-extrabold mb-2">{{ settings?.stats_events }}</div>
                  <div class="text-pala-light font-medium tracking-wide">Event</div>
                </div>
                <div>
                  <div class="text-4xl font-extrabold mb-2">{{ settings?.stats_service }}</div>
                  <div class="text-pala-light font-medium tracking-wide">Layanan</div>
                </div>
              </div>
            </div>
          </section>

          <Suspense>
            <template #default>
              <LazyEvents :events="events" />
            </template>
            <template #fallback>
              <div class="h-64 bg-gray-50 animate-pulse" />
            </template>
          </Suspense>

          <Suspense>
            <template #default>
              <LazyInfo :settings="settings" />
            </template>
            <template #fallback>
              <div class="h-64 bg-gray-900 animate-pulse" />
            </template>
          </Suspense>

        </template>
        
        <div v-else class="h-20 w-full" aria-hidden="true" />
      </div>
    </main>

    <template v-if="belowFoldVisible">
      <Suspense>
        <template #default>
          <LazyFooter :settings="settings" />
        </template>
        <template #fallback>
          <div class="h-32 bg-gray-900 animate-pulse" />
        </template>
      </Suspense>
    </template>
  </div>
</template>

<script setup>
import { ref, defineAsyncComponent, onMounted, onUnmounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3'; // Wajib untuk SEO di Inertia
import Navbar from '../components/Navbar.vue'; // Pastikan C besar jika folder bernama Components
import Hero from '../components/Hero.vue';

/** * OPTIMASI: Lazy Load Komponen Berat 
 * Ini memecah file JS menjadi potongan kecil (chunks)
 */
const LazyDestinations = defineAsyncComponent(() => import('../components/DestinationsPreview.vue'));
const LazyHotels       = defineAsyncComponent(() => import('../components/HotelsPreview.vue'));
const LazyCulinaries   = defineAsyncComponent(() => import('../components/CulinariesPreview.vue'));
const LazyEvents       = defineAsyncComponent(() => import('../components/EventsPreview.vue'));
const LazyInfo         = defineAsyncComponent(() => import('../components/InfoSection.vue'));
const LazyFooter       = defineAsyncComponent(() => import('../components/Footer.vue'));

const belowFoldVisible = ref(false);
const lazyRoot = ref(null);
let observer = null;

defineProps({
  hero_destinations: Array,
  destinations: Array,
  hotels: Array,
  culinaries: Array,
  events: Array,
  settings: Object,
  user_favorites: Object,
  user_reviews: Array,
});

onMounted(() => {
  // Handle initial hash scroll
  if (window.location.hash) {
    belowFoldVisible.value = true;
    setTimeout(() => {
      const id = window.location.hash.substring(1);
      const element = document.getElementById(id);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }, 500); // Wait for components to mount
  }

  // IntersectionObserver: Hanya memuat sisa halaman jika user scroll mendekati konten
  observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        belowFoldVisible.value = true;
        observer?.disconnect();
      }
    },
    { 
      rootMargin: '400px 0px', // Mulai muat 400px sebelum muncul di layar
      threshold: 0.01 
    }
  );

  if (lazyRoot.value) {
    observer.observe(lazyRoot.value);
  }
});

onUnmounted(() => {
  observer?.disconnect();
});
</script>