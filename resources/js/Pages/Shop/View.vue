<template>
    <Head title="Shop" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
           <div class="flex bg-[#fead13] justify-between items-center mt-12 rounded-lg">
               <div class="p-12">
                   <p class="text-5xl font-bold" style="font-family: 'Commissioner'">Grab Upto 50% Off On <br> Selected Products.</p>
               </div>
               <div class="hidden md:block">
                   <img src="/images/pet-banner.jpg" alt="dog" class="rounded-lg" style="height: 200px;">
               </div>
           </div>


            <div v-if="products.data.length === 0" class="mt-12">
                <p class="text-3xl font-bold">No products found</p>
            </div>
            <div v-else class="mt-12">
                <div class="mt-8 mb-2 flex items-center justify-end ">
                    <PaginationSimple :links="products.meta.links" />
                    <p class="pr-6 dark:text-dsh text-gray-400">|</p>
                    <p class="text-sm"><span class="font-bold">{{products.meta.from}}</span> - <span class="font-bold">{{products.meta.to}}</span> of <span class="font-bold">{{products.meta.total}}</span></p>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <Link :href="route('shop.show',{id:p.id})" v-for="p in products.data" :key="p.id" class="truncate mb-8">
                        <div class="h-[350px] bg-cover rounded-lg" :style="`background-image: url(${p.image});`"></div>

                        <div class="flex items-center justify-between">
                            <div class="w-9/12 truncate pr-2">
                                <p class="mt-2 truncate font-bold text-lg">{{p.title}}</p>
                                <p class="text-gray-600 truncate">{{p.description}}</p>
                                <div class="flex">
                                    <div @click.prevent="addToCart(p)" class="flex  bg-orange-400 py-2 px-4 rounded-full  items-center text-white cursor-pointer hover:bg-orange-500 ">
                                        <p ><i class="las la-shopping-cart"></i></p>
                                        <p class="pl-1">To Cart</p>
                                    </div>
                                </div>

                            </div>
                            <div class="w-3/12">
                               <p class="text-lg font-bold" style="font-family: 'Commissioner'">{{p.price/100}} EUR</p>
                            </div>
                        </div>







                    </Link>

                </div>

                <div class="container mx-auto mt-12 flex items-center justify-center ">
                    <div class="mb-20">
                        <Pagination :links="products.meta.links" />
                    </div>

                </div>








            </div>





        </div>
    </div>

</template>

<script>
import Layout from "../../Layouts/Layout.vue";
import Pagination from "../../Components/General/Pagination.vue";
import PaginationSimple from "../../Components/General/PaginationSimple.vue";

export default {
    name: "View",
    components: {PaginationSimple, Pagination},
    layout:[Layout],
    props:['allProducts'],
    data(){
        return{
            products: this.allProducts
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
