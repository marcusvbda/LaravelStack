<template>
    <div class="col-md-7 col-sm-12 p-3" v-loading="loading">
        <div class="card">
            <div class="card-body">
                <div class="brand-logo">
                    <img src="/assets/images/logo.svg" alt="logo">
                </div>
                <h4>Novo por aqui?</h4>
                <h6 class="font-weight-light">Cadastre-se agora e junte-se a nós!</h6>
                <slot name="alerts"></slot>
                <form class="needs-validation mt-4" novalidate v-on:submit.prevent="submit" >
                    <v-input class="mb-3" 
                        :prepend="`<i class='el-icon-user text-secondary'></i>`" 
                        v-model="frm.name" 
                        placeholder="Digite aqui seu nome ..." 
                        :errors="errors.name ? errors.name : false"
                    />
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
                    <v-input class="mb-3" 
                        :prepend="`<i class='el-icon-lock text-secondary'></i>`" 
                        type="password" 
                        v-model="frm.password_confirmation" 
                        placeholder="Digite aqui novamente sua senha ..." 
                        :errors="errors.password_confirmation ? errors.password_confirmation : false"
                    />
                    <button class="btn btn-secondary btn-block mt-4 mb-4" type="submit">Cadastrar-se</button>
                    <div class="text-center">Já possui cadastro ?<a href="login" class="link ml-2">Login</a></div>
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
                name : null,
                email : null,
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