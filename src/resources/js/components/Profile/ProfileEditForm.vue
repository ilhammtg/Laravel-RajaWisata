<template>
  <div class="max-w-4xl mx-auto space-y-12">
    <!-- Profile Information Card -->
    <div class="bg-white rounded-[3rem] p-8 lg:p-12 shadow-sm border border-gray-100 overflow-hidden relative">
      <div class="absolute top-0 right-0 w-64 h-64 bg-pala/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
      
      <div class="relative z-10 flex flex-col md:flex-row gap-12 items-start">
        <!-- Avatar Section -->
        <div class="flex-shrink-0 flex flex-col items-center gap-6">
          <div class="relative group">
            <div class="w-40 h-40 lg:w-48 lg:h-48 rounded-[3rem] bg-gradient-to-br from-pala to-indigo-600 p-1 shadow-2xl overflow-hidden">
              <div class="w-full h-full bg-white rounded-[2.8rem] flex items-center justify-center overflow-hidden">
                <img v-if="avatarPreview" :src="avatarPreview" class="w-full h-full object-cover" />
                <div v-else class="text-6xl font-black text-pala">
                   {{ user.name.charAt(0) }}
                </div>
              </div>
            </div>
            
            <label class="absolute -bottom-2 -right-2 bg-gray-900 text-white p-4 rounded-3xl border-4 border-white shadow-xl cursor-pointer hover:bg-pala hover:rotate-12 transition-all">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
              <input type="file" @change="handleAvatarChange" class="hidden" accept="image/*" />
            </label>
          </div>
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Rasio 1:1, Maksimal 2MB</p>
        </div>

        <!-- Info Form -->
        <form @submit.prevent="updateProfile" class="flex-grow space-y-8 w-full">
          <div>
            <h2 class="text-3xl font-black text-gray-900 italic mb-2 tracking-tight">Identitas Wisatawan</h2>
            <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Informasi dasar akun Anda</p>
          </div>

          <div class="grid grid-cols-1 gap-6">
            <div class="space-y-2">
              <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
              <input v-model="form.name" type="text" 
                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-gray-900 font-bold focus:ring-2 focus:ring-pala transition-all" 
                placeholder="Ex: Teuku Wisata" />
              <div v-if="form.errors.name" class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-1">{{ form.errors.name }}</div>
            </div>

            <div class="space-y-2">
              <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
              <input v-model="form.email" type="email" 
                class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-gray-900 font-bold focus:ring-2 focus:ring-pala transition-all" 
                placeholder="user@example.com" />
              <div v-if="form.errors.email" class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-1">{{ form.errors.email }}</div>
            </div>
          </div>

          <div class="flex items-center gap-4 pt-4">
             <button :disabled="form.processing" type="submit" class="bg-gray-900 text-white px-8 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-pala transition-all shadow-xl shadow-black/10 disabled:opacity-50">
                Simpan Perubahan
             </button>
             <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="form.recentlySuccessful" class="text-emerald-500 text-[10px] font-black uppercase tracking-widest">Tersimpan ✨</p>
             </Transition>
          </div>
        </form>
      </div>
    </div>

    <!-- Password Change Card -->
    <div class="bg-gray-50 rounded-[3rem] p-8 lg:p-12 border border-gray-100 shadow-inner">
      <form @submit.prevent="updatePassword" class="max-w-xl space-y-8">
        <div>
           <h2 class="text-2xl font-black text-gray-900 italic mb-2 tracking-tight">Keamanan Akun</h2>
           <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Ganti kata sandi secara berkala</p>
        </div>

        <div class="space-y-6">
          <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kata Sandi Saat Ini</label>
            <input v-model="passwordForm.current_password" type="password" 
              class="w-full bg-white border-none rounded-2xl px-6 py-4 text-gray-900 font-bold focus:ring-2 focus:ring-pala shadow-sm transition-all" />
            <div v-if="passwordForm.errors.current_password" class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-1">{{ passwordForm.errors.current_password }}</div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kata Sandi Baru</label>
            <input v-model="passwordForm.password" type="password" 
              class="w-full bg-white border-none rounded-2xl px-6 py-4 text-gray-900 font-bold focus:ring-2 focus:ring-pala shadow-sm transition-all" />
            <div v-if="passwordForm.errors.password" class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-1">{{ passwordForm.errors.password }}</div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Kata Sandi Baru</label>
            <input v-model="passwordForm.password_confirmation" type="password" 
              class="w-full bg-white border-none rounded-2xl px-6 py-4 text-gray-900 font-bold focus:ring-2 focus:ring-pala shadow-sm transition-all" />
            <div v-if="passwordForm.errors.password_confirmation" class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-1">{{ passwordForm.errors.password_confirmation }}</div>
          </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
           <button :disabled="passwordForm.processing" type="submit" class="bg-gray-900 text-white px-8 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-pala transition-all shadow-xl shadow-black/10 disabled:opacity-50">
              Ganti Kata Sandi
           </button>
           <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <p v-if="passwordForm.recentlySuccessful" class="text-emerald-500 text-[10px] font-black uppercase tracking-widest">Kata Sandi Diperbarui ✨</p>
           </Transition>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const user = usePage().props.auth.user;
const avatarPreview = ref(user.avatar_url);

const form = useForm({
  _method: 'POST',
  name: user.name,
  email: user.email,
  avatar: null,
});

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const handleAvatarChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.avatar = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      avatarPreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const updateProfile = () => {
    form.post(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Success toast is handled automatically by layout's watch on flash
        }
    });
};

const updatePassword = () => {
    passwordForm.post(route('profile.password'), {
        preserveScroll: true,
        onSuccess: () => {
            passwordForm.reset();
        }
    });
};
</script>
