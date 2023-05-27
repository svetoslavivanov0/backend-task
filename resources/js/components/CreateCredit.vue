<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          {{  formData }}
          <div class="card-header">Create Credit</div>

          <form @submit.prevent="handleSubmit">
            <div class="form-group">
              <div>
                <label for="name">Name</label>

                <input
                    type="text"
                    name="name"
                    v-model="formData.name"
                >
              </div>

              <div>
                <label for="sum">Sum</label>

                <input
                    type="number"
                    min="1"
                    name="sum"
                    v-model="formData.sum"
                >
              </div>

              <div>
                <label for="months">Months</label>

                <input
                    type="number"
                    :min="1"
                    :max="12"
                    v-model="formData.months"
                >
              </div>

              <input type="submit">
            </div>
          </form>

          {{ message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import router from "../router";

export default {
  setup() {
    const formData = ref({
      name: null,
      sum: 1,
      months: 1,
    });

    const message = ref(null);

    const handleSubmit = () => {
      axios.post('/api/credits', {
        name: formData.value.name,
        months: formData.value.months,
        sum: formData.value.sum
      })
          .then((result) => {
            if (result.data.error && result.data.message) {
              message.value = result.data.message;
              return;
            }

            router.push({
              path: '/'
            });
          }).catch((e) => {
        console.log(e.message)
      })
    };

    const resetForm = () => {
      message.value = null;

      formData.value = {
        name: null,
        sum: 1,
        months: 1,
      }
    };

    return {
      formData,
      message,
      handleSubmit
    }
  }
}
</script>
