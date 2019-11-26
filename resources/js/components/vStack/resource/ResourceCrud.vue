<template>
    <div class="card">
        <form class="needs-validation m-0" novalidate v-on:submit.prevent="submit" >
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-sm-12">
                        <template v-for="field in data.fields">
                            <v-input class="mb-3" 
                                v-if="['text','email','url'].includes(field.options.type)"
                                :label="field.options.label" 
                                :prepend="field.options.prepend" 
                                :type="field.options.type" 
                                v-model="form[field.options.field]" 
                                :placeholder="field.options.placeholder" 
                                :errors="errors[field.options.field] ? errors[field.options.field] : false"
                            />
                        </template>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end d-flex align-items-center">
                        <a :href="data.list_route" class="mr-3 text-danger link"><b>Cancelar</b></a>
                        <button class="ml-3 btn btn-primary btn-sm-block" type="sumit">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props:["data"],
    data() {
        return {
            loading : false,
            form : {},
            errors : {}
        }
    },
    async created() {
        this.initForm()
    },
    methods : {
        initForm() {
            let fields = this.data.fields
            for(let i in fields) {
                this.$set(this.form, fields[i].options.field, fields[i].options.value ? fields[i].options.value : fields[i].options.default)
            }
            this.$set(this.form, "resource_id", this.data.resource_id)
            if(this.data.id) this.$set(this.form, "id", this.data.id)
        },
        submit() {
            this.loading = true
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
        }
    }
}
</script>