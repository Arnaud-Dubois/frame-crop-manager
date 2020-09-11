<template>
    <div>
        <router-link class="d-inline-block my-4" :to="{ name: 'home' }">Back to Gallery</router-link>

        <div class="d-flex">
            <img class="media-cover-image rounded mr-4" :src="item.path" :alt="item.path" width="256" height="256">
            <div class="w-100">
                <h2 class="mt-0">{{ item.name }}'s Tags list</h2>
                <hr>
                <p>
                    <span class="badge badge-secondary badge-text-size">{{ item.name }}</span>
                </p>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'media',
    data() {
        return {
            item: {}
        }
    },
    mounted() {
        this.fetchItem()
    },
    methods: {
        fetchItem() {
            axios.get(`api/medias/${this.$route.params.mediaId}`)
                .then(res => {
                    console.log(res)
                    this.item = res.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style lang="css">
    .media-cover-image {
        width: 256px;
        height: 256px;
    }
    .badge-text-size {
        font-size: 1.6rem;
    }

</style>