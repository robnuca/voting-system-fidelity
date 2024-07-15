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
              <p v-if="errors.password_confirmation" class="text-red-500 text-xs mt-2">{{ errors.password_confirmation[0] }}</p>
          </div>
          <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Register</button>
          <div v-if="errors.general" class="text-red-500 text-xs mt-2">{{ errors.general }}</div>
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
          errors: {} // Object to store error messages
      };
  },
  methods: {
      register() {
          this.errors = {}; // Reset errors before making the request
          this.axios.post('/register', {
              name: this.name,
              email: this.email,
              password: this.password,
              password_confirmation: this.password_confirmation,
          }).then(response => {
              alert('Registration successful! Please check your email to verify your account.');
              this.success = 'Registration successful! Please check your email to verify your account.';
              this.$emit('registered');
          }).catch(error => {
              if (error.response && error.response.data && error.response.data.errors) {
                  this.errors = error.response.data.errors; // Set errors from response
              } else if (error.response && error.response.data && error.response.data.message) {
                  this.errors.general = error.response.data.message;
              } else {
                  this.errors.general = 'Registration failed. Please try again.';
              }
          });
      }
  }
};
</script>