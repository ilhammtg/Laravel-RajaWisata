<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
});

const form = useForm({
    email: props.email,
    otp: '',
});

const submit = () => {
    form.post(route('verification.verify'));
};

const resendOtp = () => {
    form.post(route('verification.resend'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Verifikasi Email" />

    <div class="min-h-screen flex flex-col items-center justify-center bg-pala-light px-4 py-12">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center">
                <div class="bg-hero-aceh px-8 pt-10 pb-8">
                    <Link href="/" class="inline-block mb-3">
                        <span class="text-white text-3xl font-extrabold tracking-tight">Raja Wisata</span>
                    </Link>
                    <p class="text-pala-light text-sm">Aceh Selatan</p>
                    <h1 class="text-white text-xl font-bold mt-4">Verifikasi Email Anda</h1>
                    <p class="text-pala-light text-sm mt-1">Satu langkah lagi untuk memulai petualangan</p>
                </div>

                <div class="px-8 py-8">
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Kami telah mengirimkan 6 digit kode OTP ke email <span class="font-bold text-gray-700">{{ email }}</span>. Silakan masukkan kode tersebut di bawah ini.
                    </p>

                    <div v-if="$page.props.flash.status" class="mb-5 p-4 rounded-lg bg-pala-light border border-pala text-pala-dark text-sm font-semibold">
                        {{ $page.props.flash.status }}
                    </div>

                    <div v-if="$page.props.flash.warning" class="mb-5 p-4 rounded-lg bg-amber-50 border border-amber-500 text-amber-700 text-sm font-semibold text-left">
                        <div class="flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <span>Mode Developer</span>
                        </div>
                        {{ $page.props.flash.warning }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <input
                                id="otp"
                                type="text"
                                v-model="form.otp"
                                class="w-full text-center text-3xl font-bold tracking-[1em] px-4 py-4 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pala focus:border-transparent transition"
                                placeholder="······"
                                maxlength="6"
                                required
                                autofocus
                            />
                            <div v-if="form.errors.otp" class="mt-2 text-red-500 text-xs font-medium">
                                {{ form.errors.otp }}
                            </div>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full bg-pala hover:bg-pala-dark disabled:bg-pala-light text-white font-bold py-4 rounded-lg transition-all duration-200 text-sm flex items-center justify-center gap-2 shadow-lg shadow-pala/20"
                        >
                            <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            {{ form.processing ? 'Memverifikasi...' : 'Verifikasi Akun' }}
                        </button>
                    </form>

                    <div class="mt-8 text-sm text-gray-500">
                        Tidak menerima kode? 
                        <button 
                            @click="resendOtp" 
                            :disabled="form.processing"
                            class="text-pala font-bold hover:text-pala-dark underline ml-1"
                        >
                            Kirim ulang OTP
                        </button>
                    </div>

                    <p class="text-center text-sm text-gray-500 mt-6">
                        <Link href="/login" class="text-gray-400 hover:text-pala transition inline-flex items-center gap-1">
                            Salah memasukkan email? Kembali
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
