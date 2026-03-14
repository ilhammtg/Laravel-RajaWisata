<template>
  <AdminLayout>
    <Head title="Pengaturan Sistem" />
    <div class="max-w-5xl mx-auto space-y-10">
      <div class="flex items-center justify-between">
        <div>
           <h1 class="text-3xl font-extrabold text-gray-900">Pengaturan Sistem</h1>
           <p class="text-gray-500 font-medium mt-1">Kelola seluruh konten dinamis website Anda dari satu tempat.</p>
        </div>
      </div>

      <form @submit.prevent="submit" class="space-y-8">
        <!-- Section: Informasi Utama -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
              <span class="p-2 bg-pala/10 rounded-lg text-pala text-xl">💡</span> Informasi Utama & Galeri
            </h3>
          </div>
          <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
              <div class="space-y-4">
                <div>
                  <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Sub-judul Utama</label>
                  <input v-model="form.info_subtitle" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                </div>
                <div>
                  <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Judul Utama</label>
                  <input v-model="form.info_title" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                </div>
              </div>
              <div>
                <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Deskripsi Utama</label>
                <textarea v-model="form.info_description" rows="5" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required></textarea>
              </div>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div class="p-6 bg-gray-50/50 rounded-2xl border border-gray-100 space-y-4">
                 <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Fitur 1</h4>
                 <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Judul Fitur</label>
                    <input v-model="form.info_feature_1_title" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all text-sm p-3" required>
                 </div>
                 <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Deskripsi Fitur</label>
                    <textarea v-model="form.info_feature_1_desc" rows="3" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all text-sm p-3" required></textarea>
                 </div>
              </div>
              <div class="p-6 bg-gray-50/50 rounded-2xl border border-gray-100 space-y-4">
                 <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Fitur 2</h4>
                 <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Judul Fitur</label>
                    <input v-model="form.info_feature_1_title" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all text-sm p-3" required>
                 </div>
                 <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Deskripsi Fitur</label>
                    <textarea v-model="form.info_feature_1_desc" rows="3" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all text-sm p-3" required></textarea>
                 </div>
              </div>
            </div>

            <!-- Images & Button -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
               <div class="space-y-4">
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">URL Gambar Utama (Besar)</label>
                    <input v-model="form.info_image_1" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">URL Gambar Sekunder (Kecil)</label>
                    <input v-model="form.info_image_2" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
               </div>
               <div class="space-y-4">
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Teks Tombol Aksi</label>
                    <input v-model="form.info_button_text" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Link Tombol (URL/Anchor)</label>
                    <input v-model="form.info_button_link" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
               </div>
            </div>
          </div>
        </section>

        <!-- Section: Statistik & Sosial -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
           <!-- Statistics -->
           <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
             <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
               <h3 class="font-bold text-gray-900 flex items-center gap-2">
                 <span class="p-2 bg-indigo-50 rounded-lg text-indigo-600">📊</span> Statistik Perjalanan
               </h3>
             </div>
             <div class="p-8 grid grid-cols-2 gap-6">
               <div v-for="stat in ['destinations', 'culinary', 'events', 'service']" :key="stat" class="space-y-2">
                 <label class="block font-bold text-gray-400 uppercase tracking-widest text-[9px]">{{ stat }}</label>
                 <input v-model="form['stats_' + stat]" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3 font-bold" required>
               </div>
             </div>
           </section>

           <!-- Social Links -->
           <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
             <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
               <h3 class="font-bold text-gray-900 flex items-center gap-2">
                 <span class="p-2 bg-rose-50 rounded-lg text-rose-600">📱</span> Media Sosial
               </h3>
             </div>
             <div class="p-8 space-y-4">
               <div v-for="sc in ['fb', 'ig', 'tw']" :key="sc" class="flex items-center gap-4">
                  <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center font-black uppercase text-xs text-gray-400 shrink-0">{{ sc }}</div>
                  <input v-model="form['social_' + sc]" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
               </div>
             </div>
           </section>
        </div>

        <!-- Section: Footer Information -->
        <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
          <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 text-base">
            <h3 class="font-bold text-gray-900 flex items-center gap-2">
              <span class="p-2 bg-orange-50 rounded-lg text-orange-600">👣</span> Informasi Footer
            </h3>
          </div>
          <div class="p-8 space-y-6">
            <div>
              <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Tentang (About Text)</label>
              <textarea v-model="form.footer_about" rows="3" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
               <div class="space-y-4">
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Alamat Lengkap</label>
                    <input v-model="form.footer_address" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Nomor Telepon</label>
                    <input v-model="form.footer_phone" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
               </div>
               <div class="space-y-4">
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Email Support</label>
                    <input v-model="form.footer_email" type="email" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
                  <div>
                    <label class="block font-bold text-gray-700 mb-2 uppercase tracking-wider text-[10px]">Teks Hak Cipta (Copyright)</label>
                    <input v-model="form.footer_copyright" type="text" class="block w-full rounded-xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-3" required>
                  </div>
               </div>
            </div>
          </div>
        </section>

        <!-- Section: Content Rich (Terms & Guide) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
           <!-- Terms -->
           <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
             <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
               <h3 class="font-bold text-gray-900 flex items-center gap-2">
                 <span class="p-2 bg-purple-50 rounded-lg text-purple-600">⚖️</span> Syarat & Ketentuan
               </h3>
             </div>
             <div class="p-8">
               <textarea v-model="form.terms_content" rows="12" class="block w-full rounded-2xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-4 font-mono text-xs" required></textarea>
             </div>
           </section>

           <!-- Guide -->
           <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden text-sm">
             <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
               <h3 class="font-bold text-gray-900 flex items-center gap-2">
                 <span class="p-2 bg-amber-50 rounded-lg text-amber-600">📖</span> Panduan Wisata (PDF)
               </h3>
             </div>
             <div class="p-8">
               <textarea v-model="form.guide_content" rows="12" class="block w-full rounded-2xl border-gray-200 focus:border-pala focus:ring-pala transition-all p-4 font-mono text-xs" required></textarea>
             </div>
           </section>
        </div>

        <!-- Sticky Submit Area -->
        <div class="sticky bottom-8 z-20">
           <div class="bg-gray-900/90 backdrop-blur-md rounded-2xl p-4 shadow-2xl flex items-center justify-between border border-white/10">
              <div class="flex items-center gap-3 pl-4">
                 <div class="h-2 w-2 rounded-full bg-pala animate-pulse"></div>
                 <span class="text-white text-xs font-bold uppercase tracking-widest">Siap untuk disimpan</span>
              </div>
              <button 
                type="submit" 
                :disabled="form.processing" 
                class="px-10 py-4 bg-pala text-white font-black rounded-xl hover:bg-pala-dark transition-all transform active:scale-95 disabled:opacity-50 uppercase tracking-widest text-xs"
              >
                {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
              </button>
           </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
  settings: Object
});

const form = useForm({
  info_title: props.settings.info_title || '',
  info_subtitle: props.settings.info_subtitle || '',
  info_description: props.settings.info_description || '',
  
  footer_about: props.settings.footer_about || '',
  footer_address: props.settings.footer_address || '',
  footer_phone: props.settings.footer_phone || '',
  footer_email: props.settings.footer_email || '',
  footer_copyright: props.settings.footer_copyright || '',
  
  social_fb: props.settings.social_fb || '',
  social_ig: props.settings.social_ig || '',
  social_tw: props.settings.social_tw || '',
  
  stats_destinations: props.settings.stats_destinations || '',
  stats_culinary: props.settings.stats_culinary || '',
  stats_events: props.settings.stats_events || '',
  stats_service: props.settings.stats_service || '',
  
  terms_content: props.settings.terms_content || '',

  info_feature_1_title: props.settings.info_feature_1_title || '',
  info_feature_1_desc: props.settings.info_feature_1_desc || '',
  info_feature_2_title: props.settings.info_feature_2_title || '',
  info_feature_2_desc: props.settings.info_feature_2_desc || '',
  info_button_text: props.settings.info_button_text || '',
  info_button_link: props.settings.info_button_link || '',
  info_image_1: props.settings.info_image_1 || '',
  info_image_2: props.settings.info_image_2 || '',
  
  guide_content: props.settings.guide_content || '',
});

const submit = () => {
  form.post(window.route('admin.settings.update'));
};
</script>
