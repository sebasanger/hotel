<template>
    <div class="row">
        <div class="col-md-12 mt-4">
            <producto-stock />
        </div>
    </div>
</template>

<script>
import productoStock from "./ProductoStock.vue";

export default {
    components: {
        productoStock
    },
    mounted() {
        this.$Progress.finish();
    }
};
</script>
