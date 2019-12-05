<template>
    <div class="row">
        <div class="col-12">
            <form class="needs-validation m-0" novalidate v-on:submit.prevent="submit" >
                
                <template v-for="(field,i) in data.fields">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center mb-3" v-if="field.label" >
                                <div class="col-md-10 col-sm-12">
                                    <h4 class="mb-4" v-html="field.label" v-if="field.label"></h4>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center" v-for="(input,y) in field.inputs">
                                <div class="col-md-10 col-sm-12">
                                    <v-runtime-template :key="y" :template="input.view"></v-runtime-template>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                    
                <div class="row">
                    <div class="col-12 d-flex justify-content-end d-flex align-items-center">
                        <a :href="data.list_route" class="mr-4 text-danger link"><b>Cancelar</b></a>
                        <button class="ml-3 btn btn-primary btn-sm-block" type="sumit">{{pageType=='CREATE' ? 'Cadastrar' : 'Alterar'}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props:["data"],
    data() {
        return {
            loading : false,
            form : {},
            errors : {},
        }
    },
    components : {
        "v-runtime-template" : VRuntimeTemplate
    },
    computed : {
        pageType() {
            return this.data.id ? "EDIT" : "CREATE"
        }
    },
    async created() {
        this.initForm()
    },
    methods : {
        initForm() {
            let fields = []
            for(let i in this.data.fields){
                let card = this.data.fields[i]
                for(let y in card.inputs){
                    fields.push(card.inputs[y])
                }
            }
            for(let i in fields) {
                let field_name = fields[i].options.field
                let field_value = fields[i].options.value ? fields[i].options.value : fields[i].options.default
                this.$set(this.form, field_name, field_value)
            }
            this.$set(this.form, "resource_id", this.data.resource_id)
            if(this.data.id) this.$set(this.form, "id", this.data.id)
        },
        submit() {
            this.loading = true
            this.$confirm(`Confirma ${this.data.page_type} ?`, "Confirmação", {
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                type: 'warning'
            }).then(() => {
                this.$http.post(this.data.store_route,this.form).then( res => {
                    let data = res.data
                    if(data.message) this.$message({showClose: true, message : data.message.text,type: data.message.type})
                    if(data.success) return window.location.href=data.route
                    this.loading = false
                }).catch( er => {
                    let errors = er.response.data.errors
                    this.errors = errors
                    this.loading = false
                })
            }).catch( () => false)
        }
    }
}
</script>