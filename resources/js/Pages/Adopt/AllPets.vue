<template>
    <Head title="Adopt New Pet" />
    <div class="-mt-2 bg-orange-50">
        <div class="container mx-auto lg:px-0 px-4">
            <div class="mt-12">
               <div class="flex items-center justify-between">
                   <div>
                       <p class="font-bold text-2xl capitalize" style="font-family: 'Commissioner'">Adopt A Pet</p>
                   </div>
                   <div>
                       <div class="flex ">
                           <Link :href="route('adopt.create')" class="bg-cyan-600 py-3 px-8 rounded-full text-white cursor-pointer hover:bg-cyan-700 flex items-center">
                               <p class="pl-1">Register A Pet</p>
                           </Link>
                       </div>
                   </div>
               </div>

            </div>


            <div v-if="allPets.data.length === 0" class="mt-12">
                <p class="text-3xl font-bold">No pets found</p>
            </div>
            <div v-else class="mt-8">
                <div class="mt-8 mb-2 flex items-center justify-end ">
                    <PaginationSimple :links="allPets.meta.links" />
                    <p class="pr-6 dark:text-dsh text-gray-400">|</p>
                    <p class="text-sm"><span class="font-bold">{{allPets.meta.from}}</span> - <span class="font-bold">{{allPets.meta.to}}</span> of <span class="font-bold">{{allPets.meta.total}}</span></p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <Link :href="route('adopt.pet.show',{id:p.id})" v-for="p in allPets.data" :key="p.id" class="truncate mb-8">
                        <div class="h-[350px] bg-cover rounded-lg" :style="`background-image: url(${p.image});`"></div>

                        <div class="flex items-center justify-between">
                            <div class=" truncate pr-2">
                                <p class="mt-2 truncate font-bold text-lg">{{p.name}}</p>
                                <p class="truncate font-bold text-lg">Age: {{p.age}} | Breed: {{p.breed}}</p>
                                <p class="truncate font-bold text-lg">{{p.location}}</p>
                                <p class="truncate font-bold text-lg">{{p.status === 0 ? 'In review' : 'Active'}}</p>
                                <p class="text-gray-600 truncate">{{p.description}}</p>
                            </div>
                        </div>

                    </Link>

                </div>

                <div class="container mx-auto mt-12 flex items-center justify-center ">
                    <div class="mb-20">
                        <Pagination :links="allPets.meta.links" />
                    </div>

                </div>
            </div>



        </div>
    </div>
</template>

<script>
import Layout from "../../Layouts/Layout.vue";
import PaginationSimple from "../../Components/General/PaginationSimple.vue";
import Pagination from "../../Components/General/Pagination.vue";

export default {
    name: "AllPets",
    components: {Pagination, PaginationSimple},
    layout:[Layout],
    props:['pets'],
    data(){
        return{
            allPets: this.pets
        }
    },
}
</script>

<style scoped>

</style>
