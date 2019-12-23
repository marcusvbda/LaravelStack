<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between align-items-center">
        <div class="collapse navbar-collapse d-flex align-items-center">
            <a href="#" @click.prevent="setCollapse" class="collapse-btn d-none d-lg-block">
                <span class="el-icon-s-unfold" v-if="$root.sidebarCollapse"></span>
                <span class="el-icon-s-fold" v-else></span>
            </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" @click="toggleActiveResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="ml-2 d-none d-none d-lg-block">
                <slot name="breadcrumb"></slot>
            </div>
            <custom-global-search class="d-none d-none d-lg-block" :route="routeglobalsearch"></custom-global-search>
            <ul class="navbar-nav d-none d-none d-lg-block">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center flex-row" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b class="mr-2">{{user.email}}</b>
                        <img v-if="user.avatar"  class="img-profile" :src="user.avatar" />
                        <span v-else class="text img-profile d-flex align-items-center text-center justify-content-center color">
                            {{user.name.slice(0,2).toUpperCase()}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" :href="routeprofile"><span class="el-icon-user mr-2 font-weight-bolder"></span>Minha Conta</a>
                        <a class="dropdown-item" :href="routelogout"><span class="el-icon-close mr-2 font-weight-bolder"></span>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
export default {
    props:["user","routeglobalsearch","routeprofile","routelogout"],
    methods : {
        setCollapse() {
            this.$root.sidebarCollapse = !this.$root.sidebarCollapse
            Cookies.set("sidebarCollapse",this.$root.sidebarCollapse ? 1 : 0)
        },
        toggleActiveResponsive() 
        {
            $('#sidebar').toggleClass('active')
            if($(".sidebar").has(".active")){
                $("body").toggleClass("no-overflow");
            }
        }
    }
}
</script>
<style lang="scss">
@import '../../../../sass/backend/_variables.scss';
    .collapse-btn {
        padding: 10px;
        font-size: 25px;
        color: $secondary;
        text-decoration: unset;
    }
    .navbar {
        padding-top:0px;
        padding-bottom :0px;
    }
    @media (max-width: 768px) {
        .breadcrumb {
            display:none;
        }
        .navbar {
            padding-top:10px;
            padding-bottom :10px;
        }
    }
</style>