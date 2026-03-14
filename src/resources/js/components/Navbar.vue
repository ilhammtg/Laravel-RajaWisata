<template>
  <nav :class="[
    'fixed w-full top-0 z-50 transition-all duration-300',
    isScrolled ? 'bg-white shadow-md text-gray-800' : 'bg-transparent text-white'
  ]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        <div class="flex-shrink-0 flex items-center">
          <Link href="/" class="text-2xl font-bold tracking-tight flex items-center gap-0">
            <span :class="isScrolled ? 'text-gray-900' : 'text-white'">Raja</span>
            <span class="text-pala">Wisata</span>
          </Link>
        </div>

        <div class="hidden md:flex flex-1 justify-center space-x-8">
          <a href="/#destinasi" @click="navigateToAnchor($event, '#destinasi')" class="hover:opacity-80 px-3 py-2 text-sm uppercase tracking-wider font-semibold transition">Destinasi</a>
          <a href="/#hotel" @click="navigateToAnchor($event, '#hotel')" class="hover:opacity-80 px-3 py-2 text-sm uppercase tracking-wider font-semibold transition">Penginapan</a>
          <a href="/#kuliner" @click="navigateToAnchor($event, '#kuliner')" class="hover:opacity-80 px-3 py-2 text-sm uppercase tracking-wider font-semibold transition">Kuliner</a>
          <a href="/#event" @click="navigateToAnchor($event, '#event')" class="hover:opacity-80 px-3 py-2 text-sm uppercase tracking-wider font-semibold transition">Event</a>
          <a href="/#info" @click="navigateToAnchor($event, '#info')" class="hover:opacity-80 px-3 py-2 text-sm uppercase tracking-wider font-semibold transition">Informasi</a>
        </div>

        <div class="hidden md:flex items-center space-x-3">
          <template v-if="$page.props.auth?.user">
            <Link href="/dashboard" :class="[
              'flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-300',
              isScrolled ? 'text-gray-700 hover:bg-gray-100' : 'text-white hover:bg-white/10'
            ]">
              <div :class="['w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold', isScrolled ? 'bg-pala text-white' : 'bg-white text-pala']">
                {{ $page.props.auth.user.name.charAt(0) }}
              </div>
              <span class="max-w-[100px] truncate">{{ $page.props.auth.user.name }}</span>
            </Link>
          </template>

          <template v-else>
            <Link href="/register" :class="[
              'px-4 py-2 rounded-full font-semibold text-sm transition-all duration-300',
              isScrolled ? 'text-pala hover:bg-pala-light' : 'text-white/80 hover:text-white hover:bg-white/10'
            ]">
              Daftar
            </Link>
            <Link href="/login" :class="[
              'px-5 py-2 rounded-full font-bold transition-all duration-300',
              isScrolled ? 'bg-pala text-white hover:bg-pala-dark' : 'bg-white text-pala hover:bg-spice-sand'
            ]">
              Masuk
            </Link>
          </template>
        </div>

        <div class="md:hidden flex items-center">
          <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="hover:opacity-80 focus:outline-none p-2 rounded-md">
            <svg v-if="!isMobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg v-else class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, router } from '@inertiajs/vue3'; // GANTI: Pakai Inertia Link & router
import { useAuthStore } from '../stores/auth';

const auth = useAuthStore();

const isMobileMenuOpen = ref(false);
const isScrolled = ref(false);

const initials = computed(() => {
  const name = auth.user?.name || '';
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
});

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

async function handleLogout() {
  router.post(route('logout')); 
}

const navigateToAnchor = (e, hash) => {
  // Hanya cegah default jika sedang di home page
  if (window.location.pathname === '/' || window.location.pathname === '') {
    const id = hash.startsWith('/#') ? hash.substring(2) : hash.substring(1);
    const element = document.getElementById(id);
    if (element) {
      e.preventDefault();
      element.scrollIntoView({ behavior: 'smooth' });
      history.pushState(null, null, hash);
      isMobileMenuOpen.value = false;
    }
  }
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>