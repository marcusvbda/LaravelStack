<template>
    <div v-loading="loading">
        <template v-if="global_step==0">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-sm-12 d-flex flex-column text-center">
                    <h1><span class="el-icon-data-line mb-3" style="font-size: 200px;opacity:.3;"></span></h1>
                    <b>Adicione seu primeiro card customizado</b>
                    <span>Os <i>cards customizados</i> podem ajudar você a visualizar e mensurar melhor seus números</span>
                    <button class="btn btn-primary btn-sm-block my-5" @click="global_step++">Adicionar Card</button>
                </div>
            </div>
        </template>
        <template v-if="global_step==1">
            <template>
                <el-steps :active="wizard_step" finish-status="success" align-center>
                    <el-step title="Etapa 1"></el-step>
                    <el-step title="Etapa 2"></el-step>
                    <el-step title="Etapa 3"></el-step>
                </el-steps>
                <div class="row">
                    <div class="col-md-3 col-sm-12" v-if="wizard_step>=0">
                        <label><b>Tipo do Card</b></label>
                        <v-select v-model='frm.type' :optionlist="type_list" />
                    </div>
                    <template v-if="wizard_step>=1">
                        <div class="col-md-3 col-sm-12" >
                            <label><b>Tamanho</b></label>
                            <v-select v-model='frm.width' :optionlist="width_list" withoutBlank />
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label><b>Título</b></label>
                            <v-input v-model='frm.title' />
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label><b>SubTítulo</b></label>
                            <v-input v-model='frm.subtitle' />
                        </div>
                    </template>
                </div>
                <div class="row d-flex justify-content-center mt-4" v-if="wizard_step==1">
                    <div class="col-md-3 text-center">
                        <button class="btn btn-sm-block btn-outline-primary" @click="wizard_step=2">Ir Para Etapa 3</button>
                    </div>
                </div>
                <template v-if="wizard_step>=2">
                    <div class="row">
                        <div class="col-12" v-if="frm.type=='custom-content'">
                            <label><b>Conteúdo</b></label>
                            <v-codemirror v-model="frm.content" />
                        </div>
                    </div>
                </template>
            </template>
            <div class="preview mt-5" v-if="wizard_step>0">
                <hr>
                <h4>Pré Visualização</h4>
                <div class="d-flex justify-content-center">
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

            <template v-if="frm.type=='custom-content'">
                <div class="row mt-4" v-if="wizard_step>=2">
                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <a href="#" class="text-danger link mr-4" @click.prevent="$parent.handleClose"><b>Cancelar</b></a>
                        <button class="btn btn-primary" @click="confirm">Confirmar</button>
                    </div>
                </div>
            </template>
        </template>
    </div>
</template>
<script>
export default {
    props : ["step","resourceroute"],
    mounted() {
        this.wizard_step = 0
    },
    data() {
        return {
            loading : false,
            global_step : this.step ? this.step : 0,
            wizard_step : 0,
            type_list : [
                {id:"custom-content",name:"Conteúdo Customizado"},
                // {id:"trend-counter",name:"Gráfico Quantificador e Mostrador de Tendência"},
                // {id:"group-chart",name:"Gráfico De Agrupamento"},
                // {id:"trend-chart",name:"Grafico de Area"},
            ],
            width_list : [
                {id:"4",name:"1/3"},
                {id:"8",name:"2/3"},
                {id:"12",name:"3/3"},
            ],
            frm : {
                type  : "",
                width : "4",
                title : "Título",
                subtitle : "Sub Titulo",
                content : "Conteúdo",
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
            this.$confirm("Deseja adicionar esse card customizado ?", "Confirmação", {confirmButtonText: "Sim",cancelButtonText: "Não",type: 'warning'}).then(_ => {
                this.loading = true
                this.$http.post(`${this.resourceroute}/custom-cards/store`,this.frm).then(res => {
                    console.log(res)
                    this.loading = false
                }).catch( er => {
                    this.loading = false
                    console.log(er)
                })
            }).catch( _ => false)
        }
    }
}
</script>