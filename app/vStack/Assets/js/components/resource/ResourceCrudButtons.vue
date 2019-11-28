<template>
    <div class="d-flex flex-row justify-content-center flex-wrap">
        <a v-if="data.can_view" :href="data.route_view" ><span class="icon_resource el-icon-view px-3"></span></a>
        <a class="cursor_pointer" v-if="data.can_update" :href="data.route_update"><span class="icon_resource el-icon-edit px-3"></span></a>
        <a v-if="data.can_delete" @click.prevent="destroy"><span class="icon_resource el-icon-delete px-3"></span></a>
    </div>
</template>
<script>
export default {
    props:["data","id"],
    data() {
        return {
            loading : null
        }
    },
    methods : {
        destroy() {
            this.$confirm(`Confirma Exclusão ?`, "Confirmação", {
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                type: 'error'
            }).then(() => {
                this.loading = this.$loading()
                this.$http.delete(this.data.route_destroy,{}).then( res => {
                    res = res.data
                    return window.location.href=res.route
                }).catch( er => {
                    this.loading.close()
                    console.log(er)
                })
            }).catch( () => false)
        }
    }
}
</script>