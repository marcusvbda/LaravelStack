<template>
    <div>
        <label class="mb-1"><span v-html="label ? label : ''"></span></label>
        <div class="input-group">
            <div class="input-group-prepend" v-if="prepend">
                <span class="input-group-text">
                    <span v-html="prepend ? prepend : ''"></span>
                </span>
            </div>
            <input :disabled="disabled" class="form-control" v-model="val" v-bind:class="{'is-invalid' : errors}" :placeholder="placeholder ? placeholder : ''" name="email" :type="type ? type : 'text'">
            <div class="input-group-append" v-if="append">
                <span class="input-group-text">
                    <span v-html="append ? append : ''"></span>
                </span>
            </div>
            <div class="invalid-feedback" v-if="errors">
                <ul class="pl-3 mb-0">
                    <li v-for="(e,i) in errors">{{e}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["label","type","placeholder","errors","prepend","append","disabled"],
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