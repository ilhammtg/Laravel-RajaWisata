<template>
  <nav class="bg-white border-b border-gray-200 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <!-- Mobile Menu Button -->
          <button 
            @click="$emit('toggle-sidebar')"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 lg:hidden focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pala transition-all duration-300"
          >
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          
          <div class="flex items-center ml-4 lg:ml-0">
             <h2 class="text-sm sm:text-lg font-bold text-gray-900 truncate max-w-[150px] sm:max-w-none">{{ title }}</h2>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <!-- View Site Button -->
          <Link 
            href="/"
            class="hidden sm:inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300"
          >
            Lihat Website
          </Link>

          <!-- Profile Dropdown (Simplified for now) -->
          <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
            <div class="text-right hidden md:block">
              <p class="text-xs sm:text-sm font-bold text-gray-900 truncate">{{ $page.props.auth.user.name }}</p>
              <p class="text-[10px] text-gray-500 capitalize">{{ $page.props.auth.user.role || 'Admin' }}</p>
            </div>
            <button 
              @click="logout"
              class="p-2 rounded-full text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all duration-300"
              title="Keluar"
            >
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
  title: {
    type: String,
    default: 'Panel Admin'
  }
});

defineEmits(['toggle-sidebar']);

const logout = () => {
  router.post(route('logout'));
};
</script>
