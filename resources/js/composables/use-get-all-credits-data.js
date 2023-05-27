import axios from 'axios';
import { ref } from 'vue';
export default function () {
    const credits = ref([]);
    const pagination = ref({
        next: null,
        prev: null,
    });
    const fetchData = (url = '/api/credits') => {
        axios.get(url)
            .then((fetchedData) => {
                if(fetchedData.data.data?.length) {
                    credits.value = fetchedData.data.data.map((row) => {
                        return {
                            name: row.guest,
                            period: row.period,
                            sum: row.total,
                            payment: row.payment
                        }
                    });
                }

                pagination.value = {
                    ...fetchedData.data.links
                };
            })
    }

    return {
        credits,
        pagination,
        fetchData,
    }
}