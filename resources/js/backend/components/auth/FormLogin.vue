<template>
    <div class="col-md-7 col-sm-12 p-3" v-loading="loading">
        <div class="card">
            <div class="card-body">
                <div class="brand-logo">
                    <img src="/assets/images/logo.svg" alt="logo">
                </div>
                <h4>Bem-Vindo de Volta!</h4>
                <h6 class="font-weight-light">Fico Feliz em ve-lo novamente!</h6>
                <slot name="alerts"></slot>
                <form class="needs-validation mt-4" novalidate v-on:submit.prevent="submit" >
                    <v-input class="mb-3" 
                        :prepend="`<i class='text-secondary'>@</i>`" 
                        type="email" 
                        v-model="frm.email" 
                        placeholder="Digite aqui seu email ..." 
                        :errors="errors.email ? errors.email : false"
                    />
                    <v-input class="mb-3" 
                        :prepend="`<i class='el-icon-lock text-secondary'></i>`" 
                        type="password" 
                        v-model="frm.password" 
                        placeholder="Digite aqui sua senha ..." 
                        :errors="errors.password ? errors.password : false"
                    />
                    <div class="d-flex flex-row flex-wrap justify-content-between align-items-center">
                        <div>
                            <el-checkbox 
                                class="d-flex align-items-center"
                                v-model="frm.remember">Manter-me Logado
                            </el-checkbox>
                        </div>
                        <div>
                            <a class="link" href="forgot_my_password">Esqueceu a Senha ?</a>
                        </div>
                    </div>
                    <button class="btn btn-secondary btn-block mt-4 mb-2" type="submit">Login</button>
                    <template v-if="sociallogin.facebook.client_id || sociallogin.google.client_id">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" @click="socialLoginRedirect('google')" class="loginBtn loginBtn--google" v-bind:class="{'mr-2':sociallogin.facebook.client_id}" 
                                v-if="sociallogin.google.client_id">Google</button>
                                <button type="button" @click="socialLoginRedirect('facebook')" class="loginBtn loginBtn--facebook" v-if="sociallogin.facebook.client_id">Facebook</button>
                            </div>
                        </div>
                    </template>
                    <div class="text-center mt-3">Não possui cadastro ?<a href="signup" class="link ml-2">Cadastre-se</a></div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : ["sociallogin"],
    data() {
        return {
            loading : false,
            errors : {},
            frm : {
                email : null,
                password : null,
                remember : true
            }
        }
    },
    methods : {
        socialLoginRedirect(provider) {
            window.location.href = `${laravel.general.root_url}/admin/auth/login/social/${provider}`
        },
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