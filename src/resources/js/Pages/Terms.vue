<template>
  <Head title="Syarat & Ketentuan - Raja Wisata" />

  <div class="min-h-screen flex flex-col font-sans bg-gray-50">
    <Navbar />
    
    <main class="flex-grow pt-32 pb-20">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
          <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-100">
            Syarat & Ketentuan
          </h1>
          
          <div class="prose prose-pala max-w-none text-gray-600 leading-relaxed whitespace-pre-line">
            {{ terms_content }}
          </div>
          
          <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center text-sm text-gray-500">
            <span>Terakhir diperbarui: {{ new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</span>
            <Link href="/" class="text-pala font-bold hover:text-pala-dark">Kembali ke Beranda</Link>
          </div>
        </div>
      </div>
    </main>

    <Footer :settings="settings" />
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

defineProps({
  terms_content: String,
  settings: Object
});
</script>

<style scoped>
.prose-pala :deep(h1), .prose-pala :deep(h2), .prose-pala :deep(h3) {
  color: #064e3b;
  font-weight: 700;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
}
</style>
