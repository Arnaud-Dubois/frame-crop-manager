<template>
    <div>
        <h1 class="mb-4">Medias gallery</h1>

        <router-link class="btn btn-primary" :to="{ name: 'media.add'}">Add new media</router-link>
        <hr>

        <div v-if="medias.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div
                class="col"
                :key="media.id"
                v-for="media in medias"
            >
                <GalleryCard @refresh="fetchMedias" :item="media"/>
            </div>
        </div>
        <div v-else class="text-muted font-italic text-center py-3">No medias</div>
        
    </div>
</template>

<script>
import axios from 'axios'
import GalleryCard from './GalleryCard'

export default {
    name: 'gallery-view',
    components: {
        GalleryCard
    },
    data() {
        return {
            medias: []
        }
    },
    created() {
        this.fetchMedias()
    },
    methods: {
        fetchMedias() {
            axios.get('api/medias')
                .then(res => {
                    this.medias = res.data.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>