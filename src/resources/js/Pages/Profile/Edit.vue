<template>
  <TravelerProfileLayout v-if="$page.props.auth.user.role === 'user'" 
    :stats="{ favorites: favorites_count, reviews: reviews_count }"
  >
    <Head title="Pengaturan Profil" />
    <ProfileEditForm />
  </TravelerProfileLayout>

  <AdminLayout v-else>
    <Head title="Pengaturan Profil Admin" />
    <div class="p-6">
       <ProfileEditForm />
    </div>
  </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import TravelerProfileLayout from '@/Layouts/TravelerProfileLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProfileEditForm from '@/components/Profile/ProfileEditForm.vue';

defineProps({
    favorites_count: Number,
    reviews_count: Number,
});
</script>
