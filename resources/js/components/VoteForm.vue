<template>
  <div>
    <h2 class="text-center font-bold mb-4">Vote for your choice</h2>
    <form @submit.prevent="submitVote">
      <div v-for="choice in choices" :key="choice.id" class="mb-2">
        <label class="inline-flex items-center">
          <input
            type="radio"
            :value="choice.id"
            v-model="selectedChoice"
            class="form-radio"
            name="choice"
          />
          <span class="ml-2">{{ choice.name }}</span>
        </label>
      </div>
      <button
        type="submit"
        class="mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded"
      >
        Submit Vote
      </button>
      <p v-if="errors.general" class="text-red-500 text-xs mt-2">{{ errors.general }}</p>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    choices: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      selectedChoice: null,
      errors: {}
    };
  },
  methods: {
    submitVote() {
      if (this.selectedChoice === null) {
        alert("Please select a choice before submitting your vote.");
        return;
      }
      console.log('Submitting vote with choice_id:', this.selectedChoice);
      this.$axios
        .post("/vote", { choice_id: this.selectedChoice })
        .then(() => {
          alert("Vote recorded successfully");
        })
        .catch((error) => {
          console.error("Vote submission error:", error);
          if (error.response && error.response.data && error.response.data.errors) {
            this.errors = error.response.data.errors; // Set errors from response
          } else {
            this.errors.general = 'Vote submission failed. Please try again.';
          }
        });
    },
  },
};
</script>

<style scoped>
</style>