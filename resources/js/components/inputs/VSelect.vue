<template>
    <div class="mb-3">
        <label v-html="label"></label>
        <el-select class="w-100" clearable v-model="value" filterable :placeholder="placeholder" v-loading="loading">
            <el-option label="" value=""></el-option>
            <el-option v-for="(item,i) in options" :key="i" :label="item.name" :value="item.id"></el-option>
        </el-select>
    </div>
</template>
<script>
export default {
    props : ["placeholder","label","route_list","list_model"],
    data() {
        return {
            loading : true,
            options: [],
            value: null
      }
    },
    async created() {
        this.initOptions( _ => {
            this.value = this.$attrs.value ? this.$attrs.value : null
            this.loading = false
        })
    },
    watch : {
        value(val){
            return this.$emit("input",val)
        }
    },
    methods : {
        initOptions(callback){
            this.$http.post(this.route_list,{model:this.list_model}).then( res => {
                res = res.data
                this.options = res.data
                callback()
            }).catch(er => {
                this.loading - false
                console.log(er)
            })
            
        }
    }
}
</script>