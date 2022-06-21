<template>
  <div>
    <Nav />

    <div class="container-fluid">
      <div class="row">

        <Menu />

        

        <router-view></router-view>
        
      </div>
    </div>
  </div>
</template>

<script>
import Nav from "@/components/Nav";
import Menu from "@/components/Menu";
export default {
  name: "AdminScreen",
  components: {
    Nav,
    Menu
  },
};
</script>

<style scoped>
</style>