<template>
  <div class="div-footer">
      <slot></slot>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.div-footer {
  position: fixed;
  height: 65px;
  bottom: 0;
  text-align: center;
  z-index: 9;
  width: 100%;
  background-color:#efefef;
}
</style>