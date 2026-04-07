<template>
  <Head title="Masuk ke Akun" />
  
  <div class="min-h-screen flex items-center justify-center bg-pala-light px-4">
    <div class="w-full max-w-md">
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-hero-aceh px-8 pt-10 pb-8 text-center">
          <Link href="/" class="inline-block mb-3">
            <span class="text-white text-3xl font-extrabold tracking-tight">Raja Wisata</span>
          </Link>
          <p class="text-pala-light text-sm">Aceh Selatan</p>
          <h1 class="text-white text-xl font-bold mt-4">Selamat Datang Kembali</h1>
          <p class="text-pala-light text-sm mt-1">Masuk ke akun Anda</p>
        </div>

        <div class="px-8 py-8">
          <div v-if="form.errors.email" class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <span>{{ form.errors.email }}</span>
          </div>

          <form @submit.prevent="submit" class="space-y-5">
            <div>
              <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                autocomplete="email"
                placeholder="contoh@email.com"
                :class="{'border-red-500': form.errors.email}"
                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition text-sm"
              />
            </div>

            <div>
              <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
              <div class="relative">
                <input
                  id="password"
                  v-model="form.password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                  autocomplete="current-password"
                  placeholder="Masukkan password"
                  class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition text-sm pr-11"
                />
                <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                  <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember" v-model="form.remember" type="checkbox" class="h-4 w-4 text-pala focus:ring-pala border-gray-200 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-500">Ingat saya</label>
              </div>
              <Link :href="route('password.request')" class="text-sm font-semibold text-pala hover:text-pala-dark">
                Lupa Password?
              </Link>
            </div>

            <button
              type="submit"
              :disabled="form.processing"
              class="w-full bg-pala hover:bg-pala-dark disabled:bg-pala-light text-white font-bold py-3 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2 mt-2"
            >
              <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
              {{ form.processing ? 'Memproses...' : 'Masuk' }}
            </button>
          </form>

          <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
              <span class="w-full border-t border-gray-200"></span>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
              <span class="bg-white px-2 text-gray-500 font-semibold">Atau</span>
            </div>
          </div>

          <a
            :href="route('google.login')"
            class="w-full flex items-center justify-center gap-3 bg-white border border-gray-200 text-gray-700 font-semibold py-3 rounded-lg hover:bg-gray-50 transition duration-200 shadow-sm"
          >
            <svg class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Masuk dengan Google
          </a>

          <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <Link href="/register" class="text-pala font-semibold hover:text-pala-dark ml-1">Daftar Sekarang</Link>
          </p>
        </div>
      </div>

      <div class="text-center mt-5">
        <Link href="/" class="text-sm text-gray-500 hover:text-pala transition flex items-center justify-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          Kembali ke Beranda
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const showPassword = ref(false);

// Menggunakan Inertia Form Helper (Jauh lebih ringan & otomatis)
const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
    preserveScroll: true,
  });
};
</script>