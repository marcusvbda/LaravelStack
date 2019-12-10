<template>
    <div class="mt-4">
        <template>
            <el-steps :active="wizard_step" finish-status="success" align-center>
                <el-step title="Etapa 1"></el-step>
                <el-step title="Etapa 2"></el-step>
                <el-step title="Etapa 3"></el-step>
            </el-steps>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center mb-5">
                                <div class="col-md-10 col-sm-12">
                                    <h4>Step 1</h4>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10 col-sm-12" v-if="wizard_step>=0">
                                    <v-select :label="`<b>Tipo do Card</b>`" v-model='frm.type' :optionlist="type_list" />
                                </div>
                            </div>
                            <template v-if="wizard_step>=1">
                                <hr>
                                <div class="row d-flex justify-content-center mb-5">
                                    <div class="col-md-10 col-sm-12">
                                        <h4>Etapa 2</h4>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-10 col-sm-12" >
                                        <v-select :label="`<b>Tamanho</b>`" v-model='frm.width' :optionlist="width_list" withoutBlank />
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <v-input :label="`<b>Título</b>`" v-model='frm.title' />
                                    </div>
                                    <div class="col-md-10 col-sm-12">
                                        <v-input :label="`<b>SubTítulo</b>`" v-model='frm.subtitle' />
                                    </div>
                                </div>
                            </template>
                            <div class="row d-flex justify-content-center mt-4" v-if="wizard_step==1">
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-sm-block btn-outline-primary" @click="wizard_step=2">Ir Para Etapa 3</button>
                                </div>
                            </div>
                            <template v-if="wizard_step>=2">
                                <hr>
                                <div class="row d-flex justify-content-center mb-5">
                                    <div class="col-md-10 col-sm-12">
                                        <h4>Etapa 3</h4>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-10 col-sm-12" v-if="frm.type=='custom-content'">
                                        <v-codemirror :label="`<b>Conteúdo</b>`" v-model="frm.content" height="150px" />
                                    </div>
                                </div>
                                <hr>
                                <div class="preview" v-if="wizard_step>0">
                                    <div class="row d-flex justify-content-center mb-5">
                                        <div class="col-md-10 col-sm-12">
                                            <h4>Preview</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mb-4">
                                        <div :class="`col-md-${frm.width ? frm.width : '4'} col-sm-12 px-0`">
                                            <div class="card p-3 h-100">
                                                <div class="h-100">
                                                    <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                                                        <b v-if="wizard_step>=1" v-html="frm.title"></b>
                                                        <b v-if="wizard_step>=1"  v-html="frm.subtitle"></b>
                                                    </div> 
                                                </div>
                                                <div v-if="wizard_step>=2 && frm.type=='custom-content'" v-html="frm.content"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <template  v-if="wizard_step>=2 && frm.type=='custom-content'">
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <a :href="`${resourceroute}/custom-cards`" class="text-danger mr-4"><b>Cancelar</b></a>
                        <button class="btn btn-primary" @click="confirm">{{ card ? "Alterar" : "Cadastrar"}}</button>
                    </div>
                </div>
            </template>
        </template>
    </div>
</template>
<script>
export default {
    props : ["card","resourceroute"],
    data() {
        return {
            wizard_step : this.card ? (this.card.type=="custom-content" ? 4 : 4) : 0,
            type_list : [
                {id:"custom-content",name:"Conteúdo Customizado"},
                // {id:"trend-counter",name:"Gráfico Quantificador e Mostrador de Tendência"},
                // {id:"group-chart",name:"Gráfico De Agrupamento"},
                // {id:"trend-chart",name:"Grafico de Area"},
            ],
            width_list : [
                {id:4,name:"1/3"},
                {id:8,name:"2/3"},
                {id:12,name:"3/3"},
            ],
            frm : {
                id  : this.card ? this.card.id : null,
                type  : this.card ? this.card.type : "",
                width : this.card ? Number(this.card.width) : 4,
                title : this.card ? this.card.title : "Título",
                subtitle : this.card ? this.card.subtitle : "Sub Titulo",
                content : this.card ? this.card.content : "Conteúdo",
            }
        }
    },
    watch : {
        "frm.type"(val){
            if(!val) return this.wizard_step = 0
            this.wizard_step = 1
        }
    },
    methods : {
        confirm() {
            this.$confirm("Deseja salvar esse card customizado ?", "Confirmação", {confirmButtonText: "Sim",cancelButtonText: "Não",type: 'warning'}).then(_ => {
                let loading = this.$loading()
                this.$http.post(`${this.resourceroute}/custom-cards/store`,this.frm).then(res => {
                    window.location.href = this.resourceroute+"/custom-cards"
                }).catch( er => {
                    loading.close()
                    console.log(er)
                })
            }).catch( _ => false)
        },
    }
}
</script>