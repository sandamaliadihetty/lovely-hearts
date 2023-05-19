<template>
    <Head title="Adopt New Pet" />

    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="mt-12">
                <p class="font-bold text-2xl capitalize" style="font-family: 'Commissioner'">Find a new place to your pet</p>
            </div>

            <div class="mt-12  lg:flex justify-between">
                <div class="lg:w-8/12 lg:pr-12">
                    <div>
                       <label class="capitalize block">Name of the pet*</label>
                        <input type="text" class=" w-full rounded-full bg-orange-50 border-orange-300" v-model.trim="name" >
                    </div>

                    <div class="mt-6">
                        <label class="capitalize block">Image URL*</label>
                        <input type="url" class="l w-full rounded-full bg-orange-50 border-orange-300" v-model.trim="image" >
                    </div>

                    <div class="mt-6">
                        <label class="capitalize block">Breed*</label>
                        <input type="text" class=" w-full rounded-full bg-orange-50 border-orange-300" v-model.trim="breed" >
                    </div>

                    <div class="mt-6">
                        <label class="capitalize block">Age*</label>
                        <input type="number" class=" w-full rounded-full bg-orange-50 border-orange-300" v-model.trim="age" >
                    </div>

                    <div class="mt-6">
                        <label class="capitalize block">Location*</label>
                        <input type="text" class="l w-full rounded-full bg-orange-50 border-orange-300" v-model.trim="location" >
                    </div>
                    <div class="mt-6">
                        <label class="capitalize block">Description and Contact*</label>
                        <textarea rows="10" class=" w-full rounded-lg bg-orange-50 border-orange-300" v-model="description" ></textarea>
                    </div>
                    <div class="mt-6  w-full ">
                        <div v-if="processing === false" @click.prevent="submit" class="bg-orange-400 text-center py-3 px-8 justify-center rounded-full text-white cursor-pointer hover:bg-orange-500 flex items-center">
                            <p class="pl-1">Submit</p>
                        </div>
                        <div v-else  class="bg-orange-400 text-center py-3 px-8 justify-center rounded-full text-white cursor-pointer hover:bg-orange-500 flex items-center">
                            <p class="pl-1">Submitting...</p>
                        </div>
                    </div>

                </div>
                <div class="lg:w-4/12 mt-8 lg:mt-0">
                    <img src="/images/adopt.png" alt="">

                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";

export default {
    name: "NewAdopt",
    layout:[Layout],
    data(){
        return{
            name:null,
            image:null,
            breed:null,
            age:null,
            location:null,
            description:null,
            processing:false,
        }
    },
    methods:{
        submit(){
            this.processing = true
            axios.post(this.$route('adopt.store'),{name: this.name, image: this.image, breed: this.breed, age:this.age,location:this.location,description:this.description}).then(res => {
                this.name = null
                this.image = null
                this.breed = null
                this.age = null
                this.location = null
                this.description = null
                this.$toast.success('Your pet will be available after review.')
                this.processing = false
            }).catch(e=>{
                if(e.response.data && e.response.data.message){
                    this.$toast.error(e.response.data.message)
                }else{
                    this.$toast.error('Error. Please try again later.')
                }
                this.processing = false
            });
        }
    }
}
</script>

<style scoped>

</style>
