<template>
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <el-steps :active="config.step" finish-status="success" align-center>
                <el-step title="Upload de arquivo"></el-step>
                <el-step title="Mapeamento de coluna"></el-step>
                <el-step title="Importação"></el-step>
                <el-step title="Concluido"></el-step>
            </el-steps>
            <div class="card mt-3">
                <step-0 v-if="config.step==0" :data="data" :frm="frm" :config="config"/>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : ['data'],
    data() {
        return {
            frm : {
                update: false
            },
            config : {
                show_advanced : false,
                delimiter : ",",
                step : 0,
            }
        }
    },
    components : {
        "step-0" : require("./partials/-ImportStep0").default
    }
}
</script>