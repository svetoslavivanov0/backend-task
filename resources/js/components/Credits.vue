<template>
  <div>
    <div class="table">
      <div class="row">
        <p>
          Name
        </p>

        <p>
          Sum
        </p>

        <p>
          Months
        </p>

        <p>
          Monthly Payment
        </p>
      </div>

      <div class="row" v-for="credit in credits">
        <p>
          {{ credit.name }}
        </p>

        <p>
          {{ credit.sum }}
        </p>

        <p>
          {{ credit.period }}
        </p>

        <p>
          {{ credit.payment }} bgn
        </p>
      </div>

      <div class="actions" v-if="pagination.next || pagination.prev">
        <a
            href="#"
            v-if="pagination.next"
            @click.prevent="fetchData(pagination.next)"
        >
          Next page
        </a>

        <a
            href="#"
            v-if="pagination.prev"
            @click.prevent="fetchData(pagination.prev)"
        >
          Prev page
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import useGetAllCreditsData from '../composables/use-get-all-credits-data';
export default {
  name: 'Credits',
  setup() {
    const {
      credits,
        fetchData,
        pagination
    } = useGetAllCreditsData();

    onMounted(() => {
      fetchData();
    })

    return {
      credits,
      pagination,
      fetchData,
    }
  }
}
</script>

<style scoped>
  .table .row {
    display: flex;
  }

  .table .row p {
    width: 150px;
  }
</style>