<template>
<div class="d-flex justify-content-between align-items-center">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <button class="nav-link dropdown-toggle d-flex align-items-center btn btn-primary btn-sm btn-sm-block px-5" href="#" id="resourceFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="el-icon-search mr-2"></span>Filtros
                <span v-if="data.hasFilter" class="badge badge-light ml-2 mt-1">{{data.hasFilter}}</span>
            </button>
            <div class="dropdown-menu filter p-0" id="prevent_close_menu" aria-labelledby="resourceFilterDropdown">
                <table class="table table-striped">
                    <tbody>
                        <tr><td>Por Página :</td></tr>
                        <tr>
                            <td>
                                <el-select filterable class="w-100 filter" id="per_page" field="per_page" v-model="filter.per_page"  @change="makeNewRoute">
                                    <el-option :label="5" value="5"></el-option>
                                    <el-option :label="10" value="10"></el-option>
                                    <el-option :label="20" value="20"></el-option>
                                    <el-option :label="50" value="50"></el-option>
                                    <el-option :label="100" value="100"></el-option>
                                    <el-option :label="200" value="200"></el-option>
                                </el-select>
                            </td>
                        </tr>
                        <template v-for="(value,key) in data.filters" >
                            <tr><td><span v-html="value.label"></span></td></tr>
                            <tr>
                                <td>
                                    <el-input clearable v-model="filter[value.index]" @change="makeNewRoute" v-if="value.component=='text-filter'" type="text" class="w-100"      :placeholder="value.placeholder ? value.placeholder : ''"
                                    v-bind:class="{'withFilter' : filter[value.index]}"></el-input>
                                    <el-select 
                                        clearable
                                        class="w-100"
                                        v-if="value.component=='select-filter'"
                                        v-model="filter[value.index]" @change="makeNewRoute" 
                                        filterable :placeholder="value.placeholder ? value.placeholder : ''"
                                        v-bind:class="{'withFilter' : filter[value.index]}">
                                        <el-option label="" value=""></el-option>
                                        <el-option
                                            v-for="item in value.options"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                        </el-option>
                                    </el-select>
                                    <el-checkbox 
                                        class="d-flex align-items-center"
                                        v-if="value.component=='check-filter'" 
                                        v-model="filter[value.index]" @change="makeNewRoute" >{{value.text}}
                                    </el-checkbox>
                                    <el-date-picker class="w-100"
                                        clearable
                                        v-if="value.component=='date-filter'"
                                        v-model="filter[value.index]" @change="makeNewRoute" 
                                        type="date"
                                        :format="'dd/MM/yyyy'"
                                        value-format="yyyy-MM-dd"
                                        :placeholder="value.placeholder ? value.placeholder : ''"
                                        end-placeholder="Data Fim">
                                    </el-date-picker>
                                    <el-date-picker class="w-100"
                                        clearable
                                        v-if="value.component=='rangedate-filter'"
                                        v-model="filter[value.index]" @change="makeNewRoute" 
                                        type="daterange"
                                        range-separator="-"
                                        :format="'dd/MM/yyyy'"
                                        value-format="yyyy-MM-dd"
                                        :start-placeholder="value.start_placeholder ? value.start_placeholder : ''"
                                        :end-placeholder="value.end_placeholder ? value.end_placeholder : ''">
                                    </el-date-picker>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </li>
    </ul>
</div>
</template>
<script>
export default {
    props :["data"],
    data() {
        return {
            filter : {
                per_page : this.data.perpage
            },
        }
    },
    async created() {
        this.initFormFilter()
    },
    mounted() {
        document.getElementById("prevent_close_menu").addEventListener('click', event => event.stopPropagation())
    },
    methods: {
        setFormValue(index,value,filter) {
            if(filter.component == "text-filter")        value = String(value)
            if(filter.component == "check-filter")       value = value==="true"
            if(filter.component == "select-filter")      value = value ? Number(value) : ""
            if(filter.component == "rangedate-filter")   value = value.split(",")
            this.$set(this.filter,index,value)
        },
        initFormFilter() {
            let filter_keys = Object.keys(this.data.filters)
            for(let i in filter_keys) {
                this.setFormValue(this.data.filters[filter_keys[i]].index,this.data.query[this.data.filters[filter_keys[i]].index] ? this.data.query[this.data.filters[filter_keys[i]].index] : '',this.data.filters[filter_keys[i]])
            }
        },
        makeNewRoute() {
            let str_query = ""
            let filter_keys = Object.keys(this.filter)
            for(let i in filter_keys) this.data.query[filter_keys[i]] = this.filter[filter_keys[i]]
            for(let i in this.data.query) if(i!="page") str_query += `${i}=${this.data.query[i]}&`
            str_query = str_query.slice( 0, -1 )
            window.location.href =  `${this.data.route}?${str_query}`
        }
    },
}
</script>