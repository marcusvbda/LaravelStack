<template>
    <transition name="fade">
        <div v-bind:class="{'has-logo':logo}" class="sidebar" v-if="showing" >
            <logo v-if="!isCollapse" :logo="logo"  />
            <el-menu :collapse="isCollapse" class="h-100" :default-active="activeMenu"
                :background-color="bgColor"
                active-text-color="white!important"
                text-color="#ffffff94"
            >   
                <template  v-for="(m,i) in menu">
                    <template v-if="m.items">
                        <el-submenu :index="String(i)">
                            <template slot="title">
                                <i class="el-icon-menu"></i>
                                <span v-html="m.label"></span>
                            </template>
                            <template v-for="(item,y) in m.items">
                                <el-menu-item-group>
                                    <a  @click="goTo(item.url)" style="text-decoration:unset!important;">
                                        <el-menu-item :index="`${item.label}_${i}-${y}`" :active="setActive(`${item.label}_${i}-${y}`,item.active)">
                                            <i :class="`${item.icon} mb-1`"></i>
                                            <span slot="title">{{item.label}}</span>
                                        </el-menu-item>
                                    </a>
                                </el-menu-item-group>
                            </template>
                        </el-submenu>
                    </template>
                    
                    <el-menu-item v-else :index="`${m.label}'_'${String(i)}`" :active="setActive(`${m.label}'_'${String(i)}`,m.active)" @click="goTo(m.url)">
                        <a @click="goTo(m.url)" style="text-decoration:unset!important;">
                            <i :class="`${m.icon} mb-1`"></i>
                            <span>{{m.label}}</span>
                        </a>
                    </el-menu-item>
                </template>
            </el-menu>
        </div>
    </transition>
</template>
<script>
import variables from '../../../../sass/backend/_variables.scss'
export default {
    props : ["menu","logo"],
    data() {
        return {
            isCollapse : false,
            showing : true,
            activeMenu : ""
        }
    },
    components : {
        "logo" : require("./partials/-logo.vue").default
    },
    mounted() {
        console.log(this.logo)
    },
    computed : {
        bgColor() {
            return variables ? variables.secondary : null
        },
    },
    methods : {
        setActive(index,active) {
            if(active) this.activeMenu = index
        },
        goTo(url) {
            this.showing = false
            window.location.href= url
        }
    }

}
</script>
<style lang="scss">
@import '../../../../sass/backend/_variables.scss';
.el-menu--vertical {
    .el-menu-item-group {
        .el-menu-item-group__title {
            padding : 0!important;
        }
    }
}
.sidebar {
    .el-menu {
        .el-submenu__icon-arrow {
            display: none;
        }
        border-right : unset;
        width: 201px;
        &.el-menu--collapse {
            width : unset;
            .el-submenu__title { 
                &:hover {
                    .el-icon-menu {
                        color : white!important;
                    }
                }
            }
        }
        .el-submenu {
            &.is-active {
                .el-submenu__title {
                    background-color : $primary!important;
                    color : white!important;
                    font-weight : bolder;
                    a,i {
                        color : white!important;
                    }
                    &:after {
                        right: 0;
                        border: solid 8px transparent;
                        content: " ";
                        height: 0;
                        width: 0;
                        position: absolute;
                        pointer-events: none;
                        border-right-color: $bgColor;
                        top: 50%;
                        margin-top: -8px;
                    }
                }
            }
            .el-submenu__title {
                &:hover {
                    &:not(.is-active) {
                        transition :.5s;
                        color:white!important;
                    }
                }
            }
            .el-menu--inline {
                width: 200px;
                .el-menu-item-group {
                    background-color:$quaternary;
                    .el-menu-item-group__title {
                        padding : unset;
                    }
                    .el-menu-item {
                        color : #ffffff94!important;
                        background-color:$quaternary!important;
                        &.is-active {
                            a,i {
                                color : white!important;
                                font-weight : bolder;
                            }
                            &:after {
                                right: 0;
                                content: unset;
                            }
                        }
                        &:hover {
                            &:not(.is-active) {
                                background-color:$quaternary!important;
                                transition :.5s;
                                color:white!important;
                            }
                        }
                    }
                }
            }
        }

        .el-menu-item {
            a {
                color : #ffffff94!important;
                &:hover {
                    &:not(.is-active) {
                        transition :.5s;
                        color:white!important;
                        .el-icon-setting {
                            transition :.5s;
                            color:white!important;
                        }
                    }
                }
            }
            &.is-active {
                background-color : $primary!important;
                color : white!important;
                a,i {
                    color : white!important;
                    font-weight : bolder;
                }
                &:after {
                    right: 0;
                    border: solid 8px transparent;
                    content: " ";
                    height: 0;
                    width: 0;
                    position: absolute;
                    pointer-events: none;
                    border-right-color: $bgColor;
                    top: 50%;
                    margin-top: -8px;
                }
            }
            &:hover {
                &:not(.is-active) {
                    transition :.5s;
                    background-color : $tertiary!important;
                    color:white!important;
                    .el-icon-setting {
                        transition :.5s;
                        color:white!important;
                    }
                }
            }
        }
    }
}
</style>