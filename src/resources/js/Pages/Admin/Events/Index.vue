<template>
  <AdminLayout>
    <Head title="Manajemen Event" />
    
    <div class="space-y-8">
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
           <h1 class="text-3xl font-extrabold text-gray-900">Manajemen Event</h1>
           <p class="text-gray-500 font-medium">Atur kalender kegiatan dan festival budaya.</p>
        </div>
        <Link :href="route('admin.events.create')" class="inline-flex items-center px-6 py-3 bg-pala text-white font-bold rounded-full shadow-lg shadow-pala/20 hover:bg-pala-dark transition-all transform active:scale-95 text-sm uppercase tracking-widest">
          + Tambah Event
        </Link>
      </div>

      <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left">
            <thead>
              <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-widest font-bold">
                <th class="px-8 py-5">Event & Preview</th>
                <th class="px-8 py-5">Tanggal</th>
                <th class="px-8 py-5 text-center">Featured</th>
                <th class="px-8 py-5 text-center">Status</th>
                <th class="px-8 py-5 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              <tr v-for="event in events" :key="event.id" class="hover:bg-gray-50/50 transition-colors group">
                <td class="px-8 py-5">
                   <div class="flex items-center gap-4">
                      <div class="relative h-14 w-20 shrink-0 overflow-hidden rounded-xl bg-gray-100 shadow-sm border border-gray-100">
                         <img :src="event.image_url" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                      </div>
                      <div class="font-bold text-gray-900 line-clamp-1">{{ event.name }}</div>
                   </div>
                </td>
                <td class="px-8 py-5">
                   <div class="text-sm font-bold text-gray-700">{{ event.date }}</div>
                   <div class="text-[10px] text-gray-400 font-medium italic truncate max-w-[150px]">{{ event.location }}</div>
                </td>
                <td class="px-8 py-5 text-center">
                   <span v-if="event.is_featured" class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest inline-flex items-center gap-1">
                     ⭐ Featured
                   </span>
                   <span v-else class="text-gray-300 text-[10px] font-black uppercase tracking-widest">-</span>
                </td>
                <td class="px-8 py-5 text-center">
                  <span :class="[event.is_active ? 'bg-pala/10 text-pala' : 'bg-red-50 text-red-500', 'px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest inline-block whitespace-nowrap']">
                    {{ event.is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
                </td>
                <td class="px-8 py-5 text-right">
                   <div class="flex items-center justify-end gap-2">
                      <Link :href="route('admin.events.edit', event.id)" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                         </svg>
                      </Link>
                      <button @click="deleteItem(event.id)" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all transform hover:scale-110">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                         </svg>
                      </button>
                   </div>
                </td>
              </tr>
              <tr v-if="events.length === 0">
                 <td colspan="5" class="px-8 py-20 text-center">
                    <div class="flex flex-col items-center gap-4 text-gray-400">
                       <div class="p-6 bg-gray-50 rounded-full text-4xl">📅</div>
                       <p class="font-bold">Belum ada event yang direncanakan.</p>
                       <Link :href="route('admin.events.create')" class="text-pala hover:underline font-bold text-sm">Mulai Tambah Event</Link>
                    </div>
                 </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router, Head } from '@inertiajs/vue3';

defineProps({
  events: Array,
});

const deleteItem = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus event ini?')) {
        router.delete(route('admin.events.destroy', id));
    }
};
</script>
