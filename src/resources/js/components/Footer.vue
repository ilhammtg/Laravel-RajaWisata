<template>
  <footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
        <div class="col-span-1 md:col-span-1">
          <a href="#" class="text-2xl font-bold tracking-tight text-white mb-4 block">
            Raja<span class="text-pala">Wisata</span>
          </a>
          <p class="text-gray-400 text-sm leading-relaxed mb-6">
            {{ settings?.footer_about }}
          </p>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-4 text-gray-100">Jelajah</h3>
          <ul class="space-y-3">
            <li><a href="#destinasi" class="text-gray-400 hover:text-pala transition text-sm">Destinasi Populer</a></li>
            <li><a href="#hotel" class="text-gray-400 hover:text-pala transition text-sm">Hotel & Penginapan</a></li>
            <li><a href="#kuliner" class="text-gray-400 hover:text-pala transition text-sm">Kuliner & Restoran</a></li>
            <li><a href="#event" class="text-gray-400 hover:text-pala transition text-sm">Kalender Event</a></li>
          </ul>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-6 text-gray-100 uppercase tracking-widest text-xs">Informasi</h3>
          <ul class="space-y-4">
            <li><a href="#info" class="text-gray-400 hover:text-white transition-all text-sm flex items-center group"><span class="w-0 group-hover:w-2 h-0.5 bg-pala mr-0 group-hover:mr-2 transition-all"></span>Panduan Wisata</a></li>
            <li><Link href="/terms" class="text-gray-400 hover:text-white transition-all text-sm flex items-center group"><span class="w-0 group-hover:w-2 h-0.5 bg-pala mr-0 group-hover:mr-2 transition-all"></span>Syarat & Ketentuan</Link></li>
          </ul>
        </div>
        
        <div>
          <h3 class="text-lg font-semibold mb-6 text-gray-100 uppercase tracking-widest text-xs">Hubungi Kami</h3>
          <ul class="space-y-4">
            <li v-if="settings?.footer_address" class="flex items-start group">
              <span class="p-2 bg-gray-800 rounded-lg group-hover:bg-pala/20 transition-colors mr-3 text-pala">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              </span>
              <span class="text-gray-400 text-sm leading-relaxed">{{ settings.footer_address }}</span>
            </li>
            <li v-if="settings?.footer_phone" class="flex items-center group">
              <span class="p-2 bg-gray-800 rounded-lg group-hover:bg-pala/20 transition-colors mr-3 text-pala">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
              </span>
              <span class="text-gray-400 text-sm">{{ settings.footer_phone }}</span>
            </li>
            <li v-if="settings?.footer_email" class="flex items-center group">
              <span class="p-2 bg-gray-800 rounded-lg group-hover:bg-pala/20 transition-colors mr-3 text-pala">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
              </span>
              <span class="text-gray-400 text-sm whitespace-nowrap">{{ settings.footer_email }}</span>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="border-t border-gray-800/50 pt-8 flex flex-col md:flex-row justify-between items-center bg-transparent">
        <p class="text-gray-500 text-xs text-center md:text-left mb-6 md:mb-0 tracking-wide uppercase">
          &copy; {{ new Date().getFullYear() }} {{ settings?.footer_copyright }}
        </p>
        <div class="flex space-x-4">
          <a v-if="settings?.social_fb && settings.social_fb !== '#'" :href="settings.social_fb" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pala hover:text-white transition-all transform hover:-translate-y-1 shadow-lg shadow-black/20">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
          </a>
          <a v-if="settings?.social_ig && settings.social_ig !== '#'" :href="settings.social_ig" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pala hover:text-white transition-all transform hover:-translate-y-1 shadow-lg shadow-black/20">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.981 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a v-if="settings?.social_tw && settings.social_tw !== '#'" :href="settings.social_tw" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pala hover:text-white transition-all transform hover:-translate-y-1 shadow-lg shadow-black/20">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  settings: Object
});
</script>
