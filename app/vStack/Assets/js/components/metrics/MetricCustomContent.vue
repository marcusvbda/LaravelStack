<template>
    <div class="h-100">
        <div class='d-flex flex-row justify-content-between align-items-center mb-2'>
            <slot name='label'></slot>
            <slot name='sublabel'></slot>
        </div>
        <slot name='content'></slot>
    </div>
</template>
<script>
export default {
    
}
</script>