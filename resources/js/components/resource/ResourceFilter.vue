<template>
<div class="d-flex justify-content-between align-items-center">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <button class="nav-link dropdown-toggle d-flex align-items-center btn btn-primary btn-sm-block px-5" href="#" id="resourceFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="el-icon-search mr-2"></span>Filtros
                <span v-if="data.hasFilter" class="badge badge-light ml-2 mt-1">{{data.hasFilter}}</span>
            </button>
            <div class="dropdown-menu filter p-0" id="prevent_close_menu" aria-labelledby="resourceFilterDropdown">
                <div class="card" id="cardfilter">
                    <div class="card-header">Por Página :</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <select class="form-control filter" id="per_page" field="per_page" v-model="filter.per_page"  @change="makeNewRoute">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <template v-for="(value,key) in data.filters" >
                        <div class="card-header" style="border-top: 1px solid #cfcfcf;">{{value.label}} :</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <input v-model="filter[key]" @change="makeNewRoute" v-if="['text','email','url'].includes(value.type)" type="text" class="form-control" :placeholder="value.placeholder ? value.placeholder : ''"
                                    v-bind:class="{'withFilter' : filter[key]}">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </li>
    </ul>
    <div class="filter-sumary">
        <span v-html="sumary"></span>
    </div>
</div>
</template>
<script>
export default {
    props :["data"],
    data() {
        return {
            filter : {
                per_page : this.data.perpage
            }
        }
    },
    async created() {
        this.initFormFilter()
    },
    mounted() {
        document.getElementById("prevent_close_menu").addEventListener('click', event => event.stopPropagation())
    },
    computed : {
        sumary() {
            let filter = this.filter
            let text = `<b class='text-primary mr-1'>Por Página : </b> ${filter.per_page}`
            let filter_keys = Object.keys(this.data.filters)
            for(let i in filter_keys) 
            {
                if(this.filter[filter_keys[i]])  {
                    text+= `<span class="ml-4"><b class='text-primary mr-1'>${this.data.filters[filter_keys[i]].label} : </b> ${this.filter[filter_keys[i]]}</span>`
                }
            }
            return text
        }  
    },
    methods: {
        initFormFilter() {
            let filter_keys = Object.keys(this.data.filters)
            for(let i in filter_keys) this.$set(this.filter,filter_keys[i],this.data.query[filter_keys[i]] ? this.data.query[filter_keys[i]] : '')
        },
        makeNewRoute() {
            let str_query = ""
            let filter_keys = Object.keys(this.filter)
            for(let i in filter_keys) this.data.query[filter_keys[i]] = this.filter[filter_keys[i]]
            for(let i in this.data.query) str_query += `${i}=${this.data.query[i]}&`
            str_query = str_query.slice( 0, -1 )
            window.location.href =  `${this.data.route}?${str_query}`
        }
    },
}
</script>