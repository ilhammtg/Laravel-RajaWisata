<template>
  <div class="relative h-screen w-full flex items-end justify-center pb-20 overflow-hidden">
    <!-- Fullscreen Landscape Background -->
    <div class="absolute inset-0 z-0">
      <img :src="featuredHero.image_url" 
           :alt="featuredHero.name" 
           class="w-full h-full object-cover object-center" />
      <!-- Soft gradient overlay for text readability -->
      <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80"></div>
    </div>

    <!-- Center Carousel / Feature Title -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white flex flex-col items-center">
      
      <!-- Down arrow indicator -->
      <div class="mb-2 transition-transform duration-300 hover:translate-y-1">
        <svg fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8 opacity-90 drop-shadow-md">
          <path d="M7 10l5 5 5-5z"></path>
        </svg>
      </div>

      <!-- Current Location Title -->
      <transition name="fade-up" mode="out-in">
        <h1 :key="featuredHero.name" class="text-4xl sm:text-5xl md:text-6xl font-serif tracking-wide text-center drop-shadow-lg mb-8 font-medium">
          {{ featuredHero.name }}
        </h1>
      </transition>

      <!-- Mini Carousel List -->
      <div class="flex items-center justify-center w-full space-x-4 md:space-x-12 opacity-80 mt-2">
        
        <!-- Left Arrow -->
        <button @click="prevHero" class="p-2 bg-white/10 hover:bg-white/20 hover:scale-110 rounded-full transition cursor-pointer backdrop-blur-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <div class="hidden md:flex space-x-12 text-sm sm:text-lg font-medium tracking-wider uppercase items-center overflow-x-auto no-scrollbar">
          <template v-for="(dest, index) in heroItems" :key="dest.id">
            <span 
              @click="setHero(index)"
              :class="[index === currentIndex ? 'font-bold opacity-100 text-spice-gold border-b-2 border-spice-gold pb-1' : 'opacity-50 hover:opacity-100 cursor-pointer', 'transition whitespace-nowrap']"
            >
              {{ dest.name }}
            </span>
          </template>
        </div>

        <div class="md:hidden text-sm uppercase tracking-wider font-semibold">{{ currentIndex + 1 }} / {{ heroItems.length }}</div>

        <!-- Right Arrow -->
        <button @click="nextHero" class="p-2 bg-white/10 hover:bg-white/20 hover:scale-110 rounded-full transition cursor-pointer backdrop-blur-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  destinations: {
    type: Array,
    default: () => []
  },
  hero_destinations: {
    type: Array,
    default: () => []
  }
});

const currentIndex = ref(0);
const heroItems = computed(() => {
  if (props.hero_destinations && props.hero_destinations.length > 0) {
    return props.hero_destinations;
  }
  return props.destinations.slice(0, 5);
});

const featuredHero = computed(() => heroItems.value[currentIndex.value] || {
  name: 'Aceh Selatan',
  image_url: 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?q=80&w=2674&auto=format&fit=crop'
});

const nextHero = () => {
    currentIndex.value = (currentIndex.value + 1) % heroItems.value.length;
};

const prevHero = () => {
    currentIndex.value = (currentIndex.value - 1 + heroItems.value.length) % heroItems.value.length;
};

const setHero = (index) => {
    currentIndex.value = index;
};

let timer = null;
onMounted(() => {
    if (heroItems.value.length > 1) {
        timer = setInterval(nextHero, 8000);
    }
});

onUnmounted(() => {
    if (timer) clearInterval(timer);
});
</script>

<style scoped>
.fade-up-enter-active,
.fade-up-leave-active {
  transition: all 0.6s ease;
}

.fade-up-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.fade-up-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
