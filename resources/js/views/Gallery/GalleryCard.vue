<template>
    <div class="card mb-3 w-100">
        <router-link :to="{ name: 'media.show', params: { mediaId: item.id}}">
            <img :src="item.path" class="card-img-top" :alt="item.path" width="100%" height="100%">
        </router-link>
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
import MediasService from '@/services/Medias'

export default {
    name: 'gallery-card',
    props: {
        item: {
            type: Object
        }
    },
    methods: {
        deleteMedia(id) {
            MediasService.delete(id)
                .then(res => {
                    this.$emit('refresh')
                    this.$bvToast.toast(`${this.item.name} has been removed from the gallery.`, {
                        title: `Tag removed successfully !`,
                        variant: 'success',
                        solid: true
                    })
                    
                })
                .catch(err => {
                    console.log(err)
                    this.$bvToast.toast(err.response.data.message, {
                        title: `Error !`,
                        variant: 'danger',
                        solid: true
                    })
                })
        }
    }
}
</script>