<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Atur Ulang Kata Sandi" />

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
                    <h1 class="text-white text-xl font-bold mt-4">Atur Ulang Kata Sandi</h1>
                    <p class="text-pala-light text-sm mt-1">Gunakan kata sandi yang kuat dan aman</p>
                </div>

                <div class="px-8 py-8">
                    <form @submit.prevent="submit" class="space-y-5">
                        <input type="hidden" v-model="form.token" />
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed outline-none text-sm"
                                readonly
                            />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Kata Sandi Baru</label>
                            <input
                                id="password"
                                type="password"
                                v-model="form.password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition text-sm"
                                placeholder="Min. 8 karakter"
                                required
                                autofocus
                                autocomplete="new-password"
                            />
                            <div v-if="form.errors.password" class="mt-2 text-red-500 text-xs font-medium">
                                {{ form.errors.password }}
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Kata Sandi</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition text-sm"
                                placeholder="Ulangi kata sandi"
                                required
                                autocomplete="new-password"
                            />
                            <div v-if="form.errors.password_confirmation" class="mt-2 text-red-500 text-xs font-medium">
                                {{ form.errors.password_confirmation }}
                            </div>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-pala hover:bg-pala-dark disabled:bg-pala-light text-white font-bold py-3 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2"
                        >
                            <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            {{ form.processing ? 'Memproses...' : 'Perbarui Kata Sandi' }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="text-xs text-gray-400">
                    &copy; {{ new Date().getFullYear() }} Raja Wisata. Keamanan Anda adalah prioritas kami.
                </p>
            </div>
        </div>
    </div>
</template>
