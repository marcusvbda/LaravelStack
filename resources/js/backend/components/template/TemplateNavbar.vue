<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between align-items-center p-0">
        <div class="collapse navbar-collapse d-flex align-items-center">
            <a href="#" @click.prevent="setCollapse" class="collapse-btn">
                <span class="el-icon-s-unfold" v-if="$root.sidebarCollapse"></span>
                <span class="el-icon-s-fold" v-else></span>
            </a>
            <div class="ml-2">
                <slot name="breadcrumb"></slot>
            </div>
            <custom-global-search :route="routeglobalsearch"></custom-global-search>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center flex-row" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b class="mr-2">{{user.email}}</b>
                        <img v-if="user.avatar"  class="img-profile" :src="user.avatar" />
                        <span v-else class="text img-profile d-flex align-items-center text-center justify-content-center color">
                            {{user.name.slice(0,-2).toUpperCase()}}
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
</style>