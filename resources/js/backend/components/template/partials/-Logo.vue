<template>
  <div class="sidebar-logo-container" >
    <transition name="fade">
      <a :href="logo.href">
        <img v-if="logo" :src="logo.src" class="sidebar-logo" style="width: 110px;">
      </a>
    </transition>
  </div>
</template>

<script>
export default {
  props: ["collapse","logo"],
}
</script>

<style lang="scss" scoped>
    .sidebar-logo-container {
        position: relative;
        width: 100%;
        padding: 10px;
        line-height: 50px;
        background: #2b2f3a;
        text-align: center;
        overflow: hidden;
    }
</style>