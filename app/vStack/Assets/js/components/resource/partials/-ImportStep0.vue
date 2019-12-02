<template>
    <div>
        <div class="card-header bg-white py-4">
            <div class="row">
                <div class="col-12">
                    <h3 class="font-weight-light">Importar {{data.resource.singular_label.toLowerCase()}} de um arquivo CSV</h3>
                    <div class="mt-3">Esta ferramenta lhe permite importar (ou fundir) {{data.resource.label.toLowerCase()}} para a sua loja a partir de um arquivo CSV.</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-sm-12">Escolha um arquivo CSV do seu computador</div>
                <div class="col-md-6 col-sm-12">
                    <input type="file">
                    <div><small class="mt-2">Tamanho máximo: 128 MB</small></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-5 col-sm-12">Atualizar {{data.resource.label.toLowerCase()}} existentes</div>
                <div class="col-md-6 col-sm-12">
                    <el-checkbox class="d-flex flex-row flex-wrap align-items-center"
                        v-model="frm.update">{{data.resource.label}} existentes que correspondam a ID ou REF serão atualizados.
                    </el-checkbox>
                </div>
            </div>
            <div class="row mt-4" v-if="config.show_advanced">
                <div class="col-md-5 col-sm-12">Delimitador do CSV</div>
                <div class="col-md-2 col-sm-12">
                    <v-input v-model="config.delimiter"  placeholder="Digite aqui o delimitador do CSV ..." />
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="row">
                <div class="col-12 d-flex flex-row flex-wrap align-items-center justify-content-between">
                    <a href="#" @click.prevent="config.show_advanced = !config.show_advanced">Exibir opções avançadas</a>
                    <button class="btn btn-primary" @click="next">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["data","frm","config"],
    methods :{
        next() {
            this.config.step++
        }
    }
}
</script>