<template>
    <div class="row resource-metric-section mb-3">
        <el-dialog :visible.sync="editing" width="80%" height="80%" :before-close="handleClose">
            <resource-metric-new-chart :resourceroute="resource_route"/>
        </el-dialog>
        <div class="d-flex flex-column col-12">
            <div class="mb-1"><a href="#" @click.prevent="editing=!editing" v-if="customize" class="link float-right" v-html="label"></a></div>
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    props:["customize","label","title","resource_route"],
    data() {
        return {
            editing : false
        }
    },
    components : {
        "resource-metric-new-chart" : require("./partials/-ResourceMetricNewChart.vue").default
    },
    methods : {
        handleClose(done) 
        {
            this.$confirm("Você deseja mesmo sair ?", "Confirmação", {confirmButtonText: "Sim",cancelButtonText: "Não",type: 'warning'}).then(_ => {
                return this.cancelDialogClose()
            }).catch( _ => false)
        },
        cancelDialogClose() {
            this.editing = false
        }
    }
}
</script>
<style lang="scss" scoped>

</style>