<template>
    <div class="mt-6">
        <div class="error-page">
            <h2 class="headline text-red">500</h2>

            <div class="error-content">
                <h3>
                    <i class="fa fa-warning text-red"></i> Uh-Oh! Algo salio mal
                </h3>

                <p>
                    Parece que está experimentando algunos problemas de red,
                    haga clic en el botón Atrás e intente nuevamente..

                    <router-link :to="{ name: 'home' }"
                        >O vuelva a la pagina de inicio</router-link
                    >
                </p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        this.$Progress.fail();
    }
};
</script>
