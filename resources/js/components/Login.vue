<template>
    <div class="flex flex-col items-center">
        <form @submit.prevent="login" class="w-full">
            <div class="mb-4">
                <input type="email" v-model="email" placeholder="Email" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <input type="password" v-model="password" placeholder="Password" class="w-full px-3 py-2 border rounded" required>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        login() {
            console.log('Login method called');
            this.$axios.post('/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                console.log('Login response:', response.data);
                this.$emit('login', response.data.token);
            }).catch(error => {
                if (error.response) {
                    console.log('Error response:', error.response.data);
                    console.error('Error status:', error.response.status);
                    console.error('Error headers:', error.response.headers);
                } else if (error.request) {
                    console.error('Error request:', error.request);
                } else {
                    console.error('Error message:', error.message);
                }
            });
        }
    }
};
</script>
