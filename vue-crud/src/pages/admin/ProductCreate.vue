<template>
  <div class="loader-bg" v-if="loader">
    <div class="loader-p"></div>
  </div>
  <div class="row" v-else>
    <div class="col-md-12 col-lg-12">
      <form @submit.prevent="productStore">
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            v-model="title"
          />
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input
            type="text"
            class="form-control"
            id="image"
            v-model="image"
          />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import {useRouter} from 'vue-router'
export default {
  name: "ProductCreate",
  setup(){
    const title  = ref('');
    const image  = ref('');
    const router = useRouter();
    const loader = ref(false);

    const productStore =  async () => {
        loader.value = true;
        await fetch("http://localhost:8001/api/product", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                title: title.value,
                image: image.value
            })
        })
        loader.value = false;

        await router.push('/admin/products');
    }

    return {
        title,
        image,
        productStore,
        loader
    }
  }
};
</script>

<style scoped>
    .row {
        margin-left: 25%;
    }
</style>