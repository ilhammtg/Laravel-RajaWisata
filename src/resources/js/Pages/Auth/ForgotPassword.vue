<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Lupa Kata Sandi" />

    <div class="min-h-screen flex flex-col items-center justify-center bg-pala-light px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="bg-hero-aceh px-8 pt-10 pb-8 text-center">
                    <Link href="/" class="inline-block mb-3">
                        <span class="text-white text-3xl font-extrabold tracking-tight">Raja Wisata</span>
                    </Link>
                    <p class="text-pala-light text-sm">Aceh Selatan</p>
                    <h1 class="text-white text-xl font-bold mt-4">Lupa Kata Sandi?</h1>
                    <p class="text-pala-light text-sm mt-1">Jangan khawatir, kami akan membantu Anda</p>
                </div>

                <div class="px-8 py-8">
                    <div v-if="status" class="mb-5 p-4 rounded-lg bg-pala-light border border-pala text-pala-dark text-sm font-semibold">
                        {{ status }}
                    </div>

                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Masukkan alamat email Anda di bawah ini dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                    </p>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition text-sm"
                                placeholder="nama@email.com"
                                required
                                autofocus
                            />
                            <div v-if="form.errors.email" class="mt-2 text-red-500 text-xs font-medium">
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-pala hover:bg-pala-dark disabled:bg-pala-light text-white font-bold py-3 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2"
                        >
                            <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            {{ form.processing ? 'Memproses...' : 'Kirim Tautan Atur Ulang' }}
                        </button>
                    </form>

                    <p class="text-center text-sm text-gray-500 mt-6">
                        <Link href="/login" class="text-pala font-semibold hover:text-pala-dark flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Masuk
                        </Link>
                    </p>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="text-xs text-gray-400">
                    &copy; {{ new Date().getFullYear() }} Raja Wisata. Seluruh hak cipta dilindungi.
                </p>
            </div>
        </div>
    </div>
</template>
