<template>
  <section id="info" class="py-24 bg-gray-900 text-white relative overflow-hidden">
    <!-- Abstract Background Pattern using SVG for aesthetics -->
    <div class="absolute inset-0 opacity-10">
      <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
        <defs>
          <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#grid)" />
      </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Info Content -->
        <div>
          <span class="text-pala font-semibold tracking-wider uppercase text-sm mb-2 block">{{ settings.info_subtitle }}</span>
          <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl mb-6">
            {{ settings.info_title }}
          </h2>
          <p class="text-gray-300 text-lg mb-8 leading-relaxed">
            {{ settings.info_description }}
          </p>

          <div class="space-y-6">
            <div class="flex">
              <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-md bg-pala/20 text-pala">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-xl font-bold">{{ settings.info_feature_1_title }}</h3>
                <p class="mt-1 text-gray-400 text-sm leading-relaxed">{{ settings.info_feature_1_desc }}</p>
              </div>
            </div>

            <div class="flex">
              <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-md bg-pala/20 text-pala">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                </svg>
              </div>
              <div class="ml-4">
                <h3 class="text-xl font-bold">{{ settings.info_feature_2_title }}</h3>
                <p class="mt-1 text-gray-400 text-sm leading-relaxed">{{ settings.info_feature_2_desc }}</p>
              </div>
            </div>
          </div>
          
          <div class="mt-10">
            <a v-if="settings.info_button_link?.startsWith('http') || settings.info_button_link?.startsWith('#')" :href="settings.info_button_link" class="inline-flex px-8 py-4 border border-transparent text-base font-bold rounded-full shadow-lg shadow-pala/30 text-white bg-pala hover:bg-pala-dark transition-all transform hover:scale-105 active:scale-95">
              {{ settings.info_button_text }}
            </a>
            <Link v-else :href="settings.info_button_link" class="inline-flex px-8 py-4 border border-transparent text-base font-bold rounded-full shadow-lg shadow-pala/30 text-white bg-pala hover:bg-pala-dark transition-all transform hover:scale-105 active:scale-95">
              {{ settings.info_button_text }}
            </Link>
          </div>
        </div>

        <!-- Image Gallery/Collage -->
        <div class="relative h-96 lg:h-[500px]">
          <div class="absolute inset-y-0 right-0 w-4/5 h-full rounded-2xl overflow-hidden shadow-2xl transition-transform duration-700 hover:scale-[1.02]">
             <img :src="settings.info_image_1" class="w-full h-full object-cover grayscale-[20%] hover:grayscale-0 transition-all duration-700" alt="Pemandangan Aceh" />
          </div>
          <div class="absolute bottom-10 left-0 w-2/3 h-56 rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-900 z-10 transition-transform duration-700 hover:scale-[1.05]">
             <img :src="settings.info_image_2" class="w-full h-full object-cover" alt="Kuliner Lokal" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  settings: Object,
});
</script>
