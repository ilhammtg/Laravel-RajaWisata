<template>
  <Head title="Dashboard" />

  <AdminLayout>
    <div class="space-y-8">
      <!-- Welcome Section -->
      <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
          <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
            Selamat Datang, {{ $page.props.auth.user.name }}! 👋
          </h1>
          <p class="text-gray-500 font-medium">
            Kelola konten pariwisata Aceh Selatan dengan mudah dan efisien melalui panel kontrol Anda.
          </p>
        </div>
        <div class="flex gap-3">
           <Link :href="route('admin.destinations.create')" class="inline-flex items-center px-6 py-3 bg-pala text-white font-bold rounded-full shadow-lg shadow-pala/20 hover:bg-pala-dark transition-all transform hover:scale-105 active:scale-95">
              + Tambah Destinasi
           </Link>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="stat in dashboardStats" :key="stat.name" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 group hover:border-pala transition-colors duration-300">
          <div class="flex items-center justify-between mb-4">
            <div :class="[stat.color, 'p-3 rounded-xl transition-transform group-hover:scale-110 duration-300']">
              <div v-html="stat.icon" class="w-6 h-6 text-white text-center flex items-center justify-center"></div>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ stat.label }}</span>
          </div>
          <div class="flex items-end justify-between">
            <h3 class="text-3xl font-black text-gray-900">{{ stat.value }}</h3>
            <span class="text-xs font-bold text-pala bg-pala/10 px-2 py-1 rounded-lg">Total Unit</span>
          </div>
        </div>
      </div>

      <!-- Tables Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Destinations -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
              <h2 class="text-xl font-bold text-gray-900">Destinasi Terbaru</h2>
              <Link :href="route('admin.destinations.index')" class="text-sm font-bold text-pala hover:underline">Lihat Semua</Link>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left">
              <thead>
                <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-widest font-bold">
                  <th class="px-8 py-4">Nama Destinasi</th>
                  <th class="px-8 py-4">Lokasi</th>
                  <th class="px-8 py-4 text-center">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <tr v-for="dest in recent_destinations" :key="dest.id" class="hover:bg-gray-50/50 transition-colors">
                  <td class="px-8 py-5 font-bold text-gray-900 text-sm">{{ dest.name }}</td>
                  <td class="px-8 py-5 text-gray-500 text-sm">{{ dest.location }}</td>
                  <td class="px-8 py-5 text-center">
                    <span :class="[dest.is_active ? 'bg-pala/10 text-pala' : 'bg-gray-100 text-gray-500', 'px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest h-auto inline-block']">
                      {{ dest.is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Recent Culinaries -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
              <h2 class="text-xl font-bold text-gray-900">Kuliner Terbaru</h2>
              <Link :href="route('admin.culinaries.index')" class="text-sm font-bold text-pala hover:underline">Lihat Semua</Link>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left">
              <thead>
                <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-widest font-bold">
                  <th class="px-8 py-4">Nama Kuliner</th>
                  <th class="px-8 py-4">Kategori</th>
                  <th class="px-8 py-4 text-center">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <tr v-for="culinary in recent_culinaries" :key="culinary.id" class="hover:bg-gray-50/50 transition-colors">
                  <td class="px-8 py-5 font-bold text-gray-900 text-sm">{{ culinary.name }}</td>
                  <td class="px-8 py-5 text-gray-500 text-sm">{{ culinary.category }}</td>
                  <td class="px-8 py-5 text-center">
                    <span :class="[culinary.is_active ? 'bg-pala/10 text-pala' : 'bg-gray-100 text-gray-500', 'px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest h-auto inline-block']">
                      {{ culinary.is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  stats: Object,
  recent_destinations: Array,
  recent_culinaries: Array,
});

const dashboardStats = computed(() => [
  { 
    name: 'destinations', 
    label: 'Destinasi', 
    value: props.stats.destinations, 
    color: 'bg-pala',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>'
  },
  { 
    name: 'hotels', 
    label: 'Penginapan', 
    value: props.stats.hotels, 
    color: 'bg-indigo-600',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21V6.75m6.75 14.25V6.75M4.5 8.25a.75.75 0 01.75-.75h13.5a.75.75 0 01.75.75v11.25a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V8.25zm0 11.25H21" /></svg>'
  },
  { 
    name: 'events', 
    label: 'Event', 
    value: props.stats.events, 
    color: 'bg-rose-600',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>'
  },
  { 
    name: 'culinaries', 
    label: 'Kuliner', 
    value: props.stats.culinaries, 
    color: 'bg-amber-500',
    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>'
  },
]);
</script>
