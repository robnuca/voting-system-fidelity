<template>
    <div class="flex flex-col items-center">
        <form @submit.prevent="login" class="w-full">
            <div class="mb-4">
                <input type="email" v-model="email" placeholder="Email" class="w-full px-3 py-2 border rounded" required>
                <p v-if="errors.email" class="text-red-500 text-xs mt-2">{{ errors.email[0] }}</p>
            </div>
            <div class="mb-4">
                <input type="password" v-model="password" placeholder="Password" class="w-full px-3 py-2 border rounded" required>
                <p v-if="errors.password" class="text-red-500 text-xs mt-2">{{ errors.password[0] }}</p>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</button>
            <div v-if="errors.general" class="text-red-500 text-xs mt-2">{{ errors.general }}</div>
            <div v-if="success" class="text-green-500 text-xs mt-2">{{ success }}</div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            errors: {},
            success: ''
        };
    },
    methods: {
        login() {
            console.log('Login method called');
            this.errors = {}; // Reset errors before making the request
            this.success = ''; // Reset success message before making the request
            this.$axios.post('/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                console.log('Login response:', response.data);
                this.success = 'Login successful!';
                this.$emit('login', response.data.token);
            }).catch(error => {
                if (error.response) {
                    console.log('Error response:', error.response.data);
                    console.error('Error status:', error.response.status);
                    console.error('Error headers:', error.response.headers);
                    if (error.response.status === 403) {
                        this.errors.general = 'Email not verified. Please check your email for the verification link.';
                    } else {
                        this.errors.general = error.response.data.message || 'Login failed. Please try again.';
                    }
                } else if (error.request) {
                    console.error('Error request:', error.request);
                    this.errors.general = 'No response received from the server. Please try again later.';
                } else {
                    console.error('Error message:', error.message);
                    this.errors.general = 'An unexpected error occurred. Please try again later.';
                }
            });
        }
    }
};
</script>
