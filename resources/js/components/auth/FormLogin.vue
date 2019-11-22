<template>
    <div class="col-md-7 col-sm-12 p-3" v-loading="loading">
        <div class="card">
            <div class="card-body">
                <div class="brand-logo">
                    <img src="/assets/images/logo.svg" alt="logo">
                </div>
                <h4>Bem-Vindo de Volta!</h4>
                <h6 class="font-weight-light">Fico Feliz em ve-lo novamente!</h6>
                <form class="needs-validation mt-4" novalidate v-on:submit.prevent="submit" >
                    <v-input class="mb-3" :label="`<b>E-mail</b>`" type="email" v-model="frm.email" placeholder="Digite aqui seu email ..." 
                        :errors="errors.email ? errors.email : false"
                    />
                    <v-input class="mb-3" :label="`<b>Senha</b>`" type="password" v-model="frm.password" placeholder="Digite aqui sua senha ..." 
                        :errors="errors.password ? errors.password : false"
                    />
                    <div class="d-flex flex-row flex-wrap">
                        <div class="col-md-6 col-sm-12 pl-0">
                            <el-switch
                                v-model="frm.remember"
                                active-text="Manter-me Logado">
                            </el-switch>
                        </div>
                        <div class="col-md-6 col-sm-12 pr-0 text-right">
                            <a href="forgot_my_password">Esqueceu a Senha ?</a>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block mt-4 mb-2" type="submit">Login</button>
                    <div class="text-center">Não possui cadastro ?<a href="signup" class="ml-2">Cadastre-se</a></div>
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
                email : "bassalobre.vinicius@gmail.com",
                password : "v1n1c1u5",
                remember : false
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