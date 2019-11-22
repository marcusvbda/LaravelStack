<template>
    <div>
        <label class="mb-0"><span v-html="label ? label : ''"></span></label>
        <input class="form-control" v-model="val" v-bind:class="{'is-invalid' : errors}" :placeholder="placeholder ? placeholder : ''" name="email" :type="type ? type : 'text'">
        <div class="invalid-feedback" v-if="errors">
            <ul class="pl-3">
                <li v-for="(e,i) in errors">{{e}}</li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props:["label","type","placeholder","errors"],
    data() {
        return {
            val : null
        }
    },
    watch: {
        val(val) {
            return this.$emit("input",val)
        }
    },
    async created() {
        this.val = this.$attrs.value
    }
}
</script>