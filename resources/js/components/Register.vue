<template>
    <div class="flex flex-col items-center">
      <form @submit.prevent="register" class="w-full">
        <div class="mb-4">
          <input type="text" v-model="name" placeholder="Name" class="w-full px-3 py-2 border rounded" required>
          <p v-if="errors.name" class="text-red-500 text-xs mt-2">{{ errors.name[0] }}</p>
        </div>
        <div class="mb-4">
          <input type="email" v-model="email" placeholder="Email" class="w-full px-3 py-2 border rounded" required>
          <p v-if="errors.email" class="text-red-500 text-xs mt-2">{{ errors.email[0] }}</p>
        </div>
        <div class="mb-4">
          <input type="password" v-model="password" placeholder="Password" class="w-full px-3 py-2 border rounded" required>
          <p v-if="errors.password" class="text-red-500 text-xs mt-2">{{ errors.password[0] }}</p>
        </div>
        <div class="mb-4">
          <input type="password" v-model="password_confirmation" placeholder="Confirm Password" class="w-full px-3 py-2 border rounded" required>
        </div>
        <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register</button>
        <p v-if="errors.general" class="text-red-500 text-xs mt-2">{{ errors.general }}</p>
        <p v-if="successMessage" class="text-green-500 text-xs mt-2">{{ successMessage }}</p>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        errors: {}, // Object to store error messages
        successMessage: '', // Success message
      };
    },
    methods: {
      register() {
        console.log("Register method called"); // Debug log
        this.errors = {}; // Reset errors before making the request
        this.successMessage = ''; // Reset success message before making the request
        this.axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        }).then(response => {
          console.log("Registration successful:", response.data); // Debug log
          this.successMessage = 'Registration successful! You can now log in.';
          this.$emit('registered');
        }).catch(error => {
          console.log("Registration failed:", error.response); // Debug log
          if (error.response && error.response.data && error.response.data.errors) {
            this.errors = error.response.data.errors; // Set errors from response
          } else {
            this.errors.general = 'Registration failed. Please try again.';
          }
        });
      }
    }
  };
  </script>