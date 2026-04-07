import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('auth_token') || null,
        user: JSON.parse(localStorage.getItem('auth_user') || 'null'),
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        isAdmin: (state) => state.user?.role === 'administrator',
        isUser: (state) => state.user?.role === 'user',
    },

    actions: {
        async login(email, password) {
            const response = await axios.post('/api/login', { email, password });
            this._saveSession(response.data);
            return response.data;
        },

        async register(name, email, password, passwordConfirmation) {
            const response = await axios.post('/api/register', {
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            });
            this._saveSession(response.data);
            return response.data;
        },

        async logout() {
            try {
                await axios.post('/api/logout', {}, {
                    headers: { Authorization: `Bearer ${this.token}` },
                });
            } finally {
                this._clearSession();
            }
        },

        _saveSession(data) {
            this.token = data.access_token;
            this.user = data.user;
            localStorage.setItem('auth_token', data.access_token);
            localStorage.setItem('auth_user', JSON.stringify(data.user));
            // Set axios default header for all future requests
            axios.defaults.headers.common['Authorization'] = `Bearer ${data.access_token}`;
        },

        _clearSession() {
            this.token = null;
            this.user = null;
            localStorage.removeItem('auth_token');
            localStorage.removeItem('auth_user');
            delete axios.defaults.headers.common['Authorization'];
        },

        // Restore axios header on app boot if token already in storage
        initializeAuth() {
            if (this.token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            }
        },
    },
});
