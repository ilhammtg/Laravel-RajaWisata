<template>
  <RouterView />
</template>

<script setup>
import { useAuthStore } from './stores/auth';

// Restore axios Authorization header if the user has a saved token
const auth = useAuthStore();
auth.initializeAuth();
</script>
