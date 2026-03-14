<template>
  <aside 
    :class="[
      props.isOpen ? 'translate-x-0' : '-translate-x-full',
      'fixed inset-y-0 left-0 z-40 w-72 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-2xl'
    ]"
  >
    <div class="h-full flex flex-col">
      <!-- Logo Section -->
      <div class="flex items-center justify-between h-20 px-8 bg-black/20">
        <div class="flex items-center gap-2">
          <div class="p-1.5 bg-pala rounded-lg shadow-lg shadow-pala/20">
             <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2 2 2 0 012 2v.65M18 20.41L18 18a2 2 0 00-2-2v-1a2 2 0 012-2 2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v.341C3 9.761 3.344 10.5 4.5 10.5" />
             </svg>
          </div>
          <span class="text-xl font-bold tracking-tight">Raja<span class="text-pala">Wisata</span></span>
        </div>
        <button @click="$emit('close')" class="lg:hidden p-2 rounded-md hover:bg-white/10 transition-colors">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">
        <template v-for="item in navigation" :key="item.name">
          <Link
            :href="item.href"
            :class="[
              isActive(item.routePattern)
                ? 'bg-pala text-white shadow-lg shadow-pala/20'
                : 'text-gray-400 hover:bg-white/5 hover:text-white',
              'group flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-300 transform active:scale-[0.98]'
            ]"
          >
            <div 
              v-html="item.icon" 
              :class="[
                isActive(item.routePattern) ? 'text-white' : 'text-gray-500 group-hover:text-pala',
                'mr-3 h-5 w-5 transition-colors duration-300 flex items-center justify-center'
              ]" 
            ></div>
            {{ item.name }}
          </Link>
        </template>
      </nav>

      <!-- Footer Section -->
      <div class="p-6 border-t border-white/5 bg-black/10">
        <Link :href="route('profile.edit')" class="flex items-center gap-3 mb-4 group cursor-pointer">
           <div class="h-10 w-10 rounded-full bg-pala font-bold overflow-hidden shadow-lg shadow-pala/30">
              <img v-if="$page.props.auth.user.avatar_url" :src="$page.props.auth.user.avatar_url" class="w-full h-full object-cover" />
              <div v-else class="w-full h-full flex items-center justify-center text-white">
                 {{ $page.props.auth.user.name.charAt(0) }}
              </div>
           </div>
           <div class="overflow-hidden">
             <p class="text-sm font-bold text-white truncate group-hover:text-pala transition-colors">{{ $page.props.auth.user.name }}</p>
             <p class="text-xs text-gray-500 truncate">{{ $page.props.auth.user.email }}</p>
           </div>
        </Link>
        <p class="text-[10px] text-gray-600 font-medium uppercase tracking-widest text-center">
          v1.0.2-prod &bull; Aceh Selatan
        </p>
      </div>
    </div>
  </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
const props = defineProps({
  isOpen: Boolean
});

defineEmits(['close']);

const navigation = computed(() => [
  { 
    name: 'Dashboard', 
    href: route('admin.dashboard'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>', 
    routePattern: 'admin.dashboard' 
  },
  { 
    name: 'Destinasi', 
    href: route('admin.destinations.index'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-10.5v.114c0 .113-.032.224-.091.321L13.5 7.125c-.147.245-.342.451-.572.603L10.5 9.114c-.059.097-.091.208-.091.321v.114m.015 10.5l-3.32-3.32c-.052-.052-.082-.122-.082-.194v-.42a.5.5 0 011 0v.42c0 .013.005.025.014.034l3.32 3.32c.052.052.122.082.194.082h.42a.5.5 0 000-1h-.42c-.013 0-.025-.005-.034-.014L10.5 15.015V6.75m0 0a3 3 0 10-6 0v10.5m15-10.5v10.5m0 0a3 3 0 10-6 0v-10.5m6 10.5h-6m6-10.5h-6" /></svg>', 
    routePattern: 'admin.destinations.*' 
  },
  { 
    name: 'Penginapan', 
    href: route('admin.hotels.index'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21V6.75m6.75 14.25V6.75M4.5 8.25a.75.75 0 01.75-.75h13.5a.75.75 0 01.75.75v11.25a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V8.25zm0 11.25H21" /></svg>', 
    routePattern: 'admin.hotels.*' 
  },
  { 
    name: 'Kuliner', 
    href: route('admin.culinaries.index'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.651V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .414.336.75.75.75z" /></svg>', 
    routePattern: 'admin.culinaries.*' 
  },
  { 
    name: 'Event', 
    href: route('admin.events.index'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>', 
    routePattern: 'admin.events.*' 
  },
  { 
    routePattern: 'admin.settings.*' 
  },
  { 
    name: 'Profil Saya', 
    href: route('profile.edit'), 
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>', 
    routePattern: 'profile.edit'
  },
]);

const isActive = (pattern) => {
  if (pattern.endsWith('*')) {
    return route().current(pattern);
  }
  return route().current() === pattern;
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}
</style>
