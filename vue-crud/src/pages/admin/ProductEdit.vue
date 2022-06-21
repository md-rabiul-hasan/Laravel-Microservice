<template>
  <div class="loader-bg" v-if="loader">
    <div class="loader-p"></div>
  </div>

  <div class="row" v-else>
    <div class="col-md-12 col-lg-12">
      <form @submit.prevent="productUpdate">
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
        <button type="submit" class="btn btn-primary">update</button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import {useRouter, useRoute} from 'vue-router'
export default {
  name: "ProductEdit",
  setup(){
    const title  = ref('');
    const image  = ref('');
    const router = useRouter();
    const route  = useRoute();
    const loader = ref(false);
    
    const product_id = route.params.id;
  
    onMounted( async () => {
      loader.value = true;
      const response = await fetch(`http://localhost:8001/api/product/${product_id}`);

      const product = await response.json();
      loader.value = false;

      title.value = product.title;
      image.value = product.image;
    });



    const productUpdate =  async () => {
       loader.value = true;
        await fetch(`http://localhost:8001/api/product/${product_id}/update`, {
            method: "PUT",
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
        productUpdate,
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