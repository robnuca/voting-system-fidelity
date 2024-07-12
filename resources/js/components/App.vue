<template>
    <div>
      <Register v-if="!authenticated && !showLogin" @registered="showLogin = true" />
      <Login v-if="!authenticated && showLogin" @login="handleLogin" />
      <VoteForm v-if="authenticated" :choices="choices" @vote="handleVote" />
      <div v-if="!authenticated && showLogin" class="text-center mt-4">
        <button @click="toggleForm" class="text-blue-500 underline">Don't have an account? Register</button>
      </div>
      <div v-if="!authenticated && !showLogin" class="text-center mt-4">
        <button @click="toggleForm" class="text-blue-500 underline">Already have an account? Log in</button>
      </div>
    </div>
  </template>
  
  <script>
  import Login from './Login.vue';
  import Register from './Register.vue';
  import VoteForm from './VoteForm.vue';
  
  export default {
    components: { Login, Register, VoteForm },
    data() {
      return {
        authenticated: false,
        showLogin: true,
        choices: [],
      };
    },
    methods: {
      toggleForm() {
        this.showLogin = !this.showLogin;
      },
      handleLogin(token) {
        this.authenticated = true;
        this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        this.loadChoices();
      },
      loadChoices() {
        this.$axios.get('/choices')
          .then(response => {
            console.log('Choices response:', response.data);
            this.choices = response.data;
          })
          .catch(error => {
            console.error('Error loading choices:', error);
          });
      },
      handleVote() {
        alert('Vote recorded successfully');
      }
    }
  };
  </script>
  
  <style scoped>
  </style>