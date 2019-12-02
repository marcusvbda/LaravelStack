<template>
<div class="d-flex flex-row row align-items-center mb-3 flex-wrap mb-4 w-100">
    <div class="col-md-3 col-sm-12 mb-3">
        <label class="mb-0">Por Página :</label>
        <el-select filterable class="w-100 filter" id="per_page" field="per_page" v-model="filter.per_page"  @change="makeNewRoute">
            <el-option :label="5" value="5"></el-option>
            <el-option :label="10" value="10"></el-option>
            <el-option :label="20" value="20"></el-option>
            <el-option :label="50" value="50"></el-option>
            <el-option :label="100" value="100"></el-option>
        </el-select>
    </div>
    <template v-for="(filter,key) in data.filters" >
        <div class="col-md-3 col-sm-12 mb-3">
            <label class="mb-0"><span v-html="filter.label"></span></label>
            <v-runtime-template :key="key" :template="filter.view"></v-runtime-template>
        </div>
    </template>
</div>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props :["data"],
    data() {
        return {
            filter : {
                per_page : this.data.perpage
            },
        }
    },
    components : {
        "v-runtime-template" : VRuntimeTemplate
    },
    async created() {
        this.initFormFilter()
    },
    methods: {
        setFormValue(index,value,filter) {
            if(filter.component == "text-filter")        value = String(value)
            if(filter.component == "check-filter")       value = value==="true"
            if(filter.component == "select-filter")      value = value ? (!isNaN(Number(value)) ? Number(value) : "") : ""
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
            for(let i in this.data.query) {
                if((i!="page")&&(i!="_")) {
                    if(!["null",null].includes(this.data.query[i])) {
                        str_query += `${i}=${this.data.query[i]}&`
                    }
                }
            }
            str_query = str_query.slice( 0, -1 )
            if(this.data.query["_"]) {
                str_query += `${str_query ? "&" : ""}_=${this.data.query["_"] ? this.data.query["_"] : ""}`
            }
            window.location.href =  `${this.data.route}?${str_query}`
        }
    },
}
</script>