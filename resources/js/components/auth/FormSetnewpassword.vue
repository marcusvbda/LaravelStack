<template>
    <div class="col-md-7 col-sm-12 p-3" v-loading="loading">
        <div class="card">
            <div class="card-body">
                <div class="brand-logo">
                    <img src="/assets/images/logo.svg" alt="logo">
                </div>
                <h4>Renovando sua senha</h4>
                <h6 class="font-weight-light">Digite e confirme abaixo a sua nova senha</h6>
                <slot name="alerts"></slot>
                <form class="needs-validation mt-4" novalidate v-on:submit.prevent="submit" >
                    <v-input class="mb-3" 
                        :label="`<b>Senha</b>`"
                        :prepend="`<i class='el-icon-lock text-primary'></i>`" 
                        type="password" 
                        v-model="frm.password" 
                        placeholder="Digite aqui sua senha ..." 
                        :errors="errors.password ? errors.password : false"
                    />
                    <v-input class="mb-3" 
                        :label="`<b>Confirme sua senha</b>`"
                        :prepend="`<i class='el-icon-lock text-primary'></i>`" 
                        type="password" 
                        v-model="frm.password_confirmation" 
                        placeholder="Digite aqui novamente sua senha ..." 
                        :errors="errors.password_confirmation ? errors.password_confirmation : false"
                    />
                    <button class="btn btn-primary btn-block mt-4 mb-4" type="submit">Definir nova senha</button>
                    <div class="text-center">Voltar ao<a href="login" class="ml-2">Login</a></div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading : false,
            errors : {},
            frm : {
                password : null,
                password_confirmation : null
            }
        }
    },
    methods : {
        submit() {
            this.loading = true
            this.$http.post("",this.frm).then( res => {
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
<style scoped lang="scss">
    .login-page {
        .right-side {
            .brand-logo {
                margin-bottom: 2rem;
                img {
                    width : 150px;
                }
            }
        }
    }
</style>