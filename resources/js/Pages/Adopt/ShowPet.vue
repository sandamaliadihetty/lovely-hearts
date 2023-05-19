<template>

    <Head v-if="myPet !== null" :title="myPet.data.name" />
    <Head v-else title="View My Pet" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div v-if="myPet === null" class="mt-12">
                <p class="text-3xl font-bold">No pet found</p>
            </div>
            <div v-else class="lg:flex  mt-12" >
                <div class="lg:w-4/12">
                    <img :src="myPet.data.image" class="rounded-lg bg-cover" />
                </div>

                <div class="lg:w-8/12 lg:pl-12">
                    <p class="text-3xl font-bold " style="font-family: 'Commissioner'">{{myPet.data.name}}</p>
                    <p class="" >Age: {{myPet.data.age}} | Breed: {{myPet.data.breed}} </p>
                    <p class="" >Location: {{myPet.data.location}}</p>
                    <p class="" >Status: {{myPet.data.status === 0 ? 'In Review' : 'Active' }} </p>
                    <p class="mt-2" >{{myPet.data.description}} </p>
                </div>

            </div>


        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "ShowPet",
    layout:[Layout],
    props:['pet'],
    data(){
        return{
            myPet: this.pet
        }
    },
}
</script>

<style scoped>

</style>
