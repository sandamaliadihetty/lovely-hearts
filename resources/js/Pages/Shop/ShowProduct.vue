<template>
    <Head v-if="myProduct !== null" :title="myProduct.data.title" />
    <Head v-else title="My product" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div v-if="myProduct === null" class="mt-12">
                <p class="text-3xl font-bold">No product found</p>
            </div>
            <div v-else class="lg:flex  mt-12" >
                <div class="lg:w-4/12">
                    <img :src="myProduct.data.image" class="rounded-lg bg-cover" />
                </div>

                <div class="lg:w-8/12 lg:pl-12">
                    <p class="text-3xl font-bold " style="font-family: 'Commissioner'">{{myProduct.data.title}}</p>
                    <p class="" >Price: {{myProduct.data.price/100}} EUR  </p>
                    <p class="mt-2" >{{myProduct.data.description}} </p>
                    <div class="flex mt-6">
                        <div @click.prevent="addToCart(myProduct.data)" class="flex  bg-orange-400 py-2 px-4 rounded-full  items-center text-white cursor-pointer hover:bg-orange-500 ">
                            <p ><i class="las la-shopping-cart"></i></p>
                            <p class="pl-1">To Cart</p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "ShowProduct",
    layout:[Layout],
    props:['product'],
    data(){
        return{
            myProduct: this.product
        }
    },
    methods:{
        addToCart(product){
            this.emitter.emit('product-added-to-cart',{ product:product})
        }
    }
}
</script>

<style scoped>

</style>
