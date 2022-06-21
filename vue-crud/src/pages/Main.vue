<template>
  <main role="main">
    <div class="loader-bg" v-if="loader">
      <div class="loader-p"></div>
    </div>

    <div v-else>
      <section class="jumbotron text-center">
        <div class="container">
          <h1>Laravel Vue-js Microservice</h1>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-4" v-for="product in products" :key="product.id">
              <div class="card mb-4 shadow-sm">
                <img :src="product.image" alt="product-image" height="400" />

                <div class="card-body">
                  <p class="card-text">
                    {{ product.title }}
                  </p>
                  <div
                    class="d-flex justify-content-between align-items-center"
                  >
                    <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-sm btn-outline-secondary"
                        @click="productLike(product.id)"
                      >
                        Like
                      </button>
                    </div>
                    <small class="text-muted">{{ product.likes }} Likes</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
import { ref, onMounted } from "vue";
import { Product } from "@/interfaces/product";
export default {
  name: "MainScreen",
  setup() {
    const products = ref([] as Product[]);
    const loader = ref(false);

    onMounted(async () => {
      loader.value = true;
      const response = await fetch("http://localhost:8002/api/products");
      products.value = await response.json();
      loader.value = false;
    });

    const productLike = async (id: number) => {
      loader.value = true;
      await fetch(`http://localhost:8002/api/products/${id}/like`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
      });

      loader.value = false;

      products.value = products.value.map((p: Product) => {
        if (p.id === id) {
          p.likes++;
          return p;
        }
        return p;
      });
    };

    return {
      products,
      productLike,
      loader
    };
  },
};
</script>