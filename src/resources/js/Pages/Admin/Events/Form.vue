<template>
  <AdminLayout>
    <Head :title="event ? 'Edit Event' : 'Tambah Event'" />
    
    <div class="max-w-4xl mx-auto space-y-8 pb-20">
      <div class="flex items-center gap-4">
        <Link :href="route('admin.events.index')" class="p-2 bg-white rounded-xl shadow-sm border border-gray-100 text-gray-400 hover:text-pala transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </Link>
        <div>
           <h1 class="text-3xl font-extrabold text-gray-900">{{ event ? 'Edit' : 'Tambah' }} Event</h1>
           <p class="text-gray-500 font-medium">Atur detail kegiatan atau festival untuk menarik pengunjung.</p>
        </div>
      </div>

      <form @submit.prevent="submit" class="space-y-8">
        <!-- Main Info Card -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
           <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
             <h3 class="font-bold text-gray-900 flex items-center gap-2">
               <span class="p-2 bg-pala/10 rounded-lg text-pala">📅</span> Detail Kegiatan
             </h3>
           </div>
           <div class="p-8 space-y-6">
              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Nama Event</label>
                <input v-model="form.name" type="text" required class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm font-medium" placeholder="Contoh: Festival Danau Laut Tawar">
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                  <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Tanggal Pelaksanaan</label>
                  <input v-model="form.date" type="date" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm">
                </div>
                <div>
                  <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Waktu / Jam</label>
                  <input v-model="form.time" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="e.g. 08:00 - Selesai">
                </div>
                <div>
                  <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Kategori Event</label>
                  <input v-model="form.category" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="Contoh: Budaya, Olahraga">
                </div>
              </div>

              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Lokasi Spesifik</label>
                <input v-model="form.location" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="Contoh: Lapangan Merdeka, Tapaktuan">
              </div>

              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Ringkasan Event</label>
                <textarea v-model="form.description" rows="3" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="Gambarkan event ini secara singkat..."></textarea>
              </div>

              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Detail Konten Event</label>
                <textarea v-model="form.details" rows="8" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="Berikan informasi lengkap, jadwal, pengisi acara, dll..."></textarea>
                <p v-if="form.errors.details" class="text-xs text-red-500 mt-2 font-bold uppercase tracking-widest">{{ form.errors.details }}</p>
              </div>
           </div>
        </section>

        <!-- Media Card -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
           <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
             <h3 class="font-bold text-gray-900 flex items-center gap-2">
               <span class="p-2 bg-indigo-50 rounded-lg text-indigo-600">🖼️</span> Media Poster
             </h3>
           </div>
           <div class="p-8 space-y-8">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                 <div class="space-y-4">
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Upload Flyer/Poster</label>
                    <div class="relative group">
                       <input @input="form.image = $event.target.files[0]" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                       <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center group-hover:border-pala group-hover:bg-pala/5 transition-all duration-300">
                          <div class="text-3xl mb-2">🎨</div>
                          <p class="text-sm font-bold text-gray-500">Pilih file atau tarik ke sini</p>
                          <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">JPG, PNG, WEBP (Max 2MB)</p>
                       </div>
                    </div>
                    <div v-if="form.image" class="p-3 bg-pala/10 border border-pala/20 rounded-xl flex items-center gap-3 text-sm">
                       <span class="text-pala">✔️</span>
                       <span class="font-bold text-pala-dark truncate">{{ form.image.name }}</span>
                    </div>
                 </div>
                 
                 <div class="space-y-4">
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Atau Link URL Poster</label>
                    <input v-model="form.image_url" type="text" placeholder="https://..." class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm">
                    <p class="text-[10px] text-gray-400 font-medium italic">*Upload file akan memprioritaskan penyimpanan lokal.</p>
                 </div>
              </div>

              <div v-if="event?.image_url" class="pt-6 border-t border-gray-50">
                  <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Poster Saat Ini</p>
                  <div class="relative w-full max-w-sm aspect-[3/4] rounded-3xl overflow-hidden border border-gray-100 shadow-xl group mx-auto">
                      <img :src="event.image_url" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Event Poster Preview">
                  </div>
              </div>
           </div>
        </section>

        <!-- Gallery Section Card -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
           <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
             <h3 class="font-bold text-gray-900 flex items-center gap-2">
               <span class="p-2 bg-amber-50 rounded-lg text-amber-600">🎑</span> Galeri Foto Tambahan
             </h3>
           </div>
           <div class="p-8 space-y-8">
              <div class="border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center hover:border-amber-400 hover:bg-amber-50/30 transition-all cursor-pointer relative group">
                 <input @input="handleGalleryFiles" type="file" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                 <div class="text-4xl mb-3">📸</div>
                 <p class="text-sm font-bold text-gray-600">Klik untuk tambah foto galeri</p>
                 <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Bisa pilih banyak file sekaligus</p>
              </div>

              <!-- New Gallery Files Previews -->
              <div v-if="form.gallery_files.length > 0" class="space-y-4">
                 <p class="text-[10px] font-black text-amber-600 uppercase tracking-[0.2em]">Foto Baru Akan Ditambahkan:</p>
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div v-for="(file, index) in form.gallery_files" :key="index" class="relative group aspect-square rounded-2xl overflow-hidden border border-amber-100">
                       <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                       <button @click.prevent="removeGalleryFile(index)" class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                       </button>
                    </div>
                 </div>
              </div>

              <!-- Existing Gallery URLs -->
              <div v-if="form.gallery_urls.length > 0" class="space-y-4 pt-6 border-t border-gray-50">
                 <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Galeri Saat Ini:</p>
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div v-for="(url, index) in form.gallery_urls" :key="index" class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100">
                       <img :src="url" class="w-full h-full object-cover">
                       <button @click.prevent="removeGalleryUrl(index)" class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                       </button>
                    </div>
                 </div>
              </div>
           </div>
        </section>

        <!-- Maps Integration Card -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
           <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
             <h3 class="font-bold text-gray-900 flex items-center gap-2">
               <span class="p-2 bg-emerald-50 rounded-lg text-emerald-600">❓</span> Lokasi Peta
             </h3>
           </div>
           <div class="p-8 space-y-6">
              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Link Google Maps (Navigasi)</label>
                <input v-model="form.location_url" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm" placeholder="https://maps.app.goo.gl/...">
              </div>

              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Iframe Embed Code</label>
                <textarea v-model="form.map_iframe" rows="4" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm font-mono" placeholder="<iframe src='...' ...></iframe>"></textarea>
              </div>
           </div>
        </section>

        <!-- Config Card -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
           <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
             <h3 class="font-bold text-gray-900 flex items-center gap-2">
               <span class="p-2 bg-rose-50 rounded-lg text-rose-600">⚙️</span> Pengaturan Publikasi
             </h3>
           </div>
           <div class="p-8">
              <div class="flex flex-wrap items-center gap-10">
                 <label class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                       <input v-model="form.is_active" type="checkbox" class="sr-only">
                       <div :class="[form.is_active ? 'bg-pala' : 'bg-gray-200', 'w-12 h-6 rounded-full transition-colors duration-300']"></div>
                       <div :class="[form.is_active ? 'translate-x-6' : 'translate-x-0', 'absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300']"></div>
                    </div>
                    <div>
                       <span class="block text-sm font-black uppercase tracking-widest" :class="form.is_active ? 'text-pala' : 'text-gray-400'">Aktifkan</span>
                       <span class="text-[10px] text-gray-400 font-medium whitespace-nowrap">Event dapat dilihat publik</span>
                    </div>
                 </label>

                 <label class="flex items-center gap-3 cursor-pointer group border-l border-gray-100 pl-10">
                    <div class="relative">
                       <input v-model="form.is_featured" type="checkbox" class="sr-only">
                       <div :class="[form.is_featured ? 'bg-indigo-500' : 'bg-gray-200', 'w-12 h-6 rounded-full transition-colors duration-300']"></div>
                       <div :class="[form.is_featured ? 'translate-x-6' : 'translate-x-0', 'absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300']"></div>
                    </div>
                    <div>
                       <span class="block text-sm font-black uppercase tracking-widest" :class="form.is_featured ? 'text-indigo-500' : 'text-gray-400'">Unggulan</span>
                       <span class="text-[10px] text-gray-400 font-medium whitespace-nowrap">Tandai sebagai event spesial</span>
                    </div>
                 </label>

                 <div class="flex-1 flex justify-end gap-4 min-w-[200px]">
                    <div class="w-32">
                       <label class="block font-bold text-gray-400 uppercase tracking-widest text-[9px] mb-1">Urutan Simpan</label>
                       <input v-model="form.order" type="number" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 text-sm font-black">
                    </div>
                 </div>
              </div>
           </div>
        </section>

        <!-- Action Area -->
        <div class="flex items-center justify-end gap-4 pt-4">
           <Link :href="route('admin.events.index')" class="px-8 py-4 text-sm font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">Batal</Link>
           <button 
             type="submit" 
             :disabled="form.processing" 
             class="px-12 py-4 bg-pala text-white font-black rounded-2xl shadow-xl shadow-pala/20 hover:bg-pala-dark transition-all transform active:scale-95 disabled:opacity-50 uppercase tracking-widest text-xs"
           >
             {{ form.processing ? 'Lagi Proses...' : (event ? 'Simpan Perubahan' : 'Terbitkan Event') }}
           </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
  event: Object,
});

const form = useForm({
  _method: props.event ? 'PUT' : 'POST',
  name: props.event?.name ?? '',
  description: props.event?.description ?? '',
  details: props.event?.details ?? '',
  date: props.event?.date ? new Date(props.event.date).toISOString().split('T')[0] : '',
  time: props.event?.time ?? '',
  location: props.event?.location ?? '',
  location_url: props.event?.location_url ?? '',
  map_iframe: props.event?.map_iframe ?? '',
  category: props.event?.category ?? '',
  image: null,
  image_url: props.event?.image_url ?? '',
  gallery_files: [],
  gallery_urls: props.event?.gallery ?? [],
  is_featured: props.event?.is_featured ?? false,
  is_active: props.event?.is_active ?? true,
  order: props.event?.order ?? 0,
});

const handleGalleryFiles = (e) => {
    const files = Array.from(e.target.files);
    form.gallery_files = [...form.gallery_files, ...files];
};

const removeGalleryFile = (index) => {
    form.gallery_files.splice(index, 1);
};

const removeGalleryUrl = (index) => {
    form.gallery_urls.splice(index, 1);
};

const submit = () => {
    if (props.event) {
        form.post(window.route('admin.events.update', props.event.id), {
            forceFormData: true,
        });
    } else {
        form.post(window.route('admin.events.store'), {
            forceFormData: true,
        });
    }
};
</script>
