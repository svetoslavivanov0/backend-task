<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create Payment</div>

          <form @submit.prevent="handleSubmit">
            <div class="form-group">
              <div>
                <label for="name">Credit</label>

                <select v-model="formData.uuid">
                  <option :value="null">Select a credit</option>

                  <option
                      v-for="credit in credits"
                      :value="credit.id"
                  >
                    {{ credit.name }} - {{ credit.sum}} bgn
                  </option>
                </select>
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

              <input
                  type="submit"
                  :disabled="!credits.length"
              >
            </div>
          </form>

          <div v-if="message">
            <p>{{ message }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import router from "../router";
import { onMounted, computed } from "vue";
import useGetAllCreditsData from "../composables/use-get-all-credits-data";

export default {
  setup() {
    const formData = ref({
      uuid: null,
      sum: 0,
    });

    const message = ref(null);
    const { credits, fetchData } = useGetAllCreditsData();

    onMounted(() => {
      fetchData();
    });
    const handleSubmit = () => {
      if (!formData.value.uuid) {
        alert('Select a credit');
        return;
      }

      axios.put('/api/credits', {
        uuid: formData.value.uuid,
        sum: formData.value.sum,
      })
          .then((result) => {
            if (result.data.message) {
              alert(result.data.message)
            }

            router.push({
              path: '/'
            });
          }).catch((e) => {
        console.log(e.message)
      })
    };

    return {
      formData,
      message,
      credits,
      handleSubmit,
    }
  }
}
</script>
