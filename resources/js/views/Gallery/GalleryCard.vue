<template>
    <div class="card mb-3" style="width: 18rem;">
        <img :src="item.path" class="card-img-top" :alt="item.path" width="100%" height="100%">
        <div class="card-body">
            <h5 class="card-title mb-4">Tag : 
                <span class="badge badge-dark">{{ item.name }}</span>
            </h5>
            <router-link class="btn btn-primary" :to="{ name: 'media.show', params: { mediaId: item.id}}">View media</router-link>
            <button
                class="btn btn-danger"
                @click="deleteMedia(item.id)"
            >
                Delete media
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'gallery-card',
    props: {
        item: {
            type: Object
        }
    },
    methods: {
        deleteMedia(id) {
            axios.delete(`api/medias/${id}`)
                .then(res => {
                    this.$emit('refresh')
                })
                .catch(err => console.log(err))
        }
    }
}
</script>