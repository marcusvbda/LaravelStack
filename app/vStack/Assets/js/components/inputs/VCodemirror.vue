<template>
    <codemirror v-model="text" :options="cmOptions" />
</template>
<script>
import { codemirror } from 'vue-codemirror'
import 'codemirror/mode/xml/xml.js'
import 'codemirror/theme/ambiance.css'
import'codemirror/addon/selection/active-line.js'
import'codemirror/addon/edit/closetag.js'
export default {
    props : ["mode"],
    data() {
        return {
            text : "",
            cmOptions: {
                tabSize: 4,
                styleActiveLine: true,
                lineNumbers: true,
                autoCloseTags: true,
                line: true,
                mode: this.mode ?  this.mode : 'text/html'
            }
        }
    },
    mounted() {
        this.text = this.$attrs.value
    },
    watch : {
        text(val) {
            return this.$emit('input',val)
        }
    },
    components: {
        codemirror
    },
}
</script>

<style lang="scss">
@import "~codemirror/lib/codemirror.css";
    .CodeMirror {
        &.cm-s-default {
            border: 1px solid #e4e4e4;
        }
    }
</style>