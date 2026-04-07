<template>
  <Head title="Dashboard" />

  <div class="min-h-screen bg-pala-light">
    <header class="bg-white shadow-sm sticky top-0 z-40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <Link href="/" class="text-pala font-extrabold text-xl tracking-tight">
          Raja Wisata
        </Link>
        <div class="flex items-center gap-4">
          <span class="text-sm text-gray-500 hidden sm:block">
            Selamat datang, <span class="font-semibold text-gray-700">{{ user.name }}</span>
          </span>
          <button
            @click="handleLogout"
            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition border border-red-200"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Keluar
          </button>
        </div>
      </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
        <div class="bg-hero-aceh px-8 py-10 flex flex-col sm:flex-row items-center gap-6">
          <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
            <span class="text-white text-3xl font-extrabold">{{ initials }}</span>
          </div>
          <div class="text-center sm:text-left">
            <p class="text-pala-light text-sm uppercase tracking-widest font-semibold">Dashboard</p>
            <h1 class="text-white text-2xl md:text-3xl font-extrabold mt-1">{{ user.name }}</h1>
            <p class="text-pala-light text-sm mt-1">{{ user.email }}</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-start gap-4">
          <div :class="['w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0', isAdmin ? 'bg-purple-100' : 'bg-pala-light']">
            <svg :class="['w-6 h-6', isAdmin ? 'text-purple-600' : 'text-pala']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
          </div>
          <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Role</p>
            <p :class="['text-sm font-bold mt-1', isAdmin ? 'text-purple-700' : 'text-pala-dark']">
              {{ isAdmin ? 'Administrator' : 'User' }}
            </p>
            <p class="text-xs text-gray-400 mt-0.5">{{ isAdmin ? 'Akses penuh' : 'Akses standar' }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div class="min-w-0">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</p>
            <p class="text-sm font-bold text-gray-700 mt-1 truncate">{{ user.email }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Bergabung</p>
            <p class="text-sm font-bold text-gray-700 mt-1">{{ joinedDate }}</p>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center">
        <Link href="/" class="inline-flex items-center gap-2 text-sm text-pala hover:text-pala-dark font-semibold">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          Kembali ke Beranda
        </Link>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';

/**
 * OPTIMASI: Mengambil data user langsung dari properti Inertia global
 * Data ini otomatis tersedia jika HandleInertiaRequests middleware aktif
 */
const page = usePage();
const user = computed(() => page.props.auth.user);
const isAdmin = computed(() => user.value.role === 'administrator'); // Sesuaikan dengan field di DB kamu

const initials = computed(() => {
  const name = user.value?.name || '';
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
});

const joinedDate = computed(() => {
  if (!user.value?.created_at) return '-';
  return new Date(user.value.created_at).toLocaleDateString('id-ID', {
    day: 'numeric', month: 'long', year: 'numeric'
  });
});

function handleLogout() {
  // Gunakan router.post untuk logout agar sesuai dengan sistem keamanan CSRF Laravel
  router.post('/logout');
}
</script>