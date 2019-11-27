<template>
    <form class="needs-validation mt-4" v-on:submit.prevent="submit" >
        <div class="input-group">
            <input placeholder="Buscar ..." name="_" type="text" class="form-control" v-model="filter" @change="submit"> 
            <div  class="input-group-append">
                <span class="input-group-text p-0">
                    <button class="p-2 px-3" type="submit" style="border: unset;background-color: transparent;">
                        <span><i class="text-primary el-icon-search"></i></span>
                    </button>
                </span>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    props:['data'],
    data() {
        return {
            filter : this.data.value,
            timeout : null
        }
    },
    watch:{
        filter(val) {
            clearTimeout(this.timeout)
            this.timeout = setTimeout( _ => {
                this.submit()
                clearTimeout(this.timeout)
            },2000)
        }
    },
    methods : {
        submit() {
            this.makeNewRoute()
        },
        makeNewRoute() {
            let str_query = ""
            for(let i in this.data.query) {
                if((i!="page")&&(i!="_")) {
                    if(!["null",null].includes(this.data.query[i])) {
                        str_query += `${i}=${this.data.query[i]}&`
                    }
                }
            }
            str_query = str_query.slice( 0, -1 )
            str_query += `${str_query ? "&" : ""}_=${this.filter}`
            window.location.href =  `${this.data.filter_route}?${str_query}`
        }
    }
}
</script>