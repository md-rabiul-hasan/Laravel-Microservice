<template>
  <div>
    <div class="loader-bg" v-if="loader">
      <div class="loader-p"></div>
    </div>

    <div class="table-responsive" v-else>
      <router-link to="/admin/product/create" class="btn btn-sm btn-primary"
        >Add Product</router-link
      >
      <br /><br />
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Likes</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.id }}</td>
            <td>
              <img :src="product.image" alt="product-image" height="50" />
            </td>
            <td>{{ product.title }}</td>
            <td>{{ product.likes }}</td>
            <td>
              <div class="btn-group m-2">
                <router-link
                  class="btn btn-sm btn-info"
                  :to="`/admin/product/${product.id}/edit`"
                  >Edit</router-link
                >
                ||
                <a class="btn-sm btn-danger" @click="deleteProduct(product.id)"
                  >Delete</a
                >
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { ref, onMounted } from "vue";
import { Product } from "@/interfaces/product";
export default {
  name: "ProductScreen",
  setup() {
    const products = ref([]);
    const loader = ref(false);

    onMounted(async () => {
      loader.value = true;
      const response = await fetch("http://localhost:8001/api/products");
      products.value = await response.json();
      loader.value = false;
    });

    const deleteProduct = async (id: number) => {
      loader.value = true;
      if (confirm("Are you sure ? You want to delete this product :)")) {
        await fetch(`http://localhost:8001/api/product/${id}/delete`, {
          method: "DELETE",
        });
        loader.value = false;

        products.value = products.value.filter((p: Product) => p.id != id);
      }
    };

    return {
      products,
      deleteProduct,
      loader
    };
  },
};
</script>