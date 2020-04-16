<template>
    <div>
        <ul v-for="item in reservas" :key="item.id">
            <router-link :to="{ name: 'reservaShow', params: { id: item.id } }">
                <li>{{ item.nombre }}</li>
                <li>{{ item.numeroHabitacion }}</li>
            </router-link>
        </ul>
        <router-link
            :to="{ name: 'home', query: { page: page - 1 } }"
            rel="prev"
            >Prev</router-link
        >
        |
        <router-link
            :to="{ name: 'home', query: { page: page + 1 } }"
            rel="next"
            >Next</router-link
        >
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            incremetBy: 1
        };
    },

    computed: {
        ...mapState(["user", "reservas", "reserva"]),
        page() {
            return parseInt(this.$route.query.page) || 1;
        }
    }
};
</script>
