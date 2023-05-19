<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 flex justify-center items-center text-sm leading-4 text-white border border-cyan-700 rounded bg-cyan-700 " v-html="link.label" />
                <Link v-else class="mr-1 mb-1 px-4 py-3 flex justify-center items-center text-sm leading-4 border border-cyan-700  hover:text-white rounded hover:bg-cyan-700 focus:border-cyan-700 focus:text-gray-400 " :class="{ 'bg-cyan-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: ['links'],
}
</script>

<style scoped>

</style>
