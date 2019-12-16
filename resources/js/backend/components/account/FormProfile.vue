<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                                    <animated-thumb height='140px' width='140px' >
                                        <template slot="cover">
                                            <div class="avatar-uploader d-flex align-items-center justify-content-center color">
                                                <div class="avatar">
                                                    <template v-if="user.avatar">
                                                        <img :src="user.avatar" style="width: 140px;height: 140px;border-radius: 100%;"/>
                                                    </template>
                                                    <template v-else>
                                                        {{user.name.substring(0, 2).toUpperCase()}}
                                                    </template>
                                                </div>
                                            </div>
                                        </template>
                                        <template slot="back">
                                            <el-upload
                                                class="d-flex align-items-center justify-content-center mt-4"
                                                :action="uploadRoute"
                                                :headers="header"
                                                :show-file-list="false"
                                                :on-success="handleAvatarSuccess"
                                                :before-upload="beforeAvatarUpload">
                                                <h4><i class="el-icon-plus avatar-uploader-icon"></i></h4>
                                                <small>Novo Avatar</small>
                                            </el-upload>
                                        </template>
                                    </animated-thumb>

                                    <a href="#" class='text-danger mt-3' @click.prevent="destroyAvatar" v-if="user.avatar">Excluir Avatar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2>{{user.name}}</h2>
                                    <h5 class="subtext">{{user.email}}</h5>
                                </div>
                                <div>
                                    <button class="btn btn-primary" @click="openEditModal"><span class="el-icon-edit mr-2"></span>Editar</button>
                                </div>
                            </div>
                        </div>
                        <el-dialog :close-on-click-modal="false" :close-on-press-escape="false" :visible.sync="user_dialog_visible" :before-close="handleCloseDialog" v-loading="loading">
                            <form class="needs-validation mt-4" novalidate v-on:submit.prevent="submit" >
                                <div class="col-12 form-label-group">
                                    <v-input class="mb-3" 
                                        :label="`<b>Nome</b>`" 
                                        :prepend="`<i class='el-icon-user text-secondary'></i>`" 
                                        v-model="editing_form.name" 
                                        placeholder="Digite aqui seu nome ..." 
                                        :errors="errors.name ? errors.name : false"
                                    />
                                </div>
                                <div class="d-flex mt-4 justify-content-end">
                                    <div class="col-md-4 col-sm-12 text-right">
                                        <button class="btn btn-sm-block btn-primary" type="submit">Salvar</button>
                                    </div>
                                </div>
                            </form >
                        </el-dialog>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["user"],
    data() {
        return {
            loading : false,
            errors : {},
            editing_form : {},
            user_dialog_visible : false,
            header : {"X-CSRF-TOKEN":laravel.general.csrf_token ? laravel.general.csrf_token : ""},
            uploadRoute : laravel.vstack.default_upload_route ? laravel.vstack.default_upload_route : ""
        }
    },
    components : {
        "animated-thumb" : require("../general/-AnimatedThumb.vue").default
    },
    methods : {
        destroyAvatar()  {
            this.$confirm("Deseja excluir avatar ?", "Confirmação", {
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                type: 'warning'
            }).then(() => {
                this.editing_form = Object.assign({},this.user)
                this.editing_form.avatar = null
                this.submit()
            }).catch( () => false)
        },
        handleAvatarSuccess(res, file) {
            this.editing_form = Object.assign({},this.user)
            this.editing_form.avatar = file.response.path
            this.submit()
        },
        beforeAvatarUpload(file) {
            const isImage = file.type.includes('image')
            if (!isImage) 
                this.$message.error('Avatar precisa ser uma imagem')
            return isImage
        },
        openEditModal() {
            this.editing_form = Object.assign({},this.user)
            this.user_dialog_visible = true
        },
        submit() {
            this.$http.post("",this.editing_form).then( res => {
                let data = res.data
                if(data.message) this.$message({showClose: true, message : data.message.text,type: data.message.type})
                window.location.reload()
            }).catch( er => {
                let errors = er.response.data.errors
                this.errors = errors
                this.loading = false
            })
        },
        handleCloseDialog() {
            this.$confirm("Você deseja mesmo sair da edição ?", "Confirmação", {
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                type: 'warning'
            }).then(() => {
                this.user_dialog_visible = false
                return true
            }).catch( () => false)
        },
    }
}
</script>
<style lang="scss" scoped>
@import '../../../../sass/backend/_variables.scss';
.subtext {
    color : gray;
    font-weight : 500;
}
.avatar-uploader {
    height : 140px;
    width : 140px;
    border-radius: 100%;
    cursor: pointer;
    position: relative;
    color : white;
    overflow: hidden;
    &.color {
        background-color : $quinary;
    }
    .avatar {
        font-weight: 500;
        font-size: 50px;
        border-radius: 100%;
        padding: 20px;
    }
}

</style>